<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ROZVRH</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <script src='main.js?=version=1'></script>

    <div class="datum-a-cas">
        <div id="datum"></div>
        <div id="cas"></div>
        <div id="tyzden"></div>
    </div>


    <div id="ciara"></div>
    <div id="teraz">TERAZ</div>

    <div id="fotky">
        <img src="./loga/dejvid.jpg" id="A3-logo">
        <img src="./loga/jusko.jpg" id="A7-logo">
        <!---  <img src="./loga/domo.jpg" id="domo-logo"> -->
        <!-- <img src="./loga/klobaska.jpg" id="klobaska-logo"> -->
    </div>

<?php
    $den_v_tyzdni = date('w');
    //$den_v_tyzdni = '1';
    $rozvrh = file_get_contents("./rozvrh.json");
    $json = json_decode($rozvrh, true);

    $dnes = $json[$den_v_tyzdni];
    foreach ($dnes as $meno => $hodiny) {     
        foreach($hodiny as $cas => $info){
            foreach($info as $nazov_predmentu => $link){
                echo "
                <script>
                    vytvorDiv('". $meno ."', '". $cas ."', '". $nazov_predmentu ."', '". $link ."');
                </script>
                ";   
            }
        }
    }
?>
    
    
</body>
</html>