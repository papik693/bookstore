<?php
$commentsFile = 'comments.txt';
$comments = array();

if (file_exists($commentsFile)) {
    $file = fopen($commentsFile, "r");
    while (($line = fgets($file)) !== false) {
        $comments[] = json_decode($line, true);
    }
    fclose($file);
}

echo json_encode($comments);
?>
