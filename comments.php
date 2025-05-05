<?php
ini_set('display_errors', 1);
require_once "commentTools.php";

$postTarget = htmlspecialchars($_SERVER['PHP_SELF']);
$errors = [];
$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data['username'] = trim($_POST['username'] ?? '');
    $data['comment'] = trim($_POST['comment'] ?? '');

    if (empty($data['username'])) {
        $errors['username'] = "Username required.";
    }

    if (empty($data['comment'])) {
        $errors['comment'] = "Comment required.";
    }

    if (empty($errors)) {
        addComment($data);
        $data = []; // Clear form
    }
}
?>

<html>
<head>
    <title>Comment Section</title>
    <link type="text/css" rel="stylesheet" href="./style.css">
</head>
<body>

<h1>Leave a Comment</h1>

<form method="post" action="<?= $postTarget ?>">
    <label for="username">Name:</label><br>
    <input type="text" name="username" value="<?= htmlspecialchars($data['username'] ?? '') ?>" required>
    <?= $errors['username'] ?? '' ?><br><br>

    <label for="comment">Comment:</label><br>
    <textarea name="comment" rows="5" cols="50" required><?= htmlspecialchars($data['comment'] ?? '') ?></textarea>
    <?= $errors['comment'] ?? '' ?><br><br>

    <input type="submit" value="Post Comment">
</form>

<hr>

<h2>Recent Comments</h2>
<?php
$comments = array_reverse(getComments()); // show newest first
foreach ($comments as $c) {
    echo "<div class='comment'>";
    echo "<strong>" . htmlspecialchars($c['username']) . "</strong> wrote:<br>";
    echo "<em>" . nl2br(htmlspecialchars($c['comment'])) . "</em><br>";
    echo "<small>Posted on " . $c['createdAt'] . "</small>";
    echo "</div><hr>";
}
?>

</body>
</html>
