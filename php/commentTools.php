<?php
define("COMMENT_FILE", __DIR__ . "/comments.json");

if (!file_exists(COMMENT_FILE)) {
    if (!touch(COMMENT_FILE)) {
        exit("data folder permissions not set");
    }
    file_put_contents(COMMENT_FILE, json_encode([])); // empty array to start
}

function addComment($comment) {
    $comments = getComments();
    // I added a timestamp
    $comment['createdAt'] = date("Y-m-d H:i:s");
    $comments[] = $comment;
    file_put_contents(COMMENT_FILE, json_encode($comments));
}

function getComments() {
    return json_decode(file_get_contents(COMMENT_FILE), true) ?? [];
}


?>
