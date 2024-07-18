<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SK players</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel="stylesheet" href="../css/logines/zabudnuty.css">


    <script>
        function ocko() {
            let show_hide = document.querySelector('#show_hide');
            if (show_hide.className == "fa fa-eye") {
                show_hide.className = "fa fa-eye-slash";
                zab_hes.type = "text";
            } else {
                show_hide.className = "fa fa-eye";
                zab_hes.type = "password";
            }
        }

        function ocko2() {
            let show_hide = document.querySelector('#show_hide2');
            if (show_hide.className == "fa fa-eye") {
                show_hide.className = "fa fa-eye-slash";
                zab_hes2.type = "text";
            } else {
                show_hide.className = "fa fa-eye";
                zab_hes2.type = "password";
            }
        }
    </script>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>
</head>

<body>
    <div class="kos">
        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js "></script>
        <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-firestore.js "></script>
        <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>


        <script src='/javascript/login.js?version=6'></script>

        <h1 class="reset_hesla">Resetovanie hesla</h1>

        <form method="post">
            <i class="fa fa-user" aria-hidden="true"></i>
            <div class="meno">Discord meno</div> <br> <input type="text" name="meno" id="zab_meno" placeholder="Merlin#4357" required autocomplete="off"><br><br>
            <i class="fa fa-lock" aria-hidden="true"></i>
            <div class="heslo">Zadajte nové heslo</div> <br> <input type="password" name="hes" id="zab_hes" required><br><br>
            <i class="fa fa-eye" aria-hidden="true" id="show_hide" onclick="ocko()"></i>
            <i class="fa fa-lock" aria-hidden="true"></i>
            <div class="heslo">Zadajte znovu heslo</div> <br> <input type="password" name="hes2" id="zab_hes2" required><br><br>
            <i class="fa fa-eye" aria-hidden="true" id="show_hide2" onclick="ocko2()"></i>


        </form> <br> <br>
        <button type="button" onclick="potvrdenie()" class="link">Resetovať heslo</button> <br> <br>
        <button type="button" class="link" onclick="go_prihlasenie()">Späť na prihlásenie</button> <br>

    </div>
    <p id='resetik'></p>
</body>

</html>