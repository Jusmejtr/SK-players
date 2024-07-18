<?php include ('../settings.php');?>

<!DOCTYPE html>
<html lang="en">
<link href="design.css" rel="stylesheet">

<?php include ("../template/header.php");?>

<body>

    <!-- Navigation -->
    <?php include_once("nav.php");?>

    <!-- Page Content -->
    <div class="container">
        <div class="vyber">
            <div class="menu1" id="activated" onclick="menu1()">
                <div class="textik">Non VIP</div>
                <div class="okolo1"></div>
            </div>
            <div class="menu2" onclick="menu2()">
                <div class="textik">VIP</div>
                <div class="okolo2"></div>
            </div>

        </div>    
    </div>
    <div id="nonvip">
        <div class="commands">
            <div class="box">
                <div class="Ctitle">
                    !ws
                </div>
                <div class="Ctext">
                    Change skin
                </div>
            </div>

            <div class="box">
                <div class="Ctitle">
                    !knife
                </div>
                <div class="Ctext">
                    Change knife
                </div>
            </div>

            <div class="box">
                <div class="Ctitle">
                    !gloves
                </div>
                <div class="Ctext">
                    Change gloves
                </div>
            </div>

            <div class="box">
                <div class="Ctitle">
                    !gun
                </div>
                <div class="Ctext">
                    Select guns for specific round type
                </div>
            </div>
        </div>
    </div>
    <div id="vip" style="display: none">
    <div class="commands">
            <div class="box">
                <div class="Ctitle">
                    !agents
                </div>
                <div class="Ctext">
                    Choose your favorite agent
                </div>
            </div>
            <div class="box">
                <div class="Ctitle">
                    !taser
                </div>
                <div class="Ctext">
                    You get 33% chance of getting taser on round start
                </div>
            </div>
            <div class="box">
                <div class="Ctitle">
                    !music
                </div>
                <div class="Ctext">
                    Change your music kit
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include ('../template/footer.php');?>

</body>

</html>
<script>
    function menu1(){//non vip
        document.getElementById("vip").style.display = "none";
        document.getElementById("nonvip").style.display = "block";
        document.getElementsByClassName("menu1")[0].id = "activated";
        document.getElementsByClassName("menu2")[0].id = "nonactivated";
    }
    function menu2(){//vip
        document.getElementById("vip").style.display = "block";
        document.getElementById("nonvip").style.display = "none";
        document.getElementsByClassName("menu1")[0].id = "nonactivated";
        document.getElementsByClassName("menu2")[0].id = "activated";

    }
</script>