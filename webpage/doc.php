<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <?php
        include 'components/header.php';
    ?>
    <main>
        <article class="container">
            <?php
                if(array_key_exists('d', $_GET))
                {
                    $documentName = strtolower($_GET['d']);
                    if(file_exists('output/' . $documentName . '.html'))
                    {
                        include 'output/' . $documentName . '.html';
                    }
                    else
                    {
                        echo "File does not exist";
                    }
                }
                else
                {
                    echo "No file selected";
                }
            ?>
        </article>
    </main>
    <?php
        include 'components/footer.php';
    ?>
</body>
</html>