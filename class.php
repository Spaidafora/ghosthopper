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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="./style.css">
    <title><?php echo $courseTitle ? $courseTitle : "Course Not Found"; ?></title>
</head>
<body>
    <?php require_once("nav.html");?>

    <div id="deptClass">
        <h1><?php echo htmlspecialchars($courseInfo['title']) . " - " . htmlspecialchars($course['subject']); ?></h1>
        
        <div id="classInfo">
            <?php if ($courseInfo): ?>
                <p><strong>Course ID:</strong> 
                <?php echo htmlspecialchars($course['id']); ?>
                <strong> - Units:</strong> 
                <?php echo htmlspecialchars($course['units']); ?>
                </p>

                <p><strong>Instructor:</strong> 
                <?php echo htmlspecialchars($courseInfo['instructor']); ?></p>

                <p><strong>Instructor email:</strong> 
                <?php echo htmlspecialchars($courseInfo['email']); ?></p>

                <p><strong>Location:</strong> 
                <?php echo htmlspecialchars($courseInfo['location']); ?></p>

                <p><strong>Meeting Time:</strong> 
                <?php
                echo date("g:i A", strtotime($courseInfo['meeting_start'])) . " - " .
                    date("g:i A", strtotime($courseInfo['meeting_end'])) . "  -  " . $course['weekdays'];
                ?>
                
                <p><strong>Course Description:</strong> 
                <?php echo htmlspecialchars($course['coursedescription']); ?></p>

                <p><strong>Prerequisites:</strong> 
                <?php echo htmlspecialchars($courseInfo['courseprereq']); ?></p>

                <p><strong>Start Date:</strong> 
                <?php echo htmlspecialchars($courseInfo['start_date']); ?>
                <strong> - End date:</strong> 
                <?php echo htmlspecialchars($courseInfo['end_date']); ?></p>
                
            <?php else: ?>
            <h2>Course not found.</h2>
            <?php endif; ?>
        </div>
        <div id="comments">
            <h1>Comments:</h1>
            <?php require_once('add.php'); ?>
        </div>
    </div>
</body>
</html>