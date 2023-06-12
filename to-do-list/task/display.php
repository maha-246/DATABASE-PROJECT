<?php
$pageURL = $_SERVER['REQUEST_URI'];
include '../includes/db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get UserID from the session
$userID = $_COOKIE['userID']; // Assuming you have set userID in session after login


$query = "SELECT c.CourseID, c.CourseName FROM Course c JOIN UserCourse uc ON c.CourseID = uc.CourseID WHERE uc.UserID = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$coursesName = $stmt->get_result();

$query = "SELECT t.taskID, t.taskName, t.taskDescrip, t.dueDate, t.dueTime, c.CourseName 
FROM tasks t
JOIN UserCourseTask uct ON t.taskID = uct.taskID
JOIN UserCourse uc ON uct.UserCourseID = uc.UserCourseID
JOIN Course c ON uc.CourseID = c.CourseID 
WHERE uc.UserID = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$taskDuedate = $stmt->get_result();

// $show = $_GET['show'] ?? 'all';
$show = false;

$query = "";

if (isset($_GET['courseID']) && $_GET['courseID'] != NULL) {
    $selectedCourseID = $_GET['courseID'];
    if ($selectedCourseID !== false) {
        $query = "SELECT t.taskName, t.taskDescrip, t.dueDate, t.dueTime, c.CourseName 
                    FROM tasks t 
                    JOIN UserCourseTask uct ON t.taskID = uct.taskID 
                    JOIN UserCourse uc ON uct.UserCourseID = uc.UserCourseID
                    JOIN Course c ON uc.CourseID = c.CourseID 
                    WHERE uc.UserID = ? 
                    AND c.CourseID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $userID, $selectedCourseID);
        $stmt->execute();
        $tasks = $stmt->get_result();
    }
} else if (isset($_GET['dueDate']) && $_GET['dueDate'] != NULL) {
    $selectedDuedate = $_GET['dueDate'];
    $query = "SELECT t.taskID, t.taskName, t.taskDescrip, t.dueDate, t.dueTime, c.CourseName 
    FROM tasks t
    JOIN UserCourseTask uct ON t.taskID = uct.taskID
    JOIN UserCourse uc ON uct.UserCourseID = uc.UserCourseID
    JOIN Course c ON uc.CourseID = c.CourseID
    WHERE t.dueDate = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedDuedate);
    $stmt->execute();
    $tasks = $stmt->get_result();
} else {
    $query = "SELECT t.taskName, t.taskDescrip, t.dueDate, t.dueTime, c.CourseName 
                FROM tasks t 
                JOIN UserCourseTask uct ON t.taskID = uct.taskID 
                JOIN UserCourse uc ON uct.UserCourseID = uc.UserCourseID
                JOIN Course c ON uc.CourseID = c.CourseID 
                WHERE uc.UserID = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $tasks = $stmt->get_result();
}

if(isset($_GET['edit'])){
    header("Location: edit.php");
    $taskID = $_GET['taskID'];
}



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
    <link rel="stylesheet" href="../css/stylesheet.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>

    <div>
        <table class='table'>
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Due Time</th>
                    <th>Course</th>
                    <th>Update Task</th>
                    <th>Check as Done</th>
                    <th>Delete Task</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $tasks->fetch_assoc()) :
                ?>
                    <tr>
                        <td><?= $row['taskID']; ?></td>
                        <td><?= $row['taskName']; ?></td>
                        <td><?= $row['taskDescrip']; ?></td>
                        <td><?= $row['dueDate']; ?></td>
                        <td><?= $row['dueTime']; ?></td>
                        <td><?= $row['CourseName']; ?></td>
                        <td> 
                            <!-- <a href="edit.php/" name="edit" class="btn btn-warning">
                                Edit
                            </a> -->
                            
                        </td>
                        <td><a href="done.php" class="btn btn-light">Done</a></td>
                        <td><a href="delete.php" class="btn btn-success">Delete</a></td>
                    </tr>
                <?php
                endwhile;
                ?>
            </tbody>
        </table>
    </div>



    <div class="d-flex">
        <div class="mt-3">
            <a href="<?php $pageURL ?>?show=all" class="btn btn-primary button-style">
                Display All
            </a>
        </div>

        <div class="mt-3">
            <form method="get" action="<?php $pageURL ?>?show=by-course" class="btn btn-primary button-style">
                <select name="courseID" id="courseID" onchange='this.form.submit()'>
                    <option value="">Select a course</option>
                    <?php

                    while ($row = $coursesName->fetch_assoc()) {
                        $selected = ($_GET['courseID'] == $row['CourseID']) ? "selected" : "";
                        echo "<option value='" . $row['CourseID'] . "' " . $selected . ">" . $row['CourseName'] . "</option>";
                    }


                    ?>
                </select>
                <noscript><input type="submit" value="Submit"></noscript>
            </form>
        </div>

        <div class="mt-3">
            <form method="get" action="<?php echo $pageURL; ?>" class="btn btn-primary button-style">
                <label for="duedate">Select Duedate</label>
                <input type="date" name="dueDate" id="duedate" value="<?php echo $_GET['dueDate'] ?? ''; ?>" onchange='this.form.submit()'>
            </form>
        </div>

    </div>




    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#courseID').select2();
        });
    </script>
</body>


</html>