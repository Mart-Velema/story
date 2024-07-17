<?php
    $documentName = filter_input(INPUT_GET, 'd', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $isValidFile = false;

    if($documentName)
    {
        $documentName = mb_strtolower($documentName);
        $documentName = preg_replace('/[^a-z0-9\-]/', '-', $documentName);

        $filePath = realpath('output/' . $documentName . '.html');
        $baseDir = realpath('output');

        if($filePath && strpos($filePath, $baseDir) === 0)
        {
            $isValidFile = true;
            $title = str_replace('-', ' ', $documentName);
        }
        else
        {
            $title = 'Invalid file!';
        }
    }
    else
    {
        $title = 'No file selected!';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?v=<?php echo filemtime('css/style.css'); ?>">
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
    <?php
        include 'components/header.php';
    ?>
    <main>
        <article>
            <?php
                if($isValidFile)
                {
                    include 'output/' . $documentName . '.html';
                }
                else
                {
                    echo
                    '<div class="block">' .
                        '<a href="index.php"><h2>' . htmlspecialchars($title) . '</h2></a>' .
                        '<div class="inner-block">' .
                            '<p>If you see this, that means that what you\'re looking for, does not exist. Clicking on the title allows you to go back to the homepage and try again to search what you\'re looking for</p>' .
                        '</div>' .
                    '</div>';
                }
            ?>
        </article>
    </main>
    <?php
        include 'components/footer.php';
    ?>
</body>
</html>