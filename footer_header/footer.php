<link rel="stylesheet" href="/css/footer/main.css?version=2">

<footer>
    <div class="links">
        <div class="steam" onclick="openSteamGroup()"><i class="fa-brands fa-steam"></i> Join Steam</div>
        <div class="discord" onclick="openDiscord()"><i class="fa-brands fa-discord"></i> Join DISCORD</div>
    </div>
    <div class="author">Created by Jusmejtr with ❤️</div>
    <div class="copyright">&copy; SK players 2018-<?php echo date("Y") ?></div>
</footer>
<script>
    function openDiscord(){
        return window.open("https://discord.gg/6uxHBdYA3v");
    }
    function openSteamGroup(){
        return window.open("https://steamcommunity.com/groups/skkplayers");
    }
</script>