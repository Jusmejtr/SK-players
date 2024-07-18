<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SK players</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel="stylesheet" href="/css/prihlaseny/stats.css?version=6">

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>

</head>

<body onload="stats_start('meno', 'id', 'rola')">
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-firestore.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>


    <script src='/javascript/stats.js?version=7'></script>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/header.php';
    ?>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/nav.php';
    ?>

    <div class="main">
        <p class="vyber">
            Vyber si hráča:
            <select name="vyber" id="vyber" onclick="zobraz_hracov(); this.onclick=null;" onchange="refresh_hracov()">
                <option value="-" id="vymaz">Vyber si hráča</option>
            </select>
        </p>

        <table>
            <tr>
                <th>Meno</th>
                <td id="t-meno"></td>
            </tr>
            <tr>
                <th>Pregamblené</th>
                <td id="t-pregamblene"></td>
            </tr>
            <tr>
                <th>Givnuté</th>
                <td id="t-givnute"></td>
            </tr>
            <tr>
                <th>Počet výhier v gamble</th>
                <td id="t-gamblewin"></td>
            </tr>
            <tr>
                <th>Počet prehier v gamble</th>
                <td id="t-gamblelose"></td>
            </tr>
            <tr>
                <th>Počet vyhratých coinov v gamble/multiply</th>
                <td id="t-sumawin"></td>
            </tr>
            <tr>
                <th>Počet prehratých coinov v gamble/multiply</th>
                <td id="t-sumalose"></td>
            </tr>
        </table>
        <p id="percento" class="percento"></p>

    </div>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/footer.php';
    ?>

</body>

</html>