<?php
    include 'components/block.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?v=<?php echo filemtime('css/style.css'); ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo filemtime('css/header.css'); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo filemtime('css/footer.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="google-site-verification" content="CptONgedSFzgLS7YtrEG8C7zTi0u1byKmekdc1v1Qo0" />
    <title>Infinite Night | docs</title>
</head>
<body>
    <?php
        include 'components/header.php';
    ?>
    <main>
        <article>
            <!-- Introduciton -->
            <div class="block"> 
                <h2>The Infinite Night Timeline</h2>
                <div class="inner-block">
                    <p>
                        The infinite Night Timeline is a collection of stories related to the Infinite Night universe.
                        These include several related parallel storylines, which are intertwined with each other.
                        The list below contains the most imporant parts of the storyline.<br><br>
                        The Infinite Night universe starts in the year 2010, with the birth of a man named Marxwell, a great inventor who is a key player in this story.
                        He is responsible for creating the HFusion core, a small, portable power source.
                        Furthermore, he had his hands in creating the Manhunter virus, a plague that spreads around trough several animals, turning them into zombie-like creatures.<br><br>
                    </p>
                    <hr>
                    <ul>
                        <li>Mainline</li>
                        <li>Violent Stars</li>
                        <li>Tale of Anita</li>
                        <li>Hellbound Steel (non-canon)</li>
                    </ul>
                </div>
            </div>
            <hr>
            <!-- Auto-generated blocks -->
            <?php
                blocks('documents.json', false);
            ?>
        </article>
    </main>
    <?php
        include 'components/footer.php';
    ?>
</body>
</html>