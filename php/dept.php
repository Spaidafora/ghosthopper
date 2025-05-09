<?php
date_default_timezone_set('America/Los_Angeles');


$q = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : null;

$apiUrl = file_get_contents('http://localhost:3000/api/courses');
$result = json_decode($apiUrl, true); //assoc array


$departments = [
  'cmps' => [
      'dept' => 'CMPS',
  ]
];

$currentDay = strtoupper(date("D")[0]);
$currentTime = date("H:i");

//filter based on day and time
$filteredCourses = array_filter($result, function ($course) use ($currentDay, $currentTime) {
  $days = str_split($course['weekdays']); 
  return in_array($currentDay, $days) && $course['meeting_start'] > $currentTime;
});

//sort by meetinng start time
usort($filteredCourses, function ($a, $b) {
  return strcmp($a['meeting_start'], $b['meeting_start']);
});

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
  <link type="text/css" rel="stylesheet" href="../css/style.css">
  <title>
     <?php echo $q && isset($departments[$q]) ? $departments[$q]['dept'] . " Department" : "Department Not Found";?>
  </title>
</head>
<body>
<?php require_once("../nav.html");?>

<div id="deptClass">
<?php if ($q && isset($departments[$q])): ?>
    <h1><?php echo $departments[$q]['dept']; ?> Department</h1>
    <p id="time">
      <strong> Current time: </strong> <br>
      <?php echo date("l, F j, Y - g:i A"); ?>
    </p>
    <h2>Today's Course Schedule:</h2>
    <div id="content">
      <ul id="classes">
        <?php if (count($filteredCourses) > 0): ?>
          <?php foreach ($filteredCourses as $course): ?>
            <li><a href="class.php?q=<?php echo $course['title']; ?>">
              <?php 
               echo "<strong>" . htmlspecialchars($course['title']) . "</strong>" . "<br>";
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

  <a href="/" id="back" onclick="javascript:event.target.port=3000">Search all courses</a> <br>
  <a href="grid.php" id="back" >Back to Departments</a> <br>
  <a href="http://localhost:8000/php/test.php?q=cmps" id="back">Simulation</a>
</div>

</body>
</html>
