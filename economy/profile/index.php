<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SK players</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel="stylesheet" href="/css/prihlaseny/profil.css?version=9">

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>
</head>

<body onload="pro_start('meno', 'id', 'rola')">
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-firestore.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>


    <script src='/javascript/profil.js?version=17'></script>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/header.php';
    ?>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/nav.php';
    ?>

    <div class="main">
        <div class="top">

            <div class="photo">
                <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/271deea8-e28c-41a3-aaf5-2913f5f48be6/de7834s-6515bd40-8b2c-4dc6-a843-5ac1a95a8b55.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzI3MWRlZWE4LWUyOGMtNDFhMy1hYWY1LTI5MTNmNWY0OGJlNlwvZGU3ODM0cy02NTE1YmQ0MC04YjJjLTRkYzYtYTg0My01YWMxYTk1YThiNTUuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.BopkDn1ptIwbmcKHdAOlYHyAOOACXW0Zfgbs0-6BY-E">
            </div>
            <div class="user_info">
                <div id="name"></div>
                <div id="userid"></div>
            </div>
        </div>

        <div class="middle">
            <div class="title">
                <div class="account">Account</div>
            </div>
            <div class="data">
                <div class="username space">
                    <div>Login name</div>
                    <div class="value">
                        <input type="text" class="input" id="username" disabled>
                        <!-- <div class="edit" onclick="edit('username', this)">EDIT</div> -->
                    </div>
                </div>
                <div class="password space">
                    <div>Password</div>
                    <div class="value">
                        <input type="password" class="input" id="password" disabled>
                        <div class="edit" onclick="edit('password', this)">EDIT</div>
                    </div>
                </div>
                <div class="trade_url space">
                    <div>Trade URL</div>
                    <div class="value">
                        <input type="text" class="input" id="trade_url" disabled>
                        <div class="edit" onclick="edit('trade_url', this)">EDIT</div>
                    </div>
                </div>
            </div>

            <div class="title">
                <div class="account">Status</div>
            </div>
            <div class="data">
                <div class="vip space">
                    VIP <div id="VIP_result" class="value"></div>
                </div>
                <div class="color-name space">
                    <div>Color name</div>
                    <div id="meno_result" class="value"></div>
                </div>
            </div>
        </div>
    </div>



</body>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/footer.php';
    ?>

</html>
