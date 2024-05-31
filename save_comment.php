<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $comment = htmlspecialchars(trim($_POST['comment']));

    if (!empty($name) && !empty($comment)) {
        $commentData = array('name' => $name, 'comment' => $comment);
        $commentString = json_encode($commentData) . "\n";
        file_put_contents('comments.txt', $commentString, FILE_APPEND);
        echo json_encode(array('status' => 'success'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Name and comment are required'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
?>
