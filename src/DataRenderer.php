<?php

namespace App;

use App\View\IndexParameters;
use App\Template\TemplateFactoryInterface;

//v této třídě se předávají data do smarty šablon.
class DataRenderer {
    private Database $db;
    private TemplateFactoryInterface $templateFactory;

    public function __construct(Database $db, TemplateFactoryInterface $templateFactory){
        $this->db = $db;
        $this->templateFactory = $templateFactory;
    }
    //zde budeme získávat souhrn dat z databáze a dávat je do filtrů. Můžeme tak filtrovat podle reálných dat z databáze
    public function getDataFromDb(string $column, ?string $isDetail) : array {
        $db_c = $this->db->getConnection();
        $result = "";
        //do této metody lze poslat isDetail 1 nebo 0. Pokud je 1, budeme brát data z detailů. Pokud ne, z bytů.
        if ($isDetail ){
            // u detailu je nutný udělat join na byty_detaily
            $sql = "SELECT bd.".$column.", COUNT(bd.id) AS count FROM byty_detaily bd GROUP BY bd.".$column." ORDER BY bd.".$column." ASC";}
        else {
            $sql = "SELECT ".$column.", COUNT(id) AS count FROM byty GROUP BY ".$column." ORDER BY ".$column." ASC";
        }
        $stmt = $db_c->prepare($sql);
        $stmt->execute();
        //vezmeme výsledky sql
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        //a vrátíme je
        return $result;
    }

    public function LoadDataForSmarty() : void {
        $db_c = $this->db->getConnection();
        //filtry se nachází v getu
        $filters = $_GET;
        // v getu se nachází i order by a stránka, což nepatří k filtrům. Odstraníme je tedy.
        unset($filters["page"]);
        unset($filters["order"]);
        //získáme informaci, na jaké stránce se nacházíme.
        $page = $this->getCurrentPage();
        //sestavíme url ve formátu RFC3986. Takhle se vyhneme diakritice.
        $http = http_build_query($filters, "", "", PHP_QUERY_RFC3986);

        //vytvoříme object IndexParmeters - parametry pro šablonu index.tpl;
        $templateParams = new IndexParameters();
        //řekneme objektu, že filtry jsou $filters
        $templateParams->filters = $filters;
        //vytáhneme z výpisu detailů bytů informaci o patrech a předáme ji do templatu jako parametr "stairs"
        $templateParams->stairs = $this->getDataFromDb("patro", 1);
        //vytáhneme z výpisu bytů informaci o částech a předáme ji do templatu jako parametr "parts"
        $templateParams->parts = $this->getDataFromDb("part", 0);
        //vytáhneme z výpisu bytů informaci o stavu bytů a předáme ji do templatu jako parametr "stav"
        $templateParams->conditions = $this->getDataFromDb("stav", 1);
        //vytáhneme z výpisu bytů informaci o stavu bytů a předáme ji do templatu jako parametr "stav"
        $templateParams->sizes = $this->getDataFromDb("dispozice", 1);
        //vytáhneme z výpisu bytů informaci o tom, zda v bytu mohou být zvířata a předáme ji do templatu jako parametr "animals"
        $templateParams->animals = $this->getDataFromDb("zvirata", 1);
        //vytáhneme z výpisu bytů informaci o přítomnosti balkonu a předáme ji do templatu jako parametr "balcony"
        $templateParams->balcony = $this->getDataFromDb("balkon", 1);
        //vytáhneme z výpisu bytů informaci o přítomnosti výtahu a předáme ji do templatu jako parametr "elevator"
        $templateParams->elevator = $this->getDataFromDb("vytah", 1);
        //vybereme počet detailů a předáme ho do templatu jako parametr "sum"
        $templateParams->sum = $db_c->query("SELECT count('id') from byty_detaily as count")->fetch_row()[0];
        //zjistíme, které řazení je aktivní a předáem ho do templatu jako parametr "order"
        $templateParams->order = $this->getOrder();
        //vytáhneme si filtrované byty a předáme je šabloně jako parametr "apartments"
	    $templateParams->apartments = $this->getFilteredData();
        //předáme do templatu parametr stránky
	    $templateParams->page = $page;
        //předáme paginatoru url
	    $templateParams->http = $http;

	    //vytvoříme šablonu a vyrenderujeme ji
	    $this->templateFactory->create('index.tpl', $templateParams)->render();
    }

