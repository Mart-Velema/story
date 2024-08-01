<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>">
    <link rel="stylesheet" href="../css/header.css?v=<?php echo filemtime('../css/header.css'); ?>">
    <link rel="stylesheet" href="../css/footer.css?v=<?php echo filemtime('../css/footer.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Infinite Night | Mainline</title>
</head>
<body>
    <?php
        include '../components/header.php';
    ?>
    <main>
        <article>
            <!-- Introduciton -->
            <div class="block"> 
                <a href="/doc.php?d=mainline-|-mainline"><h2>Infinite Night</h2></a>
                <div class="inner-block">
                    <p>
                        Infinite Night is set in the future of the year 2060. The mainline story is about a group of politicans, who have been elected to repair whatever is left of the Reforemed European Union. All whilst the country starts to get overrun by hunders of thousands of manhunters, and the rise of robots looming over the horison, all whilst the high Supreme Court watches it happen. <br>What dark secrets lie beyond the doors of the Supreme Court? Who is out to bring everything known to man to their knees?
                    </p>
                </div>
            </div>
            <hr>
            <!-- Auto-generated blocks -->
            <?php
                $jsonFile = 'in.json';
                include 'block.php';
            ?>
        </article>
    </main>
    <?php
        include '../components/footer.php';
    ?>
</body>
</html>