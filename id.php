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
  
  <h1>Course ID</h1>


<?php 


//$_GET gets data from the URL

$courseId = $_GET['courseId'];   

//echo "php is running"; 
echo "<br>";
$apiUrl = file_get_contents('http://localhost:3000/api/courses/' . $courseId); //??
$result = json_decode($apiUrl, true); //assoc array



//print_r($result);


// how to make it route to localhost/courses/id   ? 
/*
foreach ($result as $course){
    echo '<div class="subject">';
    echo "Subject: " .  $course['subject'] .  "<br>"; 
    echo "ID: " . $course['id'] . "<br>"; 
    echo "Title: " . $course['title'] . "<br>"; 
    echo "Inits: " . $course['units'] . "<br>"; 
    echo "Instructor: " . $course['instructor'] . "<br>"; 
    echo "Email: " . $course['email'] . "<br>";
    echo "Location: " . $course['location'] . "<br>";
    echo "Meeting Start: " . $course['meeting_start'] . "<br>";
    echo "Meeting End: " . $course['meeting_end'] . "<br>";
    echo "Week Days: " . $course['weekdays'] . "<br>";
    echo "Start Date: " . $course['start_date'] . "<br>";
    echo "End Date: " . $course['end_date'] . "<br>";
    echo "Max Capacity: " . $course['max_capacity'] . "<br>";
    echo "Total Enrolled: " . $course['total_enrolled'] . "<br>";
    echo "Total Waitlisted: " . $course['total_waitlisted'] . "<br>";
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
echo '<td>' . 'Meeting Start' . '</td>';
echo '<td>' . 'Meeting End' . '</td>';
echo '<td>' . 'Week Days' . '</td>';
echo '<td>' . 'Start Date' . '</td>';
echo '<td>' . 'End Date' . '</td>';
echo '<td>' . 'Max Capacity' . '</td>';
echo '<td>' . 'Total Enrolled' . '</td>';
echo '<td>' . 'Total Waitlisted' . '</td>';
echo '</tr>';
echo '</thread>';
echo '<tbody>';

foreach($result as$course){
  echo '<tr>';
  echo '<td>' . $course['subject'] . '</td>';
  echo '<td>' . $course['id'] . '</td>';
  echo '<td>' . $course['title'] . '</td>';
  echo '<td>' . $course['coursedescription'] . '</td>';
  echo '<td>' . $course['units'] . '</td>';
  echo '<td>' . $course['instructor'] . '</td>';
  echo '<td>' . $course['courseprereq'] . '</td>';
  echo '<td>' . $course['email'] . '</td>';
  echo '<td>' . $course['location'] . '</td>';
  echo '<td>' . $course['meeting_start'] . '</td>';
  echo '<td>' . $course['meeting_end'] . '</td>';
  echo '<td>' . $course['weekdays'] . '</td>';
  echo '<td>' . $course['start_date'] . '</td>';
  echo '<td>' . $course['end_date'] . '</td>';
  echo '<td>' . $course['max_capacity'] . '</td>';
  echo '<td>' . $course['total_enrolled'] . '</td>';
  echo '<td>' . $course['total_waitlisted'] . '</td>';  
  echo '</tr>';
  }

  echo '</table>'; 
  echo '</table>';

 //require_once('cmps.php');
  
//http://localhost:8000/id.php?courseId=2020
//node running in port 3000, can't run php there. 
// php running in port 8000 : php -S localhost:8000


?>



</body>
</html>