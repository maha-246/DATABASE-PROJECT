<?php

include '../includes/db.php';

$taskID = $_GET['taskID'];
echo "Task ID: " . $taskID;

if (isset($_GET['taskID'])) {
    $taskID = $_GET['taskID'];

    $query = "SELECT * FROM tasks WHERE taskID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $taskID);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();
} else {
    die("Task not found.");
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

</head>

<body>
    <div class="main-body">
        <section class="container py-5">
            <div class="w-50 mx-auto">
                <form action="#" method="GET" class="form-design px-5">
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
                            <textarea class="form-control" id="taskDescrip" name="taskDescrip" value="<?= $task['taskDescrip'] ?>" required></textarea>

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
                                <option value="Math" <?php if ($task['course'] === 'Math') echo 'selected'; ?>>Math</option>
                                <option value="English" <?php if ($task['course'] === 'English') echo 'selected'; ?>>English</option>
                                <option value="Science" <?php if ($task['course'] === 'Science') echo 'selected'; ?>>Science</option>
                                <option value="Computer" <?php if ($task['course'] === 'Computer') echo 'selected'; ?>>Computer</option>
                                <option value="Physics" <?php if ($task['course'] === 'Physics') echo 'selected'; ?>>Physics</option>
                                <option value="Biology" <?php if ($task['course'] === 'Biology') echo 'selected'; ?>>Biology</option>
                                <option value="Urdu" <?php if ($task['course'] === 'Urdu') echo 'selected'; ?>>Urdu</option>
                                <option value="Other" <?php if ($task['course'] === 'Other') echo 'selected'; ?>>Other</option>
                            </select>

                            <input type="text" class="form-control mt-3" name="otherCourse" id="otherCourseInput" style="display: none;" value="<?php echo $task['course']; ?>">
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
                            <a ahref="edit.php" target="_blank" value="Update" name="Update" class="btn button-style">Update</a>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>



</body>

</html>