    public function getFilteredData() : array {
        //první bind musí být vždy i -  jako int.
        $binds[] = "i";
        //připojíme se k DB
        $db = $this->db->getConnection();
        //zjistíme aktuální limit z filtru
        $limit = $this->getCurrentLimit();
        //zjistíme aktivní řazení
        $order_s = $this->getOrder();
        //z aktivních filtrů zjistíme parametry, bindy (datové typy) a podmínky. Např. price < 20000 - zde je price parametr a < 20000 podmínka.
        [$conditions, $binds, $params] = $this->getActiveFilters();
        //pokud jsou podmínky nastavené - ve filtru tedy něco je.
        if ($conditions != NULL) {
            //dekodujeme filtry zpátky, aby obsahovaly i diakritiku a mohli jsme s nimi pracovat v databázi
            $params = $this->decodeFilters($params);
            //nastavíme where podmínku pomocí všech podmínek
            $where = empty($conditions) ? '' : ('WHERE ' . implode(' AND ', $conditions));
            $sql = "select b.id, b.longpart, b.part, bd.balkon, b.pricetotal, b.part, bd.dispozice, bd.vymera, bd.zvirata, bd.patro, bd.vybaveni, bd.vytah, bd.stav, b.price, b.url, b.name from byty b join byty_detaily bd on bd.byty_id=b.id " . $where . " order by " . $order_s . $limit;
         }
         else {
             $sql = "select b.id, b.part, b.longpart, b.pricetotal, bd.balkon, b.part, bd.dispozice, bd.vymera, bd.zvirata, bd.patro, bd.vybaveni, bd.vytah, bd.stav, b.price, b.url, b.name from byty b join byty_detaily bd on bd.byty_id=b.id order by pricetotal". $limit;
         }

         //pro jistotu znova zkontrolujeme, zda jsou filtry aktivní
        $stmt = $db->prepare($sql);
        if ($conditions != NULL) {
            //nabindujeme data do statementu
            $stmt->bind_param(implode('', $binds), ...array_values($params));
        }
        //vykonáme sql query
        $stmt->execute();
        //a fetchneme všechny výsledky
        $result = $stmt->get_result();
        $apartments = $result->fetch_all(MYSQLI_ASSOC);
        //a vrátíme výsledky nebo prázdné pole
        return $apartments ?? [];
    }

    public  function getOrder() {
        //pokud order není nastaven, je defaultní cheap. Jinak použijeme informaci z GETU
        $order = $_GET["order"] ?? "cheap";
        //nastavíme podmínku do databáze podle typu řazení
        //od nejlevnějšího, nejmenšího, největšího, městské části abecedně, nejlevnějšího
        switch ($order){
            case "expensive":
                $order_s = 'pricetotal desc';
                break;
            case "areamin":
                $order_s = 'vymera asc';
                break;
            case "areamax":
                $order_s = 'vymera desc';
                break;
            case "part":
                $order_s = 'part';
                break;
            case "cheap":
                $order_s = 'pricetotal';
                break;
            default:
                $order_s = 'pricetotal';
        }
        return $order_s;
    }

