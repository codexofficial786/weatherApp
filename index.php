<?php

$weather = "";
$error = "";

if ($_GET['city']) {

    $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . urlencode($_GET['city']) . "&appid=e2b0a1b0ad1d3c56f36b05b365d74ddb");

    $weatherArray = json_decode($urlContents, true);

    if ($weatherArray['cod'] == 200) {

        $weather = "The weather in " . $_GET['city'] . " is currently '" . $weatherArray['weather'][0]['description'] . "'. </br> ";

        $tempInCelcius = intval($weatherArray['main']['temp'] - 273);

        $weather .= " The temperature is " . $tempInCelcius . "&deg;C and the wind speed is " . $weatherArray['wind']['speed'] . "m/s.";

    } else {

        $error = "Could not find city - please try again.";

    }

}


?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Weather App</title>

    <style>
        body {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            background-image: url('img.jpg');
            color: white;
            font-family: poppin, 'Times New Roman', Times, serif;
            font-size: large;
            background-size: cover;
            background-attachment: fixed;
        }

        .container {
            text-align: center;
            justify-content: center;
            align-items: center;
            width: 440px;
        }

        h1 {
            font-weight: 700;
            margin-top: 150px;
        }

        input {
            width: 350px;
            padding: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Search Global Weather</h1>
        <form action="" method="get">
            <p><label for="city">Enter Your City Name</label></p>
            <p><input type="text" name="city" id="city" placeholder="City name"></p>
            <button type="submit" class="btn btn-success">Submit</button>
            <div class="output">

            </div>
        </form>
    </div>
    <div id="weather">
        <?php

        if ($weather) {

            echo '<div class="alert alert-success" role="alert">
  ' . $weather . '
</div>';

        } else if ($error) {

            echo '<div class="alert alert-danger" role="alert">
  ' . $error . '
</div>';

        }

        ?>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>