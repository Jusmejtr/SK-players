<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SK players</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel="stylesheet" href="/css/prihlaseny/multiply.css?version=5">

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>

</head>

<body onload="mul_start('meno', 'id', 'rola')">
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-firestore.js"></script>
        <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>


    <script src='/javascript/multiply.js?version=6'></script>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/header.php';
    ?>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/nav.php';
    ?>


    <div class="input">   
        Suma: <br> <input type="number" id="suma" min="5" max="1000000" onblur="ukaz_footer()" onfocus="skry_footer()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
    </div>
    <div class="rovina">
    <button type="button" id="tlacidlo3" onclick="multiply3('meno', 'id')">Multiply X3</button>
    <button type="button" id="tlacidlo4" onclick="multiply4('meno', 'id')">Multiply X4</button>
    <button type="button" id="tlacidlo5" onclick="multiply5('meno', 'id')">Multiply X5</button>
    </div>

    <table id="tabulka">
        <tr>
            <th>Poradie</th>
            <th>Stávka</th>
            <th>Multiply</th>
            <th>Výsledok</th>
        </tr>
    </table>

</body>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/footer.php';
    ?>


</html>