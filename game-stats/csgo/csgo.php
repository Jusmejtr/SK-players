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
    $api_url_csgo="http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=$api_key&steamid=$steamid";


    $json = json_decode(file_get_contents($api_url),true);//json s udajmi hraca ako je meno, fotka, link ...

    $json_csgo = json_decode(file_get_contents($api_url_csgo),true);//json s statistikami na csgo daneho hraca

    //$jsonik = json_decode(file_get_contents($api_resolve),true);

    //$json = file_get_contents($api_resolve);
    
    //echo $json;

    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/game-stats-data.php";
    require_once $path;

    $pole = [];

    for($i=0;$i<192;$i++){

        $pole[$json_csgo['playerstats']['stats'][$i]['name']] = $json_csgo['playerstats']['stats'][$i]['value'];

    }

?>


<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="/css/csgo/csgostats.css?version=9">


        <title>SK players</title>
        <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        require_once $path . "/data/head-dolezite.php";
        ?>

    </head>

    <body>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/hlavicka-fixed.php';

    $path = $_SERVER['DOCUMENT_ROOT'] . '/data/game-stats-header.php';
    require_once $path;
    ?>
        <h2>
            Všeobecné štatistiky:
        </h2>
        <!-- <table class="mainstats">
                <tr>
                    <td>Počet zabití: <?=number_format($pole['total_kills'], 0, '.', ' ')?></td>
                    <td>Počet smrtí: <?=number_format($pole['total_deaths'], 0, '.', ' ')?></td>
                    <td>K/D: <?php echo round($pole['total_kills']/$pole['total_deaths'],2)?></td>
                </tr>
                <tr>
                    <td>Počet plantnutých bômb: <?=number_format($pole['total_planted_bombs'], 0, '.', ' ')?></td>
                    <td>Počet zneškodnených bômb: <?=number_format($pole['total_defused_bombs'], 0, '.', ' ')?></td>
                    <td>Celkový udelený damage: <?=number_format($pole['total_damage_done'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <td>Celkový počet zarobených peňazí: <?=number_format($pole['total_money_earned'], 0, '.', ' ')?></td>
                    <td>Počet zachránených hostigov: <?=number_format($pole['total_rescued_hostages'], 0, '.', ' ')?></td>
                    <td>Celkový čas hrania: <?=number_format($pole['total_time_played']/3600, 0, '.', ' ')?> h</td>
                </tr> 
                <tr>
                    <td>Celkový počet zásahov: <?=number_format($pole['total_shots_hit'], 0,'.',' ')?></td>
                    <td>Celkový počet výstrelov: <?=number_format($pole['total_shots_fired'], 0,'.',' ')?></td>
                    <td>Celková presnosť: <?php echo round($pole['total_shots_hit']/$pole['total_shots_fired']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <td>Celkový počet headshotov: <?=number_format($pole['total_kills_headshot'], 0,'.',' ') ?></td>
                    <td>Celkový počet MVP: <?=number_format($pole['total_mvps'], 0,'.',' ') ?></td>
                </tr>
                <tr class="dva">
                    <td>Celkový počet odohraných zápasov: <?=number_format($pole['total_matches_played'], 0,'.',' ')?></td>
                    <td>Celkový počet vyhraných zápasov: <?=number_format($pole['total_matches_won'], 0,'.',' ')?></td>
                </tr>
                <tr class="dva">
                    <td>Celkový počet odohraných kôl: <?=number_format($pole['total_rounds_played'], 0,'.',' ')?></td>
                    <td>Celkový počet vyhratých kôl: <?=number_format($pole['total_wins'], 0,'.',' ')?></td>
                </tr>
        </table> -->
        <br>
        
        <div class="mainstats">
            <div class="prve">
                <div>Počet zabití: <?=number_format($pole['total_kills'], 0, '.', ' ')?></div>
                <div>Počet smrtí: <?=number_format($pole['total_deaths'], 0, '.', ' ')?></div>
                <div>K/D: <?php echo round($pole['total_kills']/$pole['total_deaths'],2)?></div>
            </div>

            <div class="druhe">
                <div>Počet plantnutých bômb: <?=number_format($pole['total_planted_bombs'], 0, '.', ' ')?></div>
                <div>Počet zneškodnených bômb: <?=number_format($pole['total_defused_bombs'], 0, '.', ' ')?></div>
                <div>Celkový udelený damage: <?=number_format($pole['total_damage_done'], 0, '.', ' ')?></div>
            </div>

            <div class="tretie">
                <div>Celkový počet zarobených peňazí: <?=number_format($pole['total_money_earned'], 0, '.', ' ')?></div>
                <div>Počet zachránených hostigov: <?=number_format($pole['total_rescued_hostages'], 0, '.', ' ')?></div>
                <div>Celkový čas hrania: <?=number_format($pole['total_time_played']/3600, 0, '.', ' ')?> h</div>
            </div>

            <div class="stvrte">
                <div>Celkový počet zásahov: <?=number_format($pole['total_shots_hit'], 0,'.',' ')?></div>
                <div>Celkový počet výstrelov: <?=number_format($pole['total_shots_fired'], 0,'.',' ')?></div>
                <div>Celková presnosť: <?php echo round($pole['total_shots_hit']/$pole['total_shots_fired']*100,2) . "%" ?></div>
            </div>

            <div class="piate">
                <div>Celkový počet headshotov: <?=number_format($pole['total_kills_headshot'], 0,'.',' ') ?></div>
                <div>Celkový počet MVP: <?=number_format($pole['total_mvps'], 0,'.',' ') ?></div>
            </div>

            <div class="sieste">
                <div>Celkový počet odohraných zápasov: <?=number_format($pole['total_matches_played'], 0,'.',' ')?></div>
                <div>Celkový počet vyhraných zápasov: <?=number_format($pole['total_matches_won'], 0,'.',' ')?></div>
            </div>

            <div class="siedme">
                <div>Celkový počet odohraných kôl: <?=number_format($pole['total_rounds_played'], 0,'.',' ')?></div>
                <div>Celkový počet vyhratých kôl: <?=number_format($pole['total_wins'], 0,'.',' ')?></div>
            </div>
        </div>
        
        <br>
        <div>
        <p onClick="myFunction()" id="labeltext">
            <i id="block1-1" class="fas fa-angle-double-down"></i> Štatistiky o zbraniach <i id="block1-2" class="fas fa-angle-double-down"></i>
        </p>
        </div>
        
        <div id="myDIV1" style="display:none;">
        <br>
            <table class="zbrane">
                <caption>PISTOLS</caption>
                <tr>
                    <th>Zbraň</th>
                    <th>Počet killov</th>
                    <th>Počet zásahov</th>
                    <th>Počet striel</th>
                    <th>Presnosť</th>
                </tr>
                <tr>
                    <th>Glock-18</th>
                    <td><?=number_format($pole['total_kills_glock'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_glock'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_glock'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_glock']/$pole['total_shots_glock']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>USP-S & P2000</th>
                    <td><?=number_format($pole['total_kills_hkp2000'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_hkp2000'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_hkp2000'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_hkp2000']/$pole['total_shots_hkp2000']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>P250</th>
                    <td><?=number_format($pole['total_kills_p250'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_p250'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_p250'], 0, '.', ' ')?></td>
                    <td><?php echo round(($pole['total_hits_p250']/$pole['total_shots_p250']*100),2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Five-Seven</th>
                    <td><?=number_format($pole['total_kills_fiveseven'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_fiveseven'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_fiveseven'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_fiveseven']/$pole['total_shots_fiveseven']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Tec-9</th>
                    <td><?=number_format($pole['total_kills_tec9'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_tec9'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_tec9'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_tec9']/$pole['total_shots_tec9']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Dual Berettas</th>
                    <td><?=number_format($pole['total_kills_elite'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_elite'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_elite'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_elite']/$pole['total_shots_elite']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Desert Eagle</th>
                    <td><?=number_format($pole['total_kills_deagle'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_deagle'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_deagle'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_deagle']/$pole['total_shots_deagle']*100,2) . "%" ?></td>
                </tr>
            </table>
            <br>
            <table class="zbrane">
                <caption>SMG´s</caption>
                <tr>
                    <th>Zbraň</th>
                    <th>Počet killov</th>
                    <th>Počet zásahov</th>
                    <th>Počet striel</th>
                    <th>Presnosť</th>
                </tr>
                <tr>
                    <th>MP9</th>
                    <td><?=number_format($pole['total_kills_mp9'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_mp9'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_mp9'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_mp9']/$pole['total_shots_mp9']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>MAC-10</th>
                    <td><?=number_format($pole['total_kills_mac10'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_mac10'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_mac10'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_mac10']/$pole['total_shots_mac10']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>PP-Bizon</th>
                    <td><?=number_format($pole['total_kills_bizon'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_bizon'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_bizon'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_bizon']/$pole['total_shots_bizon']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>MP7</th>
                    <td><?=number_format($pole['total_kills_mp7'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_mp7'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_mp7'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_mp7']/$pole['total_shots_mp7']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>UMP-45</th>
                    <td><?=number_format($pole['total_kills_ump45'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_ump45'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_ump45'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_ump45']/$pole['total_shots_ump45']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>P90</th>
                    <td><?=number_format($pole['total_kills_p90'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_p90'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_p90'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_p90']/$pole['total_shots_p90']*100,2) . "%" ?></td>
                </tr>
            </table>
            <br>
            <table class="zbrane">
                <caption>RIFLES</caption>
                <tr>
                    <th>Zbraň</th>
                    <th>Počet killov</th>
                    <th>Počet zásahov</th>
                    <th>Počet striel</th>
                    <th>Presnosť</th>
                </tr>
                <tr>
                    <th>FAMAS</th>
                    <td><?=number_format($pole['total_kills_famas'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_famas'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_famas'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_famas']/$pole['total_shots_famas']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Galil AR</th>
                    <td><?=number_format($pole['total_kills_galilar'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_galilar'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_galilar'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_galilar']/$pole['total_shots_galilar']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>M4A4 & M4A1-S</th>
                    <td><?=number_format($pole['total_kills_m4a1'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_m4a1'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_m4a1'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_m4a1']/$pole['total_shots_m4a1']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>AK-47</th>
                    <td><?=number_format($pole['total_kills_ak47'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_ak47'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_ak47'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_ak47']/$pole['total_shots_ak47']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>AUG</th>
                    <td><?=number_format($pole['total_kills_aug'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_aug'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_aug'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_aug']/$pole['total_shots_aug']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>SG 553</th>
                    <td><?=number_format($pole['total_kills_sg556'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_sg556'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_sg556'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_sg556']/$pole['total_shots_sg556']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>SSG 08</th>
                    <td><?=number_format($pole['total_kills_ssg08'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_ssg08'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_ssg08'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_ssg08']/$pole['total_shots_ssg08']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>AWP</th>
                    <td><?=number_format($pole['total_kills_awp'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_awp'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_awp'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_awp']/$pole['total_shots_awp']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>G3SG1</th>
                    <td><?=number_format($pole['total_kills_g3sg1'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_g3sg1'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_g3sg1'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_g3sg1']/$pole['total_shots_g3sg1']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>SCAR-20</th>
                    <td><?=number_format($pole['total_kills_scar20'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_scar20'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_scar20'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_scar20']/$pole['total_shots_g3sg1']*100,2) . "%" ?></td>
                </tr>
            </table>
            <br>
            <table class="zbrane">
                <caption>HEAVY</caption> 
                <tr>
                    <th>Zbraň</th>
                    <th>Počet killov</th>
                    <th>Počet zásahov</th>
                    <th>Počet striel</th>
                    <th>Presnosť</th>
                </tr>
                <tr>
                    <th>Nova</th>
                    <td><?=number_format($pole['total_kills_nova'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_nova'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_nova'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_nova']/$pole['total_shots_nova']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>XM1014</th>
                    <td><?=number_format($pole['total_kills_xm1014'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_xm1014'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_xm1014'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_xm1014']/$pole['total_shots_xm1014']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>MAG-7</th>
                    <td><?=number_format($pole['total_kills_mag7'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_mag7'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_mag7'], 0, '.', ' ')?></td>
                    <td><?php echo round((($pole['total_hits_mag7']/$pole['total_shots_mag7'])*100),2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Sawed-Off</th>
                    <td><?=number_format($pole['total_kills_sawedoff'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_sawedoff'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_sawedoff'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_sawedoff']/$pole['total_shots_sawedoff']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>M249</th>
                    <td><?=number_format($pole['total_kills_m249'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_m249'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_m249'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_m249']/$pole['total_shots_m249']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Negev</th>
                    <td><?=number_format($pole['total_kills_negev'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_hits_negev'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_negev'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_hits_negev']/$pole['total_shots_negev']*100,2) . "%" ?></td>
                </tr>
            </table>
            <br>
            <table class="zbrane">
                <caption>UTILITIES</caption> 
                <tr>
                    <th>Zbraň</th>
                    <th>Počet killov</th>
                    <th>Počet striel</th>
                </tr>
                <tr>
                    <th>HE Grenade</th>
                    <td><?=number_format($pole['total_kills_hegrenade'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Molotov & Incendiary</th>
                    <td><?=number_format($pole['total_kills_molotov'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Zeus x27</th>
                    <td><?=number_format($pole['total_kills_taser'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_shots_taser'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Knife</th>
                    <td><?=number_format($pole['total_kills_knife'], 0, '.', ' ')?></td>
                </tr>


            </table>
        </div>
        <!--      MAPS STATS         -->
        <div>
        <p onClick="myFunction2()" id="labeltext">
            <i id="block2-1" class="fas fa-angle-double-down"></i> Štatistiky o mapách <i id="block2-2" class="fas fa-angle-double-down"></i>
        </p>
        </div>
        
        <div id="myDIV2" style="display:none;">
        <br>
            <table>
            <caption>ŠTATISTIKY MÁP</caption>
                <tr>
                    <th>Mapa</th>
                    <th>Počet odohratých kôl</th>
                    <th>Počet vyhratých kôl</th>
                    <th>Percentuálna úspešnosť</th>
                </tr>
                <tr>
                    <th>Inferno</th>
                    <td><?=number_format($pole['total_rounds_map_de_inferno'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_inferno'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_inferno']/$pole['total_rounds_map_de_inferno']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Dust II</th>
                    <td><?=number_format($pole['total_rounds_map_de_dust2'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_dust2'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_dust2']/$pole['total_rounds_map_de_dust2']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Train</th>
                    <td><?=number_format($pole['total_rounds_map_de_train'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_train'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_train']/$pole['total_rounds_map_de_train']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Nuke</th>
                    <td><?=number_format($pole['total_rounds_map_de_nuke'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_nuke'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_nuke']/$pole['total_rounds_map_de_nuke']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Vertigo</th>
                    <td><?=number_format($pole['total_rounds_map_de_vertigo'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_vertigo'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_vertigo']/$pole['total_rounds_map_de_vertigo']*100,2) . "%" ?></td>
                </tr>
                <tr>
                    <th>Cobblestone</th>
                    <td><?=number_format($pole['total_rounds_map_de_cbble'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_cbble'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_cbble']/$pole['total_rounds_map_de_cbble']*100,2) . "%" ?></td>                
                </tr>
                <tr>
                    <th>Aztec</th>
                    <td><?=number_format($pole['total_rounds_map_de_aztec'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_aztec'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_aztec']/$pole['total_rounds_map_de_aztec']*100,2) . "%" ?></td>               
                </tr>
                <tr>
                    <th>Office</th>
                    <td><?=number_format($pole['total_rounds_map_cs_office'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_cs_office'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_cs_office']/$pole['total_rounds_map_cs_office']*100,2) . "%" ?></td>               
                </tr>
                <tr>
                    <th>Italy</th>
                    <td><?=number_format($pole['total_rounds_map_cs_italy'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_cs_italy'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_cs_italy']/$pole['total_rounds_map_cs_italy']*100,2) . "%" ?></td>               
                </tr>
                <tr>
                    <th>Assault</th>
                    <td><?=number_format($pole['total_rounds_map_cs_assault'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_cs_assault'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_cs_assault']/$pole['total_rounds_map_cs_assault']*100,2) . "%" ?></td>               
                </tr>
                <tr>
                    <th>Lake</th>
                    <td><?=number_format($pole['total_rounds_map_de_lake'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_lake'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_lake']/$pole['total_rounds_map_de_lake']*100,2) . "%" ?></td>               
                </tr>
                <tr>
                    <th>Safehouse</th>
                    <td><?=number_format($pole['total_rounds_map_de_safehouse'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_safehouse'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_safehouse']/$pole['total_rounds_map_de_safehouse']*100,2) . "%" ?></td>               
                </tr>
                <tr>
                    <th>Sugarcane</th>
                    <td><?=number_format($pole['total_rounds_map_de_sugarcane'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_sugarcane'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_sugarcane']/$pole['total_rounds_map_de_sugarcane']*100,2) . "%" ?></td>               
                </tr>
                <tr>
                    <th>StMarc</th>
                    <td><?=number_format($pole['total_rounds_map_de_stmarc'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_stmarc'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_stmarc']/$pole['total_rounds_map_de_stmarc']*100,2) . "%" ?></td>               
                </tr>
                <tr>
                    <th>Bank</th>
                    <td><?=number_format($pole['total_rounds_map_de_bank'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_de_bank'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_de_bank']/$pole['total_rounds_map_de_bank']*100,2) . "%" ?></td>               
                </tr>
                <tr>
                    <th>Shoots</th>
                    <td><?=number_format($pole['total_rounds_map_ar_shoots'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_ar_shoots'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_ar_shoots']/$pole['total_rounds_map_ar_shoots']*100,2) . "%" ?></td>               
                </tr>
                <tr>
                    <th>Baggage</th>
                    <td><?=number_format($pole['total_rounds_map_ar_baggage'], 0, '.', ' ')?></td>
                    <td><?=number_format($pole['total_wins_map_ar_baggage'], 0, '.', ' ')?></td>
                    <td><?php echo round($pole['total_wins_map_ar_baggage']/$pole['total_rounds_map_ar_baggage']*100,2) . "%" ?></td>               
                </tr>

            </table>
        </div>

        <!--      MAPS STATS         -->
        <div>
        <p onClick="myFunction3()" id="labeltext">
            <i id="block3-1" class="fas fa-angle-double-down"></i> Štatistiky posledného zápasu <i id="block3-2" class="fas fa-angle-double-down"></i>
        </p>
        </div>

        <div id="myDIV3" style="display:none;">
        <br>
            <table>
                <tr>
                    <th>Počet vyhratých kôl na T strane (obidva tímy)</th>
                    <td><?=number_format($pole['last_match_t_wins'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet vyhratých kôl na CT strane (obidva tímy)</th>
                    <td><?=number_format($pole['last_match_ct_wins'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet vyhratých kôl</th>
                    <td><?=number_format($pole['last_match_wins'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Maximálny počet hráčov</th>
                    <td><?=number_format($pole['last_match_max_players'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet killov</th>
                    <td><?=number_format($pole['last_match_kills'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet smrtí</th>
                    <td><?=number_format($pole['last_match_deaths'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Udelený damage</th>
                    <td><?=number_format($pole['last_match_damage'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet MVP</th>
                    <td><?=number_format($pole['last_match_mvps'], 0, '.', ' ')?></td>
                </tr>
                <?php
                    $idcko = $pole['last_match_favweapon_id'];
                    $zbran = '---';
                    switch($idcko){
                        case 1:
                            $zbran="Desert Eagle";
                            break;
                        case 2:
                            $zbran="Dual Berettas";
                            break; 
                        case 3:
                            $zbran="Five-SeveN";
                            break;                   
                        case 4:
                            $zbran="Glock-18";
                            break;
                        case 7:
                            $zbran="AK-47";
                            break;
                        case 8:
                            $zbran="AUG";
                            break;
                        case 9:
                            $zbran="AWP";
                            break;
                        case 10:
                            $zbran="Famas";
                            break;
                        case 11:
                            $zbran="G3SG1";
                            break;
                        case 13:
                            $zbran="Galil AR";
                            break;
                        case 14:
                            $zbran="M249";
                            break;
                        case 16:
                            $zbran="M4A4 & M4A1-S";
                            break;
                        case 17:
                            $zbran="Mac-10";
                            break;
                        case 19:
                            $zbran="P90";
                            break;
                        case 23:
                            $zbran="MP5-SD";
                            break;
                        case 24:
                            $zbran="UMP-45";
                            break;
                        case 25:
                            $zbran="XM1014";
                            break;
                        case 26:
                            $zbran="PP-Bizon";
                            break;
                        case 27:
                            $zbran="MAG-7";
                            break;
                        case 28:
                            $zbran="Negev";
                            break;
                        case 29:
                            $zbran="Sawed-Off";
                            break;
                        case 30:
                            $zbran="Tec-9";
                            break;
                        case 31:
                            $zbran="Zeus x27";
                            break;
                        case 32:
                            $zbran="P2000";
                            break;
                        case 33:
                            $zbran="MP7";
                            break;
                        case 34:
                            $zbran="MP9";
                            break;
                        case 35:
                            $zbran="Nova";
                            break;
                        case 36:
                            $zbran="P250";
                            break;
                        case 38:
                            $zbran="SCAR-20";
                            break;
                        case 39:
                            $zbran="SG 553";
                            break;
                        case 40:
                            $zbran="SSG 08";
                            break;
                        case 41:
                            $zbran="Knife";
                            break;
                        case 42:
                            $zbran="Knife";
                            break;
                        case 43:
                            $zbran="Flashbang";
                            break;
                        case 44:
                            $zbran="HE Grenade";
                            break;
                        case 45:
                            $zbran="Smoke Grenade";
                            break;
                        case 46:
                            $zbran="Molotov";
                            break;
                        case 47:
                            $zbran="Decoy Grenade";
                            break;
                        case 48:
                            $zbran="Incendiary";
                            break;
                        case 49:
                            $zbran="C4";
                            break;
                        case 59:
                            $zbran="Knife";
                            break;
                        case 60:
                            $zbran="M4A4 & M4A1-S";
                            break;
                        case 60:
                            $zbran="USP-S";
                            break;
                        case 63:
                            $zbran="CZ75-Auto";
                            break;
                        case 64:
                            $zbran="R8 Revolver";
                            break;
                        default:
                            $zbran="---";
                            break;
                    }
                ?>
                <tr>
                    <th>Obľúbená zbraň</th>
                    <td><?php echo $zbran?></td>
                </tr>
                <tr>
                    <th>Počet striel s obľúbenou zbraňou</th>
                    <td><?=number_format($pole['last_match_favweapon_shots'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet zásahov s obľúbenou zbraňou</th>
                    <td><?=number_format($pole['last_match_favweapon_hits'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet zabití s obľúbenou zbraňou</th>
                    <td><?=number_format($pole['last_match_favweapon_kills'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Utratené peniaze</th>
                    <td><?=number_format($pole['last_match_money_spent'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet dominancií</th>
                    <td><?=number_format($pole['last_match_dominations'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet pômst</th>
                    <td><?=number_format($pole['last_match_revenges'], 0, '.', ' ')?></td>
                </tr>
            </table>
            <i>Počítajú sa zabitia a smrti aj vo warmupe resp. celkovo</i>
        </div>

                <!--      CHUŤOVEČKY         -->
        <div>
        <p onClick="myFunction4()" id="labeltext">
            <i id="block4-1" class="fas fa-angle-double-down"></i> Chuťovečky <i id="block4-2" class="fas fa-angle-double-down"></i>
        </p>
        </div>
        
        <div id="myDIV4" style="display:none;">
        <br>
            <table>
                <tr>
                    <th>Počet killov s nepriateľovou zbraňou</th>
                    <td><?=number_format($pole['total_kills_enemy_weapon'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet vyhraných "pistol round"</th>
                    <td><?=number_format($pole['total_wins_pistolround'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet "donatnutých" zbratí</th>
                    <td><?=number_format($pole['total_weapons_donated'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet rozbitých okien(staré typy okien - trieštili sa na kúsky)</th>
                    <td><?=number_format($pole['total_broken_windows'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet killov flashnutých nepriateľov</th>
                    <td><?=number_format($pole['total_kills_enemy_blinded'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet knife killov (obidvaja hráči mali v ruke knife)</th>
                    <td><?=number_format($pole['total_kills_knife_fight'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet killov proti neprateľovi, ktorý mal "zoomnuté"</th>
                    <td><?=number_format($pole['total_kills_against_zoomed_sniper'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet killov na hráčovi, ktorému dominuješ</th>
                    <td><?=number_format($pole['total_domination_overkills'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet pômst</th>
                    <td><?=number_format($pole['total_revenges'], 0, '.', ' ')?></td>
                </tr>
                <tr>
                    <th>Počet dominancií</th>
                    <td><?=number_format($pole['total_dominations'], 0, '.', ' ')?></td>
                </tr>

            </table>
        </div>



        <script>
            function myFunction() {
                var x = document.getElementById("myDIV1");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    //document.getElementById("zmena").className = "fas fa-angle-double-up";
                    //document.getElementById("zmena1").className = "fas fa-angle-double-up";
                    document.getElementById("block1-1").style.transform = "rotate(-180deg)";
                    document.getElementById("block1-2").style.transform = "rotate(-180deg)";
                } else {
                    x.style.display = "none";
                    // document.getElementById("zmena").className = "fas fa-angle-double-down";
                    // document.getElementById("zmena1").className = "fas fa-angle-double-down";
                    document.getElementById("block1-1").style.transform = "rotate(0deg)";
                    document.getElementById("block1-2").style.transform = "rotate(0deg)";
                }
            }
            function myFunction2() {
                var x = document.getElementById("myDIV2");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    document.getElementById("block2-1").style.transform = "rotate(-180deg)";
                    document.getElementById("block2-2").style.transform = "rotate(-180deg)";
                } else {
                    x.style.display = "none";
                    document.getElementById("block2-1").style.transform = "rotate(0deg)";
                    document.getElementById("block2-2").style.transform = "rotate(0deg)";
                }
            }
            function myFunction3() {
                var x = document.getElementById("myDIV3");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    document.getElementById("block3-1").style.transform = "rotate(-180deg)";
                    document.getElementById("block3-2").style.transform = "rotate(-180deg)";
                } else {
                    x.style.display = "none";
                    document.getElementById("block3-1").style.transform = "rotate(0deg)";
                    document.getElementById("block3-2").style.transform = "rotate(0deg)";
                }
            }
            function myFunction4() {
                var x = document.getElementById("myDIV4");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    document.getElementById("block4-1").style.transform = "rotate(-180deg)";
                    document.getElementById("block4-2").style.transform = "rotate(-180deg)";
                } else {
                    x.style.display = "none";
                    document.getElementById("block4-1").style.transform = "rotate(0deg)";
                    document.getElementById("block4-2").style.transform = "rotate(0deg)";
                }
            }
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