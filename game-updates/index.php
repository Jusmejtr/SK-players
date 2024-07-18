<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SK players</title>

    <link rel="stylesheet" href="../css/game/game-updates.css?version=6">

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>
</head>
<body>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/hlavicka-fixed.php';
    ?>

    <h1 class="center">GAME UPDATES</h1>
    <div class="stranka">
        <div class="vlavo">
            <div class="ets" onclick="goets()">

            </div>
            <div class="gta" onclick="gogta()">

            </div>
            <div class="golf" onclick="gogolf()">

            </div>
        </div>
        <div class="vpravo">
            <div class="slapshot" onclick="goslapshot()">

            </div>
            <div class="smite" onclick="gosmite()">
                
            </div>
            <div class="dead-by-daylight" onclick="godeadbydaylight()">
                
            </div>
        </div>
    </div>

</body>
<script>
    function goets() {
        window.location.href = "./ets2/";
    }
    function goslapshot() {
        window.location.href = "./slapshot-rebound/";
    }
    function gogta() {
        window.location.href = "./gta/";
    }
    function gosmite() {
        window.location.href = "./smite/";
    }
    function gogolf() {
        window.location.href = "./golf-with-your-friends/";
    }
    function godeadbydaylight() {
        window.location.href = "./dead-by-daylight/";
    }

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

</script>
</html>