    //tato metoda vrací aktivní filtry
    public function getActiveFilters() : array
    {
        //filtry získáme z getu
        $filters = $_GET;
        //pokud je ve filtru stránka, odstraníme ji
        if (isset($filters['page'])) {
            unset($filters["page"]);
        }
        //odstranímee order z filtru
        unset($filters["order"]);

        $params = [];
        $binds = [];
        $conditions = [];
        //tady nastavíme filtry na "NULL" všude, kde je neuvedeno.
        foreach ($filters as $key => $filter) {
            if ($filters[$key][0] === "Neuvedeno") {
                $filters[$key][0] = "NULL";
            }
        }
        //nastavíme podmínky do databáze pro filtry, pokud jsou nastaveny.
        if (isset($filters['pricemin'])) {
            $conditions[] = 'pricetotal >= ?';
            $params[] = $filters['pricemin'];
            $binds[] = "i";
        }
        if (isset($filters['areamin'])) {
            $conditions[] = 'vymera >= ?';
            $params[] = rawurldecode($filters['areamin']);
            $binds[] = "i";
        }
        if (isset($filters['areamax'])) {
            $conditions[] = 'vymera <= ?';
            $params[] = $filters['areamax'];
            $binds[] = "i";
        }
        if (isset($filters['pricemax'])) {
            $conditions[] = 'pricetotal <= ?';
            $params[] = $filters['pricemax'];
            $binds[] = "i";
        }

        //v následujících filtrech mohou být pole. Proto použijeme do databáze IN (x, y, z)
        if (isset($filters['part']) && !empty($filters['part'])) {
            $conditions[] = 'part IN (' . implode(', ', array_fill(0, count($filters['part']), '?')) . ')';
            $params = array_merge($params, $filters['part']);
            $binds = array_merge($binds, array_fill(0, count($filters['part']), 's'));
        }
        if (isset($filters['size']) && !empty($filters['size'])) {
            if ($filters["size"] === "Neuvedeno"){
                $conditions[] = ' OR dispozice is NULL';
            }
            $conditions[] = 'dispozice IN (' . implode(', ', array_fill(0, count($filters['size']), '?')) . ')';
            $params = array_merge($params, $filters['size']);
            $binds = array_merge($binds, array_fill(0, count($filters['size']), 's'));
        }
        if (isset($filters['condition']) && !empty($filters['condition'])) {
            $conditions[] = 'stav IN (' . implode(', ', array_fill(0, count($filters['condition']), '?')) . ')';
            $params = array_merge($params, $filters['condition']);
            $binds = array_merge($binds, array_fill(0, count($filters['condition']), 's'));
        }
        if (isset($filters['stairs']) && !empty($filters['stairs'])) {
            $conditions[] = 'patro IN (' . implode(', ', array_fill(0, count($filters['stairs']), '?')) . ')';
            $params = array_merge($params, $filters['stairs']);
            $binds = array_merge($binds, array_fill(0, count($filters['stairs']), 's'));
        }
        if (isset($filters['elevator']) && !empty($filters['elevator'])) {
            $conditions[] = 'vytah IN (' . implode(', ', array_fill(0, count($filters['elevator']), '?')) . ')';
            $params = array_merge($params, $filters["elevator"]);
            $binds = array_merge($binds, array_fill(0, count($filters['elevator']), 's'));
        }
        if (isset($filters['balcony']) && !empty($filters['balcony'])) {
            foreach ($filters["balcony"] as $index=>$balcony){
                if ($filters["balcony"][$index] === "Ano"){
                    $filters["balcony"][$index] = 1;
                }
                else if ($filters["balcony"][$index] === "Ne"){
                    $filters["balcony"][$index] = 0;
                }
                else{
                    $filters["balcony"][$index] = "NULL";
                }
            }
            $conditions[] = 'balkon IN (' . implode(', ', array_fill(0, count($filters['balcony']), '?')) . ')';
            $params = array_merge($params, $filters["balcony"]);
            $binds = array_merge($binds, array_fill(0, count($filters['balcony']), 's'));
        }
        return [$conditions, $binds, $params];
    }

    //vracíme aktuální limit pro databázi.
    public function getCurrentLimit() : string {
        //zjistíme, na jaké jsme stránce
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        }
        else {
            $page = 1;
        }
        //a sestavíme limit pro sql příkaz
        $limit = " limit " . $page . ", 10";
        //a vrátíme ho
        return $limit;
    }

    //vracíme aktuální stránku
    public  function getCurrentPage() {
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }
        return $page;
    }

    //Rekurzivní metoda.
    //dekodujeme filtry. Přichází sem pole parametrů bez diakritiky, resp. nahrazenou diakritikou.
    //Poté vracíme dekodované filtry tak, aby s nimi mohla pracovat databáze.
   public function decodeFilters(array $filters): array {
        foreach ($filters as $k => $v) {
            if (is_array($v)) {
                $v = $this->decodeFilters($v);
            }

            if (is_string($v)) {
                $v = rawurldecode($v);
            }

            $filters[$k] = $v;
        }
        return $filters;
    }
}

