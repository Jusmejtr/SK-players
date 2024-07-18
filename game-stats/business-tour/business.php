<?php
    if(isset($_POST["odosli"])){
        $kluc = $_POST["steamidcko"];
    }

    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/key.php";
    require_once $path;


    $api_resolve = "http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key=$api_key&vanityurl=$kluc";//pre transform cisto mena na steamid

    if(strpos($kluc, "https://steamcommunity.com/") !== false){//ked zada link, nie id
        if(substr($kluc, -1) == "/"){
            $kluc = substr($kluc,0,-1);
        }
        if(strpos($kluc, "id") !== false){//ked v linku bude id
            $kluc = substr($kluc, 30);
            $json_idcko = json_decode(file_get_contents("http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key=$api_key&vanityurl=$kluc"), true);
            $steamid = $json_idcko["response"]["steamid"];
        }else if(strpos($kluc, "profiles") !== false){//ked v linku bude profiles
            $steamid = substr($kluc, 36);
        }
    }else{//ked zada bud meno alebo ID
        if(is_numeric($kluc) == 1){//ID
            $steamid = $kluc;
        }else{//meno
            $json_idcko = json_decode(file_get_contents($api_resolve), true);
            $steamid = $json_idcko["response"]["steamid"];
        }
        
    }

    $api_url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$api_key&steamids=$steamid";
    $api_url_business="http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=397900&key=$api_key&steamid=$steamid";


    $json = json_decode(file_get_contents($api_url),true);//json s udajmi hraca ako je meno, fotka, link ...

    $json_dungeons = json_decode(file_get_contents($api_url_business),true);//json s statistikami na slapshot daneho hraca

    //$jsonik = json_decode(file_get_contents($api_resolve),true);

    //$json = file_get_contents($api_url_slapshot);
    
    //echo $json;
    
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/data/game-stats-data.php';

    $pole = [];

    for($i=0;$i<7;$i++){
        $pole[$json_dungeons['playerstats']['stats'][$i]['name']] = $json_dungeons['playerstats']['stats'][$i]['value'];
    }

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="/css/game/business.css?version=7">

    <title>SK players</title>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>

</head>
<body>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/hlavicka-fixed.php';

    $path = $_SERVER['DOCUMENT_ROOT'] . '/data/game-stats-header.php';
    require_once $path;
    ?>

    <table class="mainstats">
        <tr>
            <th>Počet výhier pomocou triple-monopoly</th>
            <td><?=number_format($pole['STAT_WON_TRIPLE_01'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet výhier pomocou line-monopoly</th>
            <td><?=number_format($pole['STAT_WON_LINE_01'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet výhier pomocou rezortov</th>
            <td><?=number_format($pole['STAT_WON_RESORT_01'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet výhier pomocou zbankrotovania protivníkov</th>
            <td><?=number_format($pole['STAT_WON_LASTPLAYER_01'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Koľko krát si bol na World-tour</th>
            <td><?=number_format($pole['STAT_TRAVELER_01'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Koľko krát si vypol niekomu elektrinu v meste</th>
            <td><?=number_format($pole['STAT_BLACKOUT'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Koľko krát si utiekol zo strateného ostrava hodením pair na prvý pokus</th>
            <td><?=number_format($pole['STAT_LUCKY'], 0, '.', ' ')?></td>
        </tr>
    </table>
    <script>
        //vratenie sa na uvodnu stranku
        $(document).ready(function() {
            $('img.sk_logo').click(function() {
                window.location.href = '/';
            });
        });
        $(document).ready(function() {
            $('img.sk_logo_text').click(function() {
                window.location.href = '/';
            });
        });
    </script>
</body>
</html>
