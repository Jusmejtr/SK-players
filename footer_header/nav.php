<link rel="stylesheet" href="/css/nav.css?version=2">

<nav>
    <div class="navbar">
        <div class="container nav-container" id="nav-container">
            <div class="hamburger-lines" onclick="animation()">
                <span class="line line1" id="line1"></span>
                <span class="line line2" id="line2"></span>
                <span class="line line3" id="line3"></span>
            </div>
            <div class="menu-items" id="menu-items">
                <li><a href="/economy/daily">Daily</a></li>
                <li><a href="/economy/gamble">Gamble</a></li>
                <li><a href="/economy/transfer">Transfer</a></li>
                <li><a href="/economy/stats">Stats</a></li>
                <li><a href="/economy/shop">Shop</a></li>
                <li><a href="/economy/multiply">Multiply</a></li>
                <li><a href="/economy/top">Top</a></li>
                <li><a href="/economy/profile">Profile</a></li>
            </div>
        </div>
    </div>
</nav>

      <script>
    let state = false;
    function animation(){
        const lines = ["line1", "line2", "line3"];
        if(state == true){
            //hide
            document.getElementById("menu-items").style.transform = "";
            document.getElementById(lines[0]).style.transform = "rotate(0)";
            document.getElementById(lines[1]).style.transform = "scaleY(1)";
            document.getElementById(lines[2]).style.transform = "rotate(0)";
            document.getElementById("menu-items").style.backgroundColor = "rgba(0,0,0,1)";
            state = false;
            return;
        }
        //show
        document.getElementById("menu-items").style.transform = "translateX(0)";
        document.getElementById(lines[0]).style.transform = "rotate(45deg)";
        document.getElementById(lines[1]).style.transform = "scaleY(0)";
        document.getElementById(lines[2]).style.transform = "rotate(-45deg)";
        document.getElementById("menu-items").style.backgroundColor = "rgba(0,0,0,0.8)";
        let userHeight = document.documentElement.clientHeight;
        userHeight += 100;
        document.getElementById("menu-items").style.height = userHeight;
        console.log(userHeight);
        state = true;
    }

</script>