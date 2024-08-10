<?php
    include '../components/block.php';
?>

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
                <a href="/doc.php?d=tale-of-anita-|-tale-of-anita"><h2>Tale of Anita</h2></a>
                <div class="inner-block">
                    <p>
                        Tale of Anita takes place in the year of 2070. It's a continuiation of the Infinite Night storyline, where a brave girl named Anita Nikita goes on an adventure with her grandfather to seek out where her father has been. During this, she will learn the horrors caused by everyone involved with the Infinite Night Project and the evil mechs that have ravaged the land, and taken them for themselfes. Will she suceed in finding her dad? Or will she find him among the stars?
                    </p>
                </div>
            </div>
            <hr>
            <!-- Auto-generated blocks -->
            <?php
                blocks('toa.json');
            ?>
        </article>
    </main>
    <?php
        include '../components/footer.php';
    ?>
</body>
</html>