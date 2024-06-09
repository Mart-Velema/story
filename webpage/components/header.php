<header id="header">
    <a href="index.php"><img src="img/fedora.png" alt="Guinea pig logo"></a>
    <div></div>
    <p>
        <?php
            if($file === 'homepage')
            {
                echo '';
            }
            elseif($file == true)
            {
                echo 'Document code, click to copy:<br><button onclick="copyCodeToClipboard()"><b id="document-code">' . $documentName . '</b></button>';
            }
            else
            {
                echo 'Invalid document code';
            }
        ?>
    </p>
</header>