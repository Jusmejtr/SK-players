<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SK players</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel="stylesheet" href="/css/logines/registracia.css">

    <script>
        function ocko() {
            let show_hide = document.querySelector('#show_hide');
            if (show_hide.className == "fa fa-eye") {
                show_hide.className = "fa fa-eye-slash";
                reg_heslo.type = "text";
            } else {
                show_hide.className = "fa fa-eye";
                reg_heslo.type = "password";
            }
        }

        function ocko2() {
            let show_hide = document.querySelector('#show_hide2');
            if (show_hide.className == "fa fa-eye") {
                show_hide.className = "fa fa-eye-slash";
                reg_heslo2.type = "text";
            } else {
                show_hide.className = "fa fa-eye";
                reg_heslo2.type = "password";
            }
        }
    </script>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>

</head>

<body onload="start('meno')">
    <div class="kos">
        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-firestore.js"></script>
        <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>


        <script src='/javascript/login.js?version=7'></script>

        <h1 class="login">Registrácia</h1>

        <form method="POST">
            <i class="fa fa-user" aria-hidden="true"></i>
            <div class="meno">Meno</div> <br> <input type="text" name="reg_meno" id="reg_meno" required autocomplete="off" placeholder="Merlin#4578"><br><br>
            <i class="fa fa-lock" aria-hidden="true"></i> <br>
            <div class="heslo">Heslo</div> <br> <input type="password" name="reg_heslo" id="reg_heslo" required><br><br>
            <i class="fa fa-eye" aria-hidden="true" id="show_hide" onclick="ocko()"></i>
            <i class="fa fa-lock" aria-hidden="true"></i> <br>
            <div class="heslo">Zopakuj heslo</div> <br> <input type="password" name="reg_heslo2" id="reg_heslo2" required><br><br>
            <i class="fa fa-eye" aria-hidden="true" id="show_hide2" onclick="ocko2()"></i>
        </form><br> <br>

        <button type="button" class="link" onclick="registracia()">Registruj sa</button> <br><br>
        <button type="button" class="link" onclick="go_prihlasenie()">Späť na prihlásenie</button> <br>
    </div>
    <p id="reg_textik"></p>

</body>

</html>