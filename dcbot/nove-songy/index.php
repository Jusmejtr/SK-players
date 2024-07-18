<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SK players</title>

    <link rel="stylesheet" href="/css/zvysok/nove_songy.css">

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


    <form action="#" method="post">
        <h1>Zadaj YouTube URL</h1>
        <br>
        <input type="text" name="url_adresa" id="url">
        <br>
        <!-- <button type="submit" name="odosli">ODOŠLI</button> -->
        <h2>Z dôvodu nulovej účasti na pridávaní pesničiek boli chuťovečky odstránené</h2>
    </form>
    <?php

    if(isset($_POST['odosli'])){
        $url = $_POST['url_adresa'];
        $cesta = 'songy.txt';
        file_put_contents($cesta, "$url\n", FILE_APPEND); //Create txt file from string you will send from gamemaker
        echo '<script>alert("Úspešne si odoslal URL")</script>';
    }
    ?>

</body>

<footer>
<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/footer-hlavna.php';
    ?>
</footer>

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

</script>
</html>