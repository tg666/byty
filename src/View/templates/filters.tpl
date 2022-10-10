{if array_key_exists('pricemin', $filters)}
    {$minprice = $filters['pricemin'] }
{else}
    {$minprice = 8000 }
{/if}
{if array_key_exists('pricemax', $filters)}
    {$maxprice = $filters['pricemax'] }
{else}
    {$maxprice = 55000 }
{/if}
<H2 class="text-center">Celkem v databázi: {$sum}</H2>
<div class="d-flex fixed-filters align-items-stretch flex-shrink-0 bg-white" style="width: 40%;">

    <div class="list-group list-group-flush scrollarea">
        <button class="list-group-item list-group-item-action active py-3 lh-sm" data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-current="true">
            <div class="d-flex w-60  align-items-center justify-content-between">
                <strong class="mb-1">Filtry</strong>
            </div>
        </button>
        <form type="GET">
            <div class="collapse" id="collapseFilters">
                <label for="cars">Řadit podle</label>
                <select name="order" id="order">
                    <option value="cheap" {if $order eq "cheap"}selected="selected"{/if}>Nejlevnější</option>
                    <option value="expensive"{if $order eq "expensive"}selected="selected"{/if}>Nejdražší</option>
                    <option value="part" {if $order eq "part"}selected{/if}>Mětské části</option>
                    <option value="areamin" {if $order eq "areamin"}selected {/if}>Od nejmenšího</option>
                    <option value="areamax" {if $order eq "areamax"}selected {/if}>Od největšího</option>
                </select>
                <div class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-450 align-items-center justify-content-between">
                        <strong class="mb-1">Část Prahy</strong>
                    </div>
                    <div class="d-flex  p-2 flex-wrap mb-3">
                        {foreach $parts as $f}
                            {if $f.part neq NULL}
                            <div class="half">
                                <input type="checkbox" id="{$f.part}" value="{rawurlencode($f.part)}" {if isset($filters['part']) && in_array($f['part'], $filters['part'])}checked{/if} name="part[]">
                                <label for="{$f.part}">{$f.part} ({$f.count})</label>
                            </div>
                            {/if}
                        {/foreach}
                    </div>
                </div>
                <div class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Plocha</strong>
                    </div>
                    <div class="col-10 mb-1 small"> Od <input type="number" min="10" id="areamin" value="10" step="1" name="areamin" size=""> do <input type="number" value="60" min="0" size="5" id="areamax" step="1" name="areamax"> m2</div>
                </div>

                <a href="#" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Cena</strong>
                    </div>
                    <div class="col-10 mb-1 small"> Od <input type="number" value="{$minprice}" min="8000" id="pricemin" step="500" name="pricemin" size="5">
                        do <input type="number" min="8000" size="5" id="pricemax" value="{$maxprice}" step="500" name="pricemax"> Kč</div>

                </a>
                <div href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Stav</strong>
                    </div>
                    <div class="col-10 mb-1 small">
                        {foreach $conditions as $f}
                            {if $f.stav eq NULL}
                                {$f.stav = "Neuvedeno"}
                            {/if}
                            <div class="half">
                                <input type="checkbox" id="{$f.stav}" {if $f.stav eq "Neuvedeno"} value="NULL" {else} value="{rawurlencode($f.stav)}" {/if} {if isset($filters['condition']) && in_array($f['stav'], $filters['condition'])}checked{/if} name="condition[]"">
                                <label for="{$f.stav}">{$f.stav} ({$f.count})</label>
                            </div>
                        {/foreach}
                    </div>
                </div>
                <div href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Dispozice</strong>
                    </div>
                    <div class="col-10 mb-1 small">
                        {foreach $sizes as $f}
                            {if $f.dispozice eq NULL}
                                {$f.dispozice = "Neuvedeno"}
                            {/if}
                            <div class="half">
                                <input type="checkbox" id="{$f.dispozice}" value="{rawurlencode($f.dispozice)}" {if isset($filters['size']) && in_array($f['dispozice'], $filters['size'])}checked{/if} name="size[]"">
                                <label for="{$f.dispozice}">{$f.dispozice} ({$f.count})</label>
                            </div>
                        {/foreach}
                    </div>
                </div>
                <div href="#" class="list-group-item list-group-item-action py-3 lh-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Patro</strong>
                    </div>
                    <div class="col-10 mb-1 small">
                        {foreach $stairs as $f}
                            {if $f.patro eq NULL}
                                {$f.patro = "Neuvedeno"}
                            {/if}
                            <div class="half">
                                <input type="checkbox" id="{$f.patro}" value="{$f.patro}" {if isset($filters['stairs']) && in_array($f['patro'], $filters['stairs'])}checked{/if} name="stairs[]">
                                <label for="{$f.patro}">{$f.patro} ({$f.count})</label>
                            </div>
                        {/foreach}
                    </div>
                </div>
                <div href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Výtah</strong>
                    </div>
                    <div class="col-10 mb-1 small">
                        {foreach $elevator as $f}
                            {if $f.vytah eq 1}
                                {$f.vytah = "Ano"}
                            {elseif $f.vytah eq "0"}
                                {$f.vytah = "Ne"}
                            {else}
                                {$f.vytah = "Neuvedeno"}
                            {/if}
                            <div class="half">
                                <input type="checkbox" id="{$f.vytah}" value="{$f.vytah}" {if isset($filters['elevator']) && in_array($f['vytah'], $filters['elevator'])}checked{/if} name="elevator[]">
                                <label for="{$f.vytah}">{$f.vytah} ({$f.count})</label>
                            </div>
                        {/foreach}
                    </div>
                </div>
                <div href="#" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Balkon</strong>
                    </div>
                    <div class="col-10 mb-1 small">
                        {foreach $balcony as $f}
                            {if $f.balkon eq 1}
                                {$f.balkon = "Ano"}
                            {elseif $f.balkon eq "0"}
                                {$f.balkon = "Ne"}
                            {else}
                                {$f.balkon = "Neuvedeno"}
                            {/if}
                            <div class="half">
                                <input type="checkbox" id="{$f.balkon}" value="{rawurlencode($f.balkon)}" {if isset($filters['balcony']) && in_array($f['balkon'], $filters['balcony'])}checked{/if} name="balcony[]">
                                <label for="{$f.balkon}">{$f.balkon} ({$f.count})</label>
                            </div>
                        {/foreach}
                    </div>
                </div>
                <input class="btn btn-secondary" type="submit" value="Potvrdit">
            </div>
        </form>
    </div>
</div>

