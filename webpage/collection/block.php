<?php   
$jsonData = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
if (json_last_error() !== JSON_ERROR_NONE) 
{
    echo("JSON decode error: " . json_last_error_msg());
    $jsonData = [];
}

foreach($jsonData as $value)
{
    if (isset($value['link'], $value['title'], $value['body']))
    {
        echo 
        '<div class="block">' .
            '<a href="/doc.php?d=' . $value['link'] . '"><h2>' . $value['title'] . '</h2></a>' .
            '<div class="inner-block">' .
                '<p>' . nl2br($value['body']) . '</p>' .
            '</div>' .
        '</div>';
    }
}
?>