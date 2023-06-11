<?php
$pageURL = $_SERVER['REQUEST_URI'];
include 'db.php';

// Get UserID from the session
$userID = $_COOKIE['userID']; // Assuming you have set userID in session after login

$show = $_GET['show'] ?? 'all';

$query = "";

if ($show == 'all') {
    $query = "SELECT t.taskName, t.taskDescrip, t.dueDate, t.dueTime, c.CourseName 
                FROM tasks t 
                JOIN UserCourseTask uct ON t.taskID = uct.taskID 
                JOIN UserCourse uc ON uct.UserCourseID = uc.UserCourseID
                JOIN Course c ON uc.CourseID = c.CourseID 
                WHERE uc.UserID = $userID";
} else if ($show == 'by-course') {

    $selectedCourseID = $_GET['courseID'];
    echo $selectedCourseID;

    $query = "SELECT t.taskName, t.taskDescrip, t.dueDate, t.dueTime, c.CourseName 
                FROM tasks t 
                JOIN UserCourseTask uct ON t.taskID = uct.taskID 
                JOIN UserCourse uc ON uct.UserCourseID = uc.UserCourseID
                JOIN Course c ON uc.CourseID = c.CourseID 
                WHERE uc.UserID = $userID 
                AND c.CourseID = $selectedCourseID";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h2>Tasks for Selected Course</h2>";
    echo "<table class='table'>";
    echo "<thead><tr><th>Task Name</th><th>Description</th><th>Due Date</th><th>Due Time</th><th>Course</th></tr></thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['taskName'] . "</td>";
        echo "<td>" . $row['taskDescrip'] . "</td>";
        echo "<td>" . $row['dueDate'] . "</td>";
        echo "<td>" . $row['dueTime'] . "</td>";
        echo "<td>" . $row['CourseName'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

} else if ($show == 'by-duedate') {
    $query = "SELECT t.taskName, t.taskDescrip, t.dueDate, t.dueTime, c.CourseName 
                FROM tasks t 
                JOIN UserCourseTask uct ON t.taskID = uct.taskID 
                JOIN UserCourse uc ON uct.UserCourseID = uc.UserCourseID
                JOIN Course c ON uc.CourseID = c.CourseID 
                WHERE uc.UserID = $userID 
                ORDER BY t.dueDate, t.dueTime";
}

$stmt = $conn->prepare($query);
// $stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/7e8022a4f3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>

    <div class="mt-3">
        <?php
        echo "<table class='table'>";
        echo "<thead><tr><th>Task Name</th><th>Description</th><th>Due Date</th><th>Due Time</th><th>Course</th></tr></thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['taskName'] . "</td>";
            echo "<td>" . $row['taskDescrip'] . "</td>";
            echo "<td>" . $row['dueDate'] . "</td>";
            echo "<td>" . $row['dueTime'] . "</td>";
            echo "<td>" . $row['CourseName'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        ?>
    </div>

    <div class="d-flex">
        <div class="mt-3">
            <a href="<?php $pageURL ?>?show=all" class="btn btn-primary button-style">
                Display All
            </a>
        </div>

        <div class="mt-3">
            <a href="<?php $pageURL ?>?show=by-course" class="btn btn-primary button-style">
                Display by Course
            </a>

            <form method="get" action="<?php echo $pageURL ?>">
                <select name="courseID" id="courseID" onchange='this.form.submit()'>
                    <option value="">Select a course</option>
                    <?php
                    $query = "SELECT c.CourseID, c.CourseName FROM Course c JOIN UserCourse uc ON c.CourseID = uc.CourseID WHERE uc.UserID = ?";

                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        $selected = ($_GET['courseID'] == $row['CourseID']) ? "selected" : "";
                        echo "<option value='" . $row['CourseID'] . "' " . $selected . ">" . $row['CourseName'] . "</option>";
                    }
                    ?>
                </select>
                <noscript><input type="submit" value="Submit"></noscript>
            </form>



        </div>

        <div class="mt-3">
            <a href="<?php $pageURL ?>?show=by-duedate" class="btn btn-primary button-style">
                Display by Duedate
            </a>
        </div>
    </div>





</body>

</html>