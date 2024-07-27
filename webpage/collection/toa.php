<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>">
    <link rel="stylesheet" href="../css/header.css?v=<?php echo filemtime('../css/header.css'); ?>">
    <link rel="stylesheet" href="../css/footer.css?v=<?php echo filemtime('../css/footer.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Infinite Night | Tale of Anita</title>
</head>
<body>
    <?php
        include '../components/header.php';
    ?>
    <main>
        <article>
            <!-- Introduciton -->
            <div class="block"> 
                <h2>Tale of Anita</h2>
                <div class="inner-block">
                    <p>
                        &lt;PLACEHOLDER&gt;
                    </p>
                </div>
            </div>
            <hr>
            <!-- Auto-generated blocks -->
            <?php
                $jsonFile = 'hs.json';
                $jsonData = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
                if (json_last_error() !== JSON_ERROR_NONE) 
                {
                    echo("JSON decode error: " . json_last_error_msg());
                    $jsonData = [];
                }

                foreach($jsonData as $value)
                {
                    if (isset($value['link'], $value['title'], $value['body']))
                    {
                        echo 
                        '<div class="block">' .
                            '<a href="' . $value['link'] . '"><h2>' . $value['title'] . '</h2></a>' .
                            '<div class="inner-block">' .
                                '<p>' . nl2br($value['body']) . '</p>' .
                            '</div>' .
                        '</div>';
                    }
                }
            ?>
        </article>
    </main>
    <?php
        include '../components/footer.php';
    ?>
</body>
</html>