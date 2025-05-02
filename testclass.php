<?php
date_default_timezone_set('America/Los_Angeles');

$courseTitle = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : null;

$apiUrl = file_get_contents('http://localhost:3000/api/courses');
$allCourses = json_decode($apiUrl, true);

$courseInfo = null;
foreach ($allCourses as $course) {
    if ($course['title'] === $courseTitle) {
        $courseInfo = $course;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $courseTitle ? $courseTitle : "Course Not Found"; ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require_once("nav.html"); ?>

<div class="course-details">
  <?php if ($courseInfo): ?>
    <h1><?php echo htmlspecialchars($courseInfo['title']); ?></h1>
    <p><strong>Instructor:</strong> <?php echo htmlspecialchars($courseInfo['instructor']); ?></p>
    <p><strong>Location:</strong> <?php echo htmlspecialchars($courseInfo['location']); ?></p>
    <p><strong>Meeting Time:</strong> 
      <?php
      echo date("g:i A", strtotime($courseInfo['meeting_start'])) . " - " .
           date("g:i A", strtotime($courseInfo['meeting_end']));
      ?>
    </p>
    <p><strong>Days:</strong> <?php echo htmlspecialchars($courseInfo['weekdays']); ?></p>
  <?php else: ?>
    <h2>Course not found.</h2>
  <?php endif; ?>

  <a href="javascript:history.back()">← Back</a>
</div>
</body>
</html>
