<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK players</title>

    <?php
    $path = $_SERVER['DOCUMENT_ROOT'] . "/data/head-dolezite.php";
    require_once $path;
    ?>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }
        h1 {
            text-align: left;
            color: #007bff;
        }
        .update-body {
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 800px;
        }
        .update-body img {
            width: 75%;
            display: block;
            margin: 10px auto;
        }
        a {
            overflow-wrap: break-word;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        select#vyber {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        @media screen and (max-width: 500px) {

        }
    </style>
</head>
<body>
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/footer_header/hlavicka-fixed.php';
    ?>

    <div class="update-body">
        <?php
        $api_endpoint = 'https://api.rss2json.com/v1/api.json?rss_url=';
        $full_address = $api_endpoint . $rss_url;

        $json = json_decode(file_get_contents($full_address), true);
        $updates = $json['items'];

        echo "<h3>Zoznam posledných updatov</h3>\n";
        echo '<select name="vyber" id="vyber" onchange="updateSelection()">' . "\n";
        echo "<option value=''>----------</option>\n";
        foreach ($updates as $index => $update) {
            echo "<option value='$index'>{$update['title']}</option>\n";
        }
        echo "</select>\n";

        echo "<br><br>";

        foreach ($updates as $index => $update) {
            echo "<div id='update-$index' class='update' style='display: none;'>";
            echo "<h1>{$update['title']}</h1>";
            echo "<h4>Dátum vydania: {$update['pubDate']}</h4>";
            // echo "<img src='{$update['thumbnail']}'>";
            echo "<a href='{$update['link']}' target='_blank'>{$update['link']}</a>";
            echo "<p>{$update['content']}</p>";
            echo "</div>\n";
        }
        ?>
    </div>

    <script>
        function updateSelection() {
            var selectedIndex = document.getElementById("vyber").value;
            var updates = document.getElementsByClassName("update");

            for (var i = 0; i < updates.length; i++) {
                updates[i].style.display = "none";
            }

            if (selectedIndex) {
                document.getElementById("update-" + selectedIndex).style.display = "block";
            }
        }

        document.querySelectorAll('img.sk_logo, img.sk_logo_text').forEach(function(img) {
            img.addEventListener('click', function() {
                window.location.href = '/';
            });
        });

        var videos = document.getElementsByClassName("sizeFull");
        for (var i = 0; i < videos.length; i++) {
            var youtubeCode = videos[i].getAttribute('data-youtube');
            if (youtubeCode) {
                var iframe = document.createElement("iframe");
                iframe.setAttribute("src", 'https://www.youtube.com/embed/' + youtubeCode);
                iframe.setAttribute("allowfullscreen", "true");
                videos[i].appendChild(iframe);
            }
        }

        document.querySelectorAll('.sizeFull img').forEach(function(img) {
            img.remove();
        });
    </script>
</body>
</html>
