<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SK players</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel="stylesheet" href="/css/prihlaseny/mainik.css?version=5">

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>
</head>

<body onload="log_start('meno', 'id', 'rola')">
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-firestore.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>


    <script src='/javascript/loged.js?version=6'></script>

    <header>    
        <img src="/obrazky/sk_logo.png" alt="SK players" width="8%" height="70%" onclick="gologo()">
       
        <p id="log-uvod" class="rola"></p>
        
        <p id="stav_coinov" class="coiny"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i></i>Loading...</p>
        
        <div class="log-out_odkaz">
            <a href="#" onclick="odhlasenie()" class="log-out"><i class="fas fa-sign-out-alt"></i></a> 
            <div class="hide">Log out</div>
        </div>
    </header>

    <div class="novinka">
        <!-- <div class="novinka-uvodny-text">!!!</div>
        <div> Šťastné a veselé vianoce </div>
        <div class="novinka-uvodny-text">!!!</div> -->
    </div>

    
    <div class="odkazy">
        <a href="/economy/daily/">Daily</a>
        <a href="/economy/gamble/">Gamble</a>
        <a href="/economy/transfer/">Transfer</a>
        <a href="/economy/stats/">Štatistiky</a>
        <a href="/economy/shop/">Shop</a>
        <a href="/economy/multiply/">Multiply</a>
        <a href="/economy/top/">Top</a>
        <a href="/economy/profile/">Profil</a>
    </div>
    
    <footer style="position: fixed; bottom: 0;">
        <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        require_once $path . '/footer_header/footer.php';
        ?>
    </footer>
</body>

</html>