<?php
$jsonFile = '../cmps.json';

if (!file_exists($jsonFile)) {
    die("File not found.");
}

$jsonData = file_get_contents($jsonFile);
$courses = json_decode($jsonData, true);
$courseId = $_GET['courseId'];

if (!$courses) {
    die("Invalid JSON data.");
}
$found = false;
foreach ($courses as $course) {
    if (isset($course['course_code']) && substr($course['course_code'], -4) == $courseId) {
        $found = true;
        echo "<h1>{$course['course_code']} - {$course['title']}</h1>";
        echo "<p><strong>Description:</strong> {$course['description']}</p>";
    }

    //echo "<h3>{$course['course_code']} - {$course['title']}</h3>";
    //echo "<p><strong>Units:</strong> {$course['units']}</p>";
    //echo "<p><strong>Description:</strong> {$course['description']}</p>";
    
    /*  This is outdated info
    if (!empty($course['typically_offered'])) {
        $offered = implode(", ", $course['typically_offered']);
        echo "<p><strong>Typically Offered:</strong> $offered</p>";
    }
*/
    //echo "<hr>";
}
if (!$found) {
    echo "<h2>Course not found.</h2>";
}
?>
