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
WHERE uc.UserID = ? AND t.taskStatus = 'In Progress'";

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
        $query = "SELECT t.taskID,t.taskName, t.taskDescrip, t.dueDate, t.dueTime, c.CourseName 
                    FROM tasks t 
                    JOIN UserCourseTask uct ON t.taskID = uct.taskID 
                    JOIN UserCourse uc ON uct.UserCourseID = uc.UserCourseID
                    JOIN Course c ON uc.CourseID = c.CourseID 
                    WHERE uc.UserID = ?                     
                    AND c.CourseID = ? AND t.taskStatus = 'In Progress'";
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
    WHERE t.dueDate = ? AND t.taskStatus = 'In Progress'" ;

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedDuedate);
    $stmt->execute();
    $tasks = $stmt->get_result();
} else {
    $query = "SELECT t.taskID,t.taskName, t.taskDescrip, t.dueDate, t.dueTime, c.CourseName 
                FROM tasks t 
                JOIN UserCourseTask uct ON t.taskID = uct.taskID 
                JOIN UserCourse uc ON uct.UserCourseID = uc.UserCourseID
                JOIN Course c ON uc.CourseID = c.CourseID 
                WHERE uc.UserID = ? AND t.taskStatus = 'In Progress'";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $tasks = $stmt->get_result();
}

if (isset($_GET['edit'])) {
    header("Location: edit.php");
    $taskID = $_GET['taskID'];
}

include '../header.php';

?>
<head>
<link rel="stylesheet" href="../partials/stylesheet.css" />
</head>



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
                    <td><?= $row['taskName']; ?></td>
                    <td><?= $row['taskDescrip']; ?></td>
                    <td><?= $row['dueDate']; ?></td>
                    <td><?= $row['dueTime']; ?></td>
                    <td><?= $row['CourseName']; ?></td>
                    <td>
                        <a href="edit.php?taskID=<?= $row['taskID'] ?>" name="edit" class="btn btn-warning">
                            Edit
                        </a>

                    </td>
                    <td><a href="done.php?taskID=<?= $row['taskID'] ?>" class="btn btn-light">Done</a></td>
                    <td><a href="delete.php?taskID=<?= $row['taskID'] ?>"" class="btn btn-success">Delete</a></td>
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




<?php
include '../footer.php';
?>