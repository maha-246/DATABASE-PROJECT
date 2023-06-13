<?php

include '../includes/db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$userID = $_COOKIE['userID'];
echo "User ID: " . $userID;

$taskID = $_GET['taskID'];
echo "Task ID: " . $taskID;

if (isset($_POST['Update'])) {

    // die('Update');

    $taskID = $_POST['taskID'];
    $taskName = $_POST['taskName'];
    $taskDescrip = $_POST['taskDescrip'];
    $dueDate = $_POST['dueDate'];
    $dueTime = $_POST['dueTime'];
    $course = $_POST['course'];

    echo "TaskID" . $taskID;
    echo "taskName" . $taskName;
    echo "taskDescrip" . $taskDescrip;
    echo  "dueDate" . $dueDate;
    echo "dueTime" . $dueTime;
    echo "course" . $course;

    $query = "UPDATE tasks SET taskName=?, taskDescrip=?, dueDate=?, dueTime=? WHERE taskID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $taskName, $taskDescrip, $dueDate, $dueTime, $course, $taskID);
    $stmt->execute();

    // Check if this course is already associated with the user
    $stmt = $conn->prepare("SELECT UserCourseID FROM UserCourse WHERE UserID = $userID AND CourseID = $courseID");
    // $stmt->bind_param("ii", $userID, $courseID);
    $stmt->execute();
    $result = $stmt->get_result();

    //otherwise
    $query = "UPDATE userCourseTaskID SET userCourseID=$course WHERE taskID=$taskID";
    $stmt = $conn->prepare($query);
    $stmt->execute();


    header("Location: display.php");
    exit(); // redirects to viewtasks.php after successful update
} else {
    if (isset($_GET['taskID'])) {
        $taskID = $_GET['taskID'];

        // $query = "SELECT c.CourseID, c.CourseName FROM Course c JOIN UserCourse uc ON c.CourseID = uc.CourseID WHERE uc.UserID = ?";
        // $stmt = $conn->prepare($query);
        // $stmt->bind_param("i", $userID);
        // $stmt->execute();
        // $coursesName = $stmt->get_result();

        $query = "SELECT * FROM tasks t 
        JOIN UserCourseTask uct ON t.taskID = uct.taskID 
        JOIN Course c ON uct.userCourseID = c.CourseID 
        WHERE t.taskID = $taskID";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $task = $result->fetch_assoc();

        print_r($task);
        
        $query = "SELECT * FROM course";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $courses = $stmt->get_result();
        // $courses = $result->fetch_assoc();

        

    } else {
        die("Task not found.");
    }
}



include '../header.php';
?>

<head>
    <link rel="stylesheet" href="../partials/stylesheet.css" />
</head>

<div class="main-body">
    <section class="container py-5">
        <div class="w-50 mx-auto">
            <form action="#" method="POST" class="form-design px-5">
                <h2 class="pt-4">Add a Task</h2>
                <div class="form-row pb-5">
                    <div class="form-group mt-3">
                        <input type="hidden" name="taskID" value="<?= $task['taskID'] ?>">
                    </div>

                    <div class="form-group mt-3">
                        <label for="taskName">Task Name</label><br>
                        <input type="text" id="taskName" name="taskName" value="<?= $task['taskName'] ?>" required />
                    </div>

                    <div class="form-group mt-3">
                        <label for="taskDecrip">Task Description</label>
                        <textarea class="form-control" id="taskDescrip" name="taskDescrip" required><?= $task['taskDescrip'] ?></textarea>

                    </div>

                    <div class="form-group mt-3">
                        <label for="dueDate">DueDate</label>
                        <input type="date" class="form-control" id="dueDate" name="dueDate" value="<?= $task['dueDate'] ?>" required />
                    </div>

                    <div class="form-group mt-3">
                        <label for="duetime">Time</label>
                        <input type="time" class="form-control" id="dueTime" name="dueTime" value="<?= $task['dueTime'] ?>" required />
                    </div>

                    <div class="form-group mt-3">
                        <label for="course">Course</label><br>
                        <select name="course" class="form-control" id="courseSelect" onchange="toggleOtherInput()">
                            
                            <option value="">Select Course</option>
                            <?php
                            while ($row = $courses->fetch_assoc()) { ?>
                                <option <?php if (isset($task['CourseName']) && $task['CourseName'] === $row['CourseName'] ) echo 'selected'; ?> value="<?php echo $row['CourseID']; ?>"><?php echo $row['CourseName'] ?></option>
                                <?php 
                            } ?>
                        </select>

                        <input type="text" class="form-control mt-3" name="otherCourse" id="otherCourseInput" style="display: none;" value="<?php echo isset($task['course']) ? $task['course'] : ''; ?>" />
                    </div>

                    <script>
                        function toggleOtherInput() {
                            var courseSelect = document.getElementById('courseSelect');
                            var otherCourseInput = document.getElementById('otherCourseInput');
                            if (courseSelect.value === 'Other') {
                                otherCourseInput.style.display = 'block';
                            } else {
                                otherCourseInput.style.display = 'none';
                            }
                        }

                        // Call the function on page load in case the selected course is "Other"
                        window.onload = toggleOtherInput;
                    </script>




                    <div class="form-group mt-3">
                        <a ahref="" value="Update" name="Update" class="btn button-style">Update</a>
                    </div>
                </div>

            </form>
        </div>
    </section>
</div>



<?php
include '../footer.php';
?>