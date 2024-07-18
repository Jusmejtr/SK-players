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
</head>

<body>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/hlavicka-fixed.php';
    ?>

    <br><br>
    <h2 class="jusko_hra_title">Hra od @Jusmejtr (v1.1)</h2>
    <br><br>
    <button onclick="hra()">Stiahni hru</button><br><br><br><br><br>

    <br><br>
    <?php  
    echo "<table class='blueTable' id='myTable'>";
    echo "<caption>Speedrun tabuľka</caption>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Hráč</th>";
    echo "<th>Čas</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    
    $dir = "../gamemaker_speedrun/";
      
    $a = scandir($dir);
    
    $velkost = count($a);
    $kolko = $velkost - 1; //celkovy pocet veci v array (-1 lebo sa berie aj 0)
    //v array je 0 a 1 korenovy adresar, berieme 2 a vyssie

    $pole = [];//nazvy suborov

    $poradie = [];

    for($i=2;$i<=$kolko;$i++){//berieme 2 a vyssie az po posledneho, zapis nazvov suborov do pole
        $pole[$i-2]= $a[$i];//o 2 nizsie kvoli korenovemu adresaru
    }

    for($i=0;$i<count($pole);$i++){
        $subor = file("../gamemaker_speedrun/". $pole[$i]);//otvori subor hraca c.1
        $riadkov = count($subor);//zisti pocet riadkov
        $cas = [];

        $casik = 999;//tu sa ulozi najlepsi cas daneho hraca

        for($j=0;$j<$riadkov;$j++){
            $cas[$j] = $subor[$j];//subor[$j] je subor a v nom riadok 0 a zapise ho do cas[0]
            $cas[$j]= strtotime($cas[$j]);//string na cas da

            if($casik < date("H:i", $cas[$j])){
                
            }else{
                $casik = date("H:i", $cas[$j]);
            }
        }
        $meno = substr($pole[$i],0,-4);
        $nick = str_replace('-','#',$meno);


        echo "<tr>";
        echo "<td>". $nick . "</td>";
        echo "<td>" . $casik . "</td>";
        echo "</tr>";

    }

    echo "</tbody>";
    echo "</tr>";
    echo "</table>";
?>

</body>

<script>
    //stiahni hru
    function hra() {
        window.open("../Hra.zip");
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
    // const btnScrollDown = document.querySelector("#ScrollDown")
    // btnScrollDown.addEventListener("click", function() {
    //     window.scrollTo(0, 710);
    // })

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

<footer>
<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/footer-hlavna.php';
    ?>
</footer>

</html>
