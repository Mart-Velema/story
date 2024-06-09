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
        $file = 'homepage';
        include 'components/header.php';
    ?>
    <main>
        <div class="homepage">
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
            <!-- document-code form -->
            <div class="block"> 
                <h2>Document code</h2>
                <div class="inner-block">
                    <form action="" method="get">
                        <label for="d">have a specific document-code? You can enter it here to go directly to that page:</label>
                        <div>
                            <input type="text" name="d" id="d">
                            <button type="submit">Go to document</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Auto-generated blocks -->
            <?php

            ?>
        </div>
    </main>
    <?php
        include 'components/footer.php';
    ?>
</body>
</html>