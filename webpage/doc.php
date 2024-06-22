<?php
    if(array_key_exists('d', $_GET))
    {
        $documentName = strtolower($_GET['d']);
        if(file_exists('output/' . $documentName . '.html'))
        {
            $file = true;
        }
        else
        {
            $documentName = "File does not exist";
            $file = false;
        }
    }
    else
    {
        $documentName = "No file selected";
        $file = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="infinite night, hellbound steel, tale of anita">
    <meta name="description" content="Reader of the Infintie Night Timeline">
    <meta name="author" content="Marxwell">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo str_replace('-', ' ', $documentName); ?></title>
</head>
<body>
    <?php
        include 'components/header.php';
    ?>
    <main>
        <article>
            <?php
                if($file)
                {
                    include 'output/' . $documentName . '.html';
                }
                else
                {
                    echo $documentName;
                }
            ?>
        </article>
    </main>
    <?php
        include 'components/footer.php';
    ?>
    <script src="js/header.js"></script>
    <script src="js/document-code.js"></script>
</body>
</html>