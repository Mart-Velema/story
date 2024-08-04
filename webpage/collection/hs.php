<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime('../css/style.css'); ?>">
    <link rel="stylesheet" href="../css/header.css?v=<?php echo filemtime('../css/header.css'); ?>">
    <link rel="stylesheet" href="../css/footer.css?v=<?php echo filemtime('../css/footer.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Infinite Night | Hellbound Steel</title>
</head>
<body>
    <?php
        include '../components/header.php';
    ?>
    <main>
        <article>
            <!-- Introduciton -->
            <div class="block"> 
                <a href="/doc.php?d=hellbound-steel-|-hellbound-steel"><h2>Hellbound Steel</h2></a>
                <div class="inner-block">
                    <p>
                        Hellbound Steel is set in the imaginairy city of Terra Lanice, where a small group of students get unwillingly sucked into the nuclear armsrace that is going on between the humans and Steel Demons.<br>With their furry companions on their side, they are ready to face the horrors that are contained underneath the mountains<br>They eat, fight, love and cry together, as they kick ass and save lifes.
                    </p>
                </div>
            </div>
            <hr>
            <!-- Auto-generated blocks -->
            <?php
                $jsonFile = 'hs.json';
                include '../components/block.php';
            ?>
        </article>
    </main>
    <?php
        include '../components/footer.php';
    ?>
</body>
</html>