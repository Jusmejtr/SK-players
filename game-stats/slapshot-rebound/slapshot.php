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
    $api_url_slapshot="http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=1173370&key=$api_key&steamid=$steamid";


    $json = json_decode(file_get_contents($api_url),true);//json s udajmi hraca ako je meno, fotka, link ...

    $json_slapshot = json_decode(file_get_contents($api_url_slapshot),true);//json s statistikami na slapshot daneho hraca

    //$jsonik = json_decode(file_get_contents($api_resolve),true);

    //$json = file_get_contents($api_url_slapshot);
    
    //echo $json;
    
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/data/game-stats-data.php';


    $pole = [];

    for($i=0;$i<20;$i++){
        $pole[$json_slapshot['playerstats']['stats'][$i]['name']] = $json_slapshot['playerstats']['stats'][$i]['value'];
    }

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/game/slapshot.css?version=7">

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>


    <title>SK players</title>


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
            <th>Počet odohraných hier</th>
            <td><?=number_format($pole['games_played'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet výhier</th>
            <td><?=number_format($pole['wins'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet prehier</th>
            <td><?=number_format($pole['losses'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Tvoje skóre</th>
            <td><?=number_format($pole['score'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet strelených gólov</th>
            <td><?=number_format($pole['goals'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet strelených víťazných gólov</th>
            <td><?=number_format($pole['game_winning_goals'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet strelených gólov v predĺžení</th>
            <td><?=number_format($pole['overtime_goals'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet asistencií</th>
            <td><?=number_format($pole['assists'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet striel</th>
            <td><?=number_format($pole['shots'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet trafených tyčiek</th>
            <td><?=number_format($pole['post_hits'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet save-ov</th>
            <td><?=number_format($pole['saves'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet zblokovaných striel</th>
            <td><?=number_format($pole['blocks'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet prihrávok</th>
            <td><?=number_format($pole['passes'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet obratí nepriateľa o puk</th>
            <td><?=number_format($pole['takeaways'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet hier, v ktorých si neobdržal gól</th>
            <td><?=number_format($pole['shutouts'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet vyhratých buly</th>
            <td><?=number_format($pole['faceoffs_won'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet výhier v predĺžení</th>
            <td><?=number_format($pole['overtime_wins'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet, koľko krát si pomohol k dosiahnutiu gólu v tíme</th>
            <td><?=number_format($pole['contributed_goals'], 0, '.', ' ')?></td>
        </tr>
        <tr>
            <th>Počet hat trickov</th>
            <td><?=number_format($pole['hat_tricks'], 0, '.', ' ')?></td>
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
