<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ghost-hopper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<h1>Courses</h1>

 <div class=search> 

    <form method="post">
        <input type="text" placeholder="Search...">
        <input type="submit"  name="submit" value="Search"/>
    </form> 
</div>

<?php 



echo "<br>";
$apiUrl = 'http://localhost:3000/api/courses';
$response = @file_get_contents($apiUrl); //json

if ($response === FALSE) {
  //echo '<p>Error: Could not connect to API. </p>';
  die("Error: Could not connect to API."); 
} else {
  $result = json_decode($response, true); //assoc array
} 
  



//print_r($result);

/*

foreach ($result as $course){
    echo '<div class="subject">';
    echo "Subject: " . $course['subject'] .  "<br>"; 
    echo "ID: " .$course['id'] . "<br>"; 
    echo "Title: " .$course['title'] . "<br>"; 
    echo "Course Description: " .$course['coursedescription'] . "<br>"; 
    echo "Inits: " .$course['units'] . "<br>"; 
    echo "Instructor: " .$course['instructor'] . "<br>"; 
    echo "Email: " .$course['email'] . "<br>";
    echo "Location: " .$course['location'] . "<br>";
    echo "Course Prerequisites " .$course['courseprereq'] . "<br>";
    echo "Meeting Start: " .$course['meeting_start'] . "<br>";
    echo "Meeting End: " .$course['meeting_end'] . "<br>";
    echo "Week Days: " .$course['weekdays'] . "<br>";
    echo "Start Date: " .$course['start_date'] . "<br>";
    echo "End Date: " .$course['end_date'] . "<br>";
    echo "Max Capacity: " .$course['max_capacity'] . "<br>";
    echo "Total Enrolled: " .$course['total_enrolled'] . "<br>";
    echo "Total Waitlisted: " .$course['total_waitlisted'] . "<br>";
    echo '</div>';
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
}
*/


echo '<table class="table table-striped">';
echo '<thread>';
echo '<tr>';
echo '<td>' . 'Subject' . '</td>';
echo '<td>'. 'ID' . '</td>';
echo '<td>' . 'Title'  . '</td>';
echo '<td>' . 'Course Description'  . '</td>';
echo '<td>' . 'Units' . '</td>';
echo '<td>' . 'Instructor' . '</td>';
echo '<td>' . 'Email' . '</td>';
echo '<td>' . 'Location' . '</td>';
echo '<td>' . 'Course Prequisites' . '</td>';
echo '<td>' . 'Meeting Start' . '</td>';
echo '<td>' . 'Meeting End' . '</td>';
echo '<td>' . 'Week Days' . '</td>';
echo '<td>' . 'Start Date' . '</td>';
echo '<td>' . 'End Date' . '</td>';
echo '<td>' . 'Max Capacity' . '</td>';
echo '<td>' . 'Total Enrolled' . '</td>';
echo '<td>' . 'Total Waitlisted' . '</td>';
echo '<td>' . '      ' . '</td>';
//echo '<td>' . 'Overview' . '</td>';
echo '</tr>';
echo '</thread>';
echo '<tbody>';

foreach($result as $course){
  echo '<tr>';
  echo '<td>' . htmlspecialchars($course['subject']) . '</td>';
  echo '<td>' . htmlspecialchars($course['id']) . '</td>';
  echo '<td>' . htmlspecialchars($course['title']) . '</td>';
  echo '<td>' . htmlspecialchars($course['coursedescription']) . '</td>';
  echo '<td>' . htmlspecialchars($course['units']) . '</td>';
  echo '<td>' . htmlspecialchars($course['instructor']) . '</td>';
  echo '<td>' . htmlspecialchars($course['email']) . '</td>';
  echo '<td>' . htmlspecialchars($course['location']) . '</td>'; 
  echo '<td>' . htmlspecialchars($course['courseprereq']) . '</td>';
  echo '<td>' . htmlspecialchars($course['meeting_start']) . '</td>';
  echo '<td>' . htmlspecialchars($course['meeting_end']) . '</td>';
  echo '<td>' . htmlspecialchars($course['weekdays']) . '</td>';
  echo '<td>' . htmlspecialchars($course['start_date']) . '</td>';
  echo '<td>' . htmlspecialchars($course['end_date']) . '</td>';
  echo '<td>' . htmlspecialchars($course['max_capacity']) . '</td>';
  echo '<td>' . htmlspecialchars($course['total_enrolled']) . '</td>';
  echo '<td>' . htmlspecialchars($course['total_waitlisted']) . '</td>';
  //echo '<td>' . '<a href="url">' . 'Overview' . '</a>' . '<td>';  
  echo '<td><a href="id.php?courseId=' . $course['id'] . '" class="btn btn-sm btn-primary">View</a></td>';
  echo '</tr>';
  }

  echo '</table>';
  echo '</table>';



 



// php cant run in port 3000 where node is running 
// run in port 8000 -> chat: php -S localhost:8000
// http://localhost:8000/courses.php


?>



</body>
</html>