<?php
ini_set('display_errors', 1);
require_once "commentTools.php";

// I am using The directory of the file because it takes me to a new page after adding a comment.  
$postTarget = htmlspecialchars($_SERVER['REQUEST_URI']);
$errors = [];
$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dump_comments'])) {
        file_put_contents(COMMENT_FILE, json_encode([])); 
        $message = "All comments have been dumped.";
    } else {
        $data['username'] = trim($_POST['username'] ?? '');
        $data['id'] = trim($_POST['id'] ?? '');
        $data['comment'] = trim($_POST['comment'] ?? '');
        
/*
        if (empty($data['username'])) {
            $errors['username'] = "Username required.";
        }

        if (empty($data['comment'])) {
            $errors['comment'] = "Comment required.";
        }
*/
        if (empty($errors)) {
            addComment($data);
            $data = [];
        }
    }
}
?>

<html>
<head>
    <!--<title>Comment Section</title>-->
    <link type="text/css" rel="stylesheet" href="./style.css">
</head>
<body>

<h1>Leave a Comment</h1>

<form method="post" action="<?= $postTarget ?>">
    <label for="id">ID:</label><br>
    <input type="text" name="id" value="<?= htmlspecialchars($data['id'] ?? '') ?>" required>
    <?= $errors['id'] ?? '' ?><br><br>

    <label for="username">Name:</label><br>
    <input type="text" name="username" value="<?= htmlspecialchars($data['username'] ?? '') ?>" required>
    <?= $errors['username'] ?? '' ?><br><br>

    <label for="comment">Comment:</label><br>
    <textarea name="comment" rows="5" cols="50" required><?= htmlspecialchars($data['comment'] ?? '') ?></textarea>
    <?= $errors['comment'] ?? '' ?><br><br>

    <input type="submit" value="Post Comment">
</form>

<hr>
<!--DUMP aded for testing purposes-->
<!--
<form method="post" action="<?= $postTarget ?>">
    <input type="submit" name="dump_comments" value="Dump All Comments" />
</form>
-->
<?php
if (isset($message)) {
    echo "<p><strong>$message</strong></p>";
}

?>

<h2>Recent Comments</h2>
<?php
$comments = array_reverse(getComments());
foreach ($comments as $c) {
    echo "<div class='comment'>";
    echo "<strong>" . htmlspecialchars($c['username']) . "</strong> wrote about CMPS " . htmlspecialchars($c['id']) . ":" . "<br>";
    echo nl2br(htmlspecialchars($c['comment'])) . "<br>";
    echo "<small>Posted on " . $c['createdAt'] . "</small>";
    echo "</div><hr>";
}
?>

</body>
</html>
