<!DOCTYPE html>
<html lang="en">

<head>
<?php header('Access-Control-Allow-Origin: *'); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/game/game-vlozenie-id.css?version=5">
    <link rel="stylesheet" href="/css/game/business.css?version=5">

    
    <title>SK players</title>
    
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>
    <style>
        #friends{
            font-family: Helvetica, sans-serif;
            display: flex;
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, 0%);
            border: 1px solid black;
            border-radius: 10px;
            padding: 0.5%;
            background-color: lightgray;
            cursor: pointer;
        }
        #text{
            display: grid;
            place-items: center;
            margin-left: 5px;
        }
        .okno {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
        }

        .okno-obsah {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 70%;
        display: flex;
        justify-content: center;
        position: relative;
        flex-direction: column;
        text-align: center;
        align-items: center;
        }

        .zavri {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        right: 1%;
        top: 1%;
        }

        .zavri:hover,
        .zavri:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        }
        #okno input{
            width: 400px;
            height: 30px;
        }
        #pridat_button {
            background: #3498db;
            background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
            background-image: -moz-linear-gradient(top, #3498db, #2980b9);
            background-image: -ms-linear-gradient(top, #3498db, #2980b9);
            background-image: -o-linear-gradient(top, #3498db, #2980b9);
            background-image: linear-gradient(to bottom, #3498db, #2980b9);
            -webkit-border-radius: 28;
            -moz-border-radius: 28;
            border-radius: 28px;
            font-family: Arial;
            color: #ffffff;
            height: 36px;
            padding: 10px 20px 10px 20px;
            text-decoration: none;
        }

        #pridat_button:hover {
            background: #3cb0fd;
            background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
            background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
            background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
            background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
            background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
            text-decoration: none;
        }
        #friendlist{
            padding: 1%;
        }
        .hrac{
            border: 1px solid black;
            display: flex;
            padding: 5%;
            width: 100%;
        }
        .hrac p{
            display: grid;
            place-items: center;
        }
    </style>
</head>

<?php
    if(isset($_POST["odosli"])){
        $kluc = $_POST["vstup"];
    

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


        $json = json_decode(file_get_contents($api_url),true);//json s udajmi hraca ako je meno, fotka, link ...

        //$json = file_get_contents($api_url);
        $a = $json['response']['players'][0]['steamid'] . "°" . $json['response']['players'][0]['personaname'] . "°" . $json['response']['players'][0]['avatarmedium'];
        echo "
            <script>
                let kolko = localStorage.length;
                localStorage.setItem(kolko, '".$a."');
                window.location.href = 'https://skplayers.eu/game-stats/business-tour/';
            </script>
        ";
    }
?>


<body>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/hlavicka-fixed.php';
    ?>
    <div id="test">

    </div>

    <div id="friends">
        <img src="https://img.icons8.com/ios-filled/30/000000/add-user-group-man-man--v1.png"/>
        <div id="text">FRIENDS</div>
    </div>

    <div id="okno" class="okno">

        <div class="okno-obsah" id="okno-obsah">
            <span class="zavri">&times;</span>
            <h1>FRIENDS</h1>
            <div class="test">
                <form method="post">
                    <input type="text" placeholder="Steam profile URL / Steam ID" id="input_text" name="vstup">
                    <button id="pridat_button" name="odosli">PRIDAŤ</button>
                </form>
            </div>
            <div id="friendlist">

            </div>
        </div>

    </div>


    <div class="ID">
        <form action="business.php" method="post">
        Zadaj svoje steamID:<br> <br> <input type="text" name="steamidcko">
        <input type="submit" value="Odošli" name="odosli">
        </form>
        
        <div class="nevies_id">
        Zadaj svoj steam link, ID alebo steamID nickname <br>
        Nezabudni, musíš mať nastavený verejný účet
        </div>
    </div>
</body>
    <script>
    //animacia loga
    jQuery.easing['jswing'] = jQuery.easing['swing'];

    jQuery.extend(jQuery.easing, {

        easeInOutQuart: function(x, t, b, c, d) {
            if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
            return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
        }
    });

    function spin() {
        var $myElm = $(".sk_logo");

        function rotate(degrees) {

            $myElm.css({
                '-webkit-transform': 'rotate(' + degrees + 'deg)',
                '-moz-transform': 'rotate(' + degrees + 'deg)',
                '-ms-transform': 'rotate(' + degrees + 'deg)',
                'transform': 'rotate(' + degrees + 'deg)'
            });


        }

        $({
            deg: 0
        }).animate({
            deg: 360 * 40
        }, {
            duration: 7000,
            easing: "easeInOutQuart",
            step: function(now) {
                var deg = now < 6000 || now > 8000 ? now / 8 : now;
                rotate(deg);
            }
        });
    }

    spin();

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

    //friends system
    $('#friends').click(function(){
        document.getElementById("okno").style.display = "block";
        zobraz_kamaratov();
    });
    $('.zavri').click(function(){
        document.getElementById("okno").style.display = "none";
    });

    if(typeof(Storage) !== "undefined"){

    }else{
        document.getElementById("pridat_button").style.display = "none";
        document.getElementById("input_text").placeholder ="Používaš nepodporovaný prehliadač"
    }

    function zobraz_kamaratov(){
        let pocet = localStorage.length;
        let divko = document.getElementById("friendlist");
        for(let i=0; i<pocet; i++){
            let textik = localStorage.getItem(i);
            let args = textik.split('°');

            const hrac = document.createElement("div");
            hrac.className = "hrac";
            divko.appendChild(hrac);

            const logo = document.createElement("img");
            logo.setAttribute("src", args[2]);
            hrac.appendChild(logo);
            const meno = document.createElement("p");
            meno.innerText = args[1];
            hrac.appendChild(meno);
        }
    }
    
</script>
</html>
