<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $comment = trim($_POST['comment']);

    if (!empty($name) && !empty($comment)) {
        $commentData = array('name' => $name, 'comment' => $comment);
        $commentsFile = 'comments.txt';

        $comments = array();
        if (file_exists($commentsFile)) {
            $comments = json_decode(file_get_contents($commentsFile), true);
        }

        $comments[] = $commentData;
        file_put_contents($commentsFile, json_encode($comments, JSON_PRETTY_PRINT));

        echo json_encode(array('status' => 'success'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Name and comment are required'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
?>