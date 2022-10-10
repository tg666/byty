<?php

use App\Database;
use App\Write\DataWriter;
use App\DataRenderer;
use App\DI\Container;
use SixtyEightPublishers\Environment\Bootstrap\EnvBootstrap;

require __DIR__ . '/../vendor/autoload.php';

EnvBootstrap::boot([]);

//vytvoříme container a inicializujeme všechny služby v aplikaci.
// Data k databázi přečteme z .env souboru (viz .env.dist)
$container = new Container([
    'db.host' => env("DB_HOST"),
    'db.user' => env("DB_USER"),
    'db.dbname' => env("DB_NAME"),
    'db.password' => env("DB_PASSWORD"),
    'discordWebhookUrl' => env("DISCORD_WEBHOOK_URL", ""),
]);


// spustíme webovou aplikaci.
$container->getWebApp()->run();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script type="text/javascript" src="public/js/distanceChecker.js"></script>
    <script type="text/javascript" src="public/js/RouteCreator.js"></script>
    <script type="text/javascript" src="public/js/GetMetroStations.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link href="./public/css/styles.css" rel="stylesheet">
    <script src="public/js/jquery-3.6.1.js"></script>
    <script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
    <script type="text/javascript">Loader.load();</script>
</head>
<body>
    <script>
        var i = 0;
        $(document).ready(function () {
            urls = Object.values(document.getElementsByClassName("addres"));
            urls.forEach(loop);

        });

        function loop(item, index) {
            var items = item.innerHTML;
            window.countDistance(items, i);
            getMapCoordsFromAddress(items, function (result) {
                var NearestLoc = getNearestStation(result.coords.x, result.coords.y);
                var coords = [result.coords, NearestLoc["coords"]];
                CreateRoute(coords, function (result2) {
                fillRouteInfo(index, NearestLoc["station"], result2, NearestLoc["track"]);
                });
            });
            i++;
        }
    </script>
</body>

