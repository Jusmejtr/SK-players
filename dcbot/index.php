<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SK bot Docs</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>
</head>
<body>
    <header>
        <div class="logo">
            <img src="./img/skplayers_logo.png" onclick="gomain()" alt="SK players logo" width="180px">
        </div>
        <div class="links">
            <a href="./docs/">Documentation</a>
            <a href="https://github.com/Jusmejtr/SKbot" target="_blank">Github</a>
            <a href="https://discord.com/api/oauth2/authorize?client_id=662288447276580875&permissions=3758484550&scope=bot" target="_blank" class="invite">Invite Bot</a>
        </div>
    </header>
    <div class="main-title">
        <img class="text" src="./img/skbot_text.png" alt="SK BOT" width="40%">
        <button class="get-started" onclick="godocs()">GET STARTED</button>
    </div>
    <div class="main-text">
        <h1>About</h1>
        <p>This bot is built on <a href="https://nodejs.org/en/" target="_blank"><b>NODE.JS</b></a> with <a href=""><b>discord.js</b></a> library.
        
        </p>
    </div>
    <footer>
        <div class="author">Created by Jusmejtr with ❤️</div>
        <div class="copyright">&copy; SK players 2018-2022</div>
    </footer>
    
</body>
<script>
    function godocs(){
        return window.location.href = "./docs/";
    }
    function gomain(){
        return window.location.href = "/";
    }
</script>
</html>