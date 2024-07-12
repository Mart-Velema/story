<?php
    $statusCode = filter_input(INPUT_GET, 'e');
    $statusCode = isset($statusCode) ? htmlspecialchars($statusCode) : 200;
    $errorMessages = 
    [
        "You look lost, boy" => "Good people don't usually end up here, but I'll throw you a bone. Are you looking for any of these?", 
    ];

    if(file_exists('error.json'))
    {
        $decodedErrors = json_decode(file_get_contents('error.json'), true);
        if(json_last_error() == JSON_ERROR_NONE)
        {
            $errorMessages = $decodedErrors;
        }
    }

    $errorTitle = array_rand($errorMessages);
    $errorText = $errorMessages[$errorTitle];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="error/style.css?v=<?php echo filemtime('css/style.css'); ?>"">
    <title>Error: <?php echo $statusCode; ?></title>
</head>
<body>
    <main>
        <div class="homepage">
            <div class="block"> 
                <h2><?php echo $errorTitle; ?></h2>
                <div class="inner-block">
                    <p>
                        <?php
                            echo $errorText;
                        ?>
                    </p>
                    <hr>
                    <a href="http://story.infinite-night.com">Go back to the homepage</a>
                    <hr>
                    <p>
                        Status code: <i><?php echo $statusCode; ?></i>
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>