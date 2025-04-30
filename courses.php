<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ghost-hopper</title>
</head>
<body>
  <h1>Courses</h1>


<?php 
//cant use node to run php 

echo "php is running"; 
echo "<br>";
$apiUrl = file_get_contents('http://localhost:3000/api/courses');
$result = json_decode($apiUrl, true); //assoc array



//print_r($result);


// how to make it route to localhost/courses    ? 
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
    echo '</div>';
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
}


 



// php cant run in port 3000 where node is running 
// run in port 8000 -> chat: php -S localhost:8000
// http://localhost:8000/courses.php


?>



</body>
</html>