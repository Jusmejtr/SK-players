<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SK players</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>


    <link rel="stylesheet" href="/css/logines/main.css?version=5">
    
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>
    <script>
        function ocko() {
            let show_hide = document.querySelector('#show_hide');
            if (show_hide.className == "fa-solid fa-eye") {
                show_hide.className = "fa-solid fa-eye-slash";
                hl_heslo.type = "text";
            } else {
                show_hide.className = "fa-solid fa-eye";
                hl_heslo.type = "password";
            }
        }
    </script>

</head>

<body onload="start('meno')">
    <div class="kos">
        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-firestore.js"></script>
        <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>

        <script src='/javascript/login.js?version=6'></script>

        <h1 class="login">Prihlásenie</h1>

        <form method="POST">
            <i class="fa fa-user" aria-hidden="true"></i>
          <div class="meno">Meno</div> <br> <input type="text" name="hl_meno" id="hl_meno" required autocomplete="off" placeholder="Merlin#4578"><br><br>
            <i class="fa fa-lock" aria-hidden="true"></i> <br>
            <div class="heslo">Heslo</div> <br> <input type="password" name="hl_heslo" id="hl_heslo" required><br><br>
            <i class="fa-solid fa-eye" aria-hidden="true" id="show_hide" onclick="ocko()"></i>
        </form><br> <br>

        <button type="button" class="prihlasit" onclick="prihlasenie()">Prihlásiť</button> <br>
        <a class="neviem" href="/zabudnute_heslo/">Zabudol si heslo?</a><br>
        <button class="registracia" onclick="go_registracia()">Registrácia</button>
         <a href="https://discord.gg/6uxHBdYA3v" target="_blank" class="discord"><i class="fab fa-discord"> SK players</i></a>   
        <br>

    </div>

    <p id="hl_textik"></p>

</body>

</html>
