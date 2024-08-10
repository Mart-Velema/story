<?php   
if(!isset($jsonFile))
{
    echo('JSON decode error: JSON filename is not declared');
    $jsonData = [];
}

$jsonData = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
if (json_last_error() !== JSON_ERROR_NONE) 
{
    echo("JSON decode error: " . json_last_error_msg());
    $jsonData = [];
}

$prefix = $has_prefix ? '/doc.php?d=' : '';

foreach($jsonData as $value)
{
    if (isset($value['link'], $value['title'], $value['body']))
    {
        echo 
        '<div class="block">' .
            '<a href="' . $prefix  . $value['link'] . '"><h2>' . $value['title'] . '</h2></a>' .
            '<div class="inner-block">' .
                '<p>' . nl2br($value['body']) . '</p>' .
            '</div>' .
        '</div>';
    }
}
?>