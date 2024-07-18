<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <meta name="robots" content="noodp,noydir" />

    <title>SK players</title>
    <meta name="description" content="Oficial SK players web" />


    <link rel="stylesheet" href="style.css?version=5">

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>
</head>

<body>
    <header>
        <div class="hl-nav">
            <img src="img/sk_logo_s.png" alt="sk_s_animation" width="4%" class="sk_logo">
            <img src="img/sk_logo_text.png" alt="sk_s" width="8%" class="sk_logo_text">
            <div class="links">
                <!-- <a href="https://discord.gg/6uxHBdYA3v" target="_blank" class="discord_header"><i class="fab fa-discord"> SK players</i></a>
                <a href="https://steamcommunity.com/groups/skkplayers" target="_blank" class="steam_header"><i class="fab fa-steam"> SK players</i></a> -->
                <!-- <a class="login" href="./prihlasenie/">Login</a> -->
            
                <div class="login_odkaz">
                    <a class="login" href="/prihlasenie/"><i class="fas fa-sign-in-alt"></i></a>
                    <div class="hide">Login</div>
                </div>
                
            </div>
            
            
            
        </div>
        
        <div class="banner">
            <h2 class="banner_title">SK players</h2>
            <!-- <p class="banner_text">
                <a href="https://discord.gg/6uxHBdYA3v" target="_blank" class="discord"><i class="fab fa-discord"> SK players</i></a>
            </p> -->

            <p class="icon">
                <i class="far fa-arrow-alt-circle-down" id="ScrollDown"></i>
            </p>
        </div>


    </header>
    
    

    <!-- <h2 class="csgo_stats_title">CSGO stats</h2> -->
    <div class="dc_bot" onclick="godcbot()">
    </div>

    <div class="game_stats" onclick="gogamestats()">
    </div>

    <div class="game_updates" onclick="gogameupdates()">
    </div>

    <h2 class="jusko_hra_title">Hra od @Jusmejtr (v1.1)</h2>
    <div onclick="hra()" class="jusko_hra">
    </div>

    <br><br>

    <footer>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/footer-hlavna.php';
    ?>
    </footer>
</body>

<script>
    //otvor csgo stats
    function gogamestats() {
        //window.open("./csgostats/", '_blank').focus();
        window.location.href = "/game-stats/";
    }
    function gogameupdates() {
        window.location.href = "/game-updates/";
    }
    function godcbot() {
        window.location.href = "/dcbot/";
    }

    function hra() {
        window.location.href = "/game/";
        target = "_blank";
    }

    //animacia nav pri scroll down
    window.addEventListener("scroll", function() {
        var nav = document.querySelector(".hl-nav");
        nav.classList.toggle("sticky", window.scrollY > 0);
    })

    //zmena obrazku csgo
    //var csgoimg = ['img/csgo1.png'];
    //document.getElementsByClassName('csgo_stats')[0].style.backgroundImage = 'url(' + csgoimg[Math.floor(Math.random() * csgoimg.length)] + ')';

    //scroll down button
    const btnScrollDown = document.querySelector("#ScrollDown")
    btnScrollDown.addEventListener("click", function() {
        window.scrollTo(0, 710);
    })

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
</script>

</html>
