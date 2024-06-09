<header id="header">
    <a href="index.php"><img src="img/fedora.png" alt="Guinea pig logo"></a>
    <div></div>
    <p>
        Document code, click to copy:<br>
        <?php
            if($file)
            {
                echo '<button onclick="copyCodeToClipboard()"><b id="document-code">' . $documentName . '</b></button>';
            }
            else
            {
                echo 'Invalid document code';
            }
        ?>
    </p>
</header>