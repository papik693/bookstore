<?php
$commentsFile = 'comments.txt';

if (file_exists($commentsFile)) {
    $comments = json_decode(file_get_contents($commentsFile), true);
    echo json_encode($comments);
} else {
    echo json_encode(array());
}
?>