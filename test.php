<?php
$q = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : null;

$apiUrl = file_get_contents('http://localhost:3000/api/courses');
$result = json_decode($apiUrl, true); //assoc array

$departments = [
  'cmps' => [
      'dept' => 'CMPS',
  ]
];

// Simulate Monday at 8:00 AM for testing
$currentDay = 'M';
$currentTime = '08:00';

// Filter courses that run today and start later than current time
$filteredCourses = array_filter($result, function ($course) use ($currentDay, $currentTime) {
    $days = str_split($course['weekdays']); // e.g., "MWF" -> ['M', 'W', 'F']
    return in_array($currentDay, $days) && $course['meeting_start'] > $currentTime;
});

// Sort filtered courses by meeting_start time
usort($filteredCourses, function ($a, $b) {
    return strcmp($a['meeting_start'], $b['meeting_start']);
});

// Helper to convert 24-hour to 12-hour time
function formatTimeRange($start, $end) {
    $startFormatted = date("g:i A", strtotime($start));
    $endFormatted = date("g:i A", strtotime($end));
    return "$startFormatted - $endFormatted";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type="text/css" rel="stylesheet" href="./style.css">
  <title>
     <?php echo $q && isset($departments[$q]) ? $departments[$q]['dept'] . " Department" : "Department Not Found";?>
  </title>
</head>
<body>
<?php require_once("nav.html");?>

<div id="deptClass">
<?php if ($q && isset($departments[$q])): ?>
    <h1><?php echo $departments[$q]['dept']; ?> Department</h1>
    <p id="time">
      <strong> Simulated time: </strong> <br>
      Monday, <?php echo date("F j, Y"); ?> - 8:00 AM
    </p>
    <h2>Today's Course Schedule:</h2>
    <div id="content">
      <ul id="classes">
        <?php if (count($filteredCourses) > 0): ?>
          <?php foreach ($filteredCourses as $course): ?>
            <li><a href="class.php?q=<?php echo $course['title']; ?>">
              <?php 
              echo htmlspecialchars($course['title']) . "<br>";
              echo formatTimeRange($course['meeting_start'], $course['meeting_end']) . "<br>";
              echo htmlspecialchars($course['weekdays']) . "<br>";
              ?>
            </a></li>
          <?php endforeach; ?>
        <?php else: ?>
          <li>No more courses scheduled for the rest of the day.</li>
        <?php endif; ?>
      </ul>
    </div>
  <?php else: ?>
    <h1>Department not found</h1>
  <?php endif; ?>

  <a href="grid.php" id="back">Back to Departments</a>
</div>

</body>
</html>
