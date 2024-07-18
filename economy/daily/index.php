<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SK players</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="/css/daily/main.css?version=6">
    <link rel="stylesheet" href="/koleso/main.css" type="text/css" />

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script>
        console.log = function(){ };
    </script>
    <script src='/javascript/disableConsole.js?version=1'></script>
</head>

<body onload="dai_start('meno', 'id', 'rola')">
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-firestore.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
    <script src='/javascript/daily.js?version=13'></script>
    <script src="/koleso/Winwheel.js"></script>

    
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/header.php';
    ?>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/nav.php';
    ?>
     
    
    <div class="main">
        <div class="discord-daily">
            <p class="nadpis">DISCORD DAILY:</p><br>

            <div class="button">
                <button id="dailicko" onclick="vyber_daily('id', 'rola')">Vyber si daily</button>
            </div>

            <p id="daily_time" class="cas"></p>
            <p id="vysledok"></p>
        </div>

        <div class="medzera">

        </div>

        <div class="web-daily">
            <p class="web-nadpis">WEB DAILY:</p><br>
            <p id=web-dailicko-cas></p>

            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td width="438" height="582" class="the_wheel" align="center" valign="center">
                        <canvas id="canvas" width="434" height="434" data-responsiveMinWidth="180" data-responsiveScaleHeight="true" data-responsiveMargin="50">
                            <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                        </canvas>
                    </td>
                </tr>
            </table>
            <img id="spin_button" src="/koleso/spin_on.png" alt="Spin" onClick="startSpin();" />
        </div>
    </div>

    <script>
        // Create new wheel object specifying the parameters at creation time.
        let theWheel = new Winwheel({
            'numSegments': 8, // Specify number of segments.
            'outerRadius': 212, // Set outer radius so wheel fits inside the background.
            'textFontSize': 28, // Set font size as desired.
            'responsive': true,
            'segments': // Define segments including colour and text.
                [{
                'fillStyle': '#eae56f',
                'text': '5'
            }, {
                'fillStyle': '#89f26e',
                'text': '40'
            }, {
                'fillStyle': '#7de6ef',
                'text': '20'
            }, {
                'fillStyle': '#e7706f',
                'text': '25'
            }, {
                'fillStyle': '#eae56f',
                'text': '15'
            }, {
                'fillStyle': '#89f26e',
                'text': '35'
            }, {
                'fillStyle': '#7de6ef',
                'text': '10'
            }, {
                'fillStyle': '#e7706f',
                'text': '30'
            }],
            'animation': // Specify the animation to use.
            {
                'type': 'spinToStop',
                'duration': 5, // Duration in seconds.
                'spins': 8, // Number of complete spins.
                'callbackFinished': alertPrize
            }
        });

        // Vars used by the code in this page to do power controls.
        let wheelPower = 0;
        let wheelSpinning = false;

        // -------------------------------------------------------
        // Function to handle the onClick on the power buttons.
        // -------------------------------------------------------
        // -------------------------------------------------------
        // Click handler for spin button.
        // -------------------------------------------------------
        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        function startSpin() {
            // Ensure that spinning can't be clicked again while already running.
            if (wheelSpinning == false) {
                // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                // to rotate with the duration of the animation the quicker the wheel spins.
                /*if (wheelPower == 1) {
                    theWheel.animation.spins = 3;
                } else if (wheelPower == 2) {
                    theWheel.animation.spins = 8;
                } else if (wheelPower == 3) {
                    theWheel.animation.spins = 15;
                }*/

                theWheel.animation.spins = getRandomInt(3, 15);

                // Disable the spin button so can't click again while wheel is spinning.
                document.getElementById('spin_button').src = "/koleso/spin_off.png";
                document.getElementById('spin_button').className = "";

                // Begin the spin animation by calling startAnimation on the wheel object.
                theWheel.startAnimation();

                // Set to true so that power can't be changed and spin button re-enabled during
                // the current animation. The user will have to reset before spinning again.
                wheelSpinning = true;
            }
        }

        // -------------------------------------------------------
        // Function for reset button.
        // -------------------------------------------------------
        function resetWheel() {
            theWheel.stopAnimation(false); // Stop the animation, false as param so does not call callback function.
            theWheel.rotationAngle = 0; // Re-set the wheel angle to 0 degrees.
            theWheel.draw(); // Call draw to render changes to the wheel.

            document.getElementById('pw1').className = ""; // Remove all colours from the power level indicators.
            document.getElementById('pw2').className = "";
            document.getElementById('pw3').className = "";

            wheelSpinning = false; // Reset to false to power buttons and spin can be clicked again.

            return false;
        }

        // -------------------------------------------------------
        // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters
        // note the indicated segment is passed in as a parmeter as 99% of the time you will want to know this to inform the user of their prize.
        // -------------------------------------------------------
        function alertPrize(indicatedSegment) {
            // Do basic alert of the segment text. You would probably want to do something more interesting with this information.
            //alert("You have won " + indicatedSegment.text);
            let vyhra = indicatedSegment.text;
            vyhra = parseInt(vyhra);
            vyber_web_daily('meno', 'id', vyhra, 'rola');

        }
    </script>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/footer.php';
    ?>
    <style>
        @media only screen and (max-width: 600px) {
            footer{
                position: relative;
            }
        }
    </style>
    
</body>

</html>
