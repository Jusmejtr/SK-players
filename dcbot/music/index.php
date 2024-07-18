<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/game/style.css?version=10">


    <title>SK players</title>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>
    <style>
        body{
            position: relative;
            min-height: 100vh;
        }
        ol{
            font-size: 120%;
            list-style-type: none;
        }
        #filter{
            display: flex;
            margin-left: auto;
            margin-right: auto;
            font-size: 125%;
            margin-top: 1%;
        }
        footer{
            position: absolute;
            bottom: -20%;
            width: 100%;
        }
        @media only screen and (max-width: 768px) {
            footer {
                bottom: -26%;
            }
        }
    </style>
</head>

<body>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/hlavicka-fixed.php';
    ?>
    <input type="text" id="filter" onkeyup="filtrovanie()" placeholder="Search">
    <ol id="zoznam">
<?php
    $subor = file("../songy.txt");
    $riadky = count($subor);
    for($j=0;$j<$riadky;$j++){
        //$meno = substr($subor[$j],44);
        $a = $j + 1;
        echo "<li><b>" . $a . ". </b>" . $subor[$j] . "</li>";
    }
?>
</ol>
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
    function filtrovanie() {
        var input, filter, ul, li, i, txtValue;
        input = document.getElementById("filter");
        filter = input.value.toUpperCase();
        ul = document.getElementById("zoznam");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            txtValue = li[i].textContent || li[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

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

<footer>
<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/footer-hlavna.php';
    ?>
</footer>

</html>
