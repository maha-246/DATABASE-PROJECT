<?php
    include 'db.php';
    $errors = array();
    
    if (isset($_GET['Submit'])) {  // Assuming your method is GET, if it's POST replace this with $_POST
      $taskName = $_GET['taskName'];
      $taskDescrip = $_GET['taskDescrip'];
      $dueDate = $_GET['dueDate'];
      $duetime = $_GET['duetime'];
      $course = $_GET['course'];

        echo "Task Name " . $taskName . "<br>";
        echo "Task Description: " . $taskDescrip . "<br>";
        echo "DueDate: " . $dueDate . "<br>";
        echo "Time: " . $duetime . "<br>";
        echo "course: " . $course . "<br>";
    // echo "Confirm Password: " . $confirmPassword . "<br>";
    // echo "Gender: " . $gender . "<br>";
      
      // Validation code here...
      if (empty($taskName)) {
        array_push($errors, "TaskName is required");
      }
      if (empty($dueDate)) {
        array_push($errors, "Give a due date");
      }
      if (empty($duetime)) {
        array_push($errors, "Give a time");
      }
      if (empty($course)) {
        array_push($errors, "Assign a course");
      }

      
      print_r($errors);
    
      if (count($errors) == 0) {
        // First, insert the task into the tasks table.
        $stmt = $conn->prepare("INSERT INTO tasks (taskName, taskDescrip, dueDate, dueTime) VALUES ('$taskName', '$taskDescrip', '$dueDate', '$duetime')");
        // $stmt->bind_param("ssss", $taskName, $taskDescrip, $dueDate, $duetime);
        $stmt->execute();

        // Get the last inserted ID, which is the task ID.
        $taskID = $stmt->insert_id;

        // Then, get the course ID from the course name.
        $stmt = $conn->prepare("SELECT CourseID FROM Course WHERE CourseName = '$course'");
        // $stmt->bind_param("s", $course);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $courseID = $row['CourseID'];

        print_r($courseID);
    
        // Get UserID from the session
        $userID = $_COOKIE['userID']; // Assuming you have set userID in session after login
    
        // Check if this course is already associated with the user
        $stmt = $conn->prepare("SELECT UserCourseID FROM UserCourse WHERE UserID = $userID AND CourseID = $courseID");
        // $stmt->bind_param("ii", $userID, $courseID);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows == 0) {
            // If not, add the user-course relation into the UserCourse table.
            $stmt = $conn->prepare("INSERT INTO UserCourse (UserID, CourseID) VALUES ($userID, $courseID)");
            // $stmt->bind_param("ii", $userID, $courseID);
            $stmt->execute();
    
            // Get the last inserted ID, which is the UserCourseID.
            $userCourseID = $stmt->insert_id;
        } else {
            // If the relation already exists, just get the UserCourseID
            $row = $result->fetch_assoc();
            $userCourseID = $row['UserCourseID'];
        }
    
        // Then, add the UserCourse-task relation into the UserCourseTask table.
        $stmt = $conn->prepare("INSERT INTO UserCourseTask (taskID, UserCourseID) VALUES ($taskID, $userCourseID)");
        // $stmt->bind_param("ii", $taskID, $userCourseID);
        $stmt->execute();
      }
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
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <div class="main-body">
        <section class="container py-5">
            <div class="w-50 mx-auto">
                <form action="#" method="GET" class="form-design px-5">
                    <h2 class="pt-4">Add a Task</h2>
                    <div class="form-row pb-5">
                        <div class="form-group mt-3">
                            <label for="taskName">Task Name</label>
                            <input type="text" class="form-control" id="taskName" name="taskName" placeholder="Enter the name for your task..." required />
                        </div>

                        <div class="form-group mt-3">
                            <label for="taskDecrip">Task Description</label>
                            <input type="text" class="form-control" id="taskDescrip" name="taskDescrip" placeholder="Enter the description of ypur task..." />
                        </div>

                        <div class="form-group mt-3">
                            <label for="dueDate">DueDate</label>
                            <input type="date" class="form-control" id="dueDate" name="dueDate" placeholder="yyyy/mm/dd" required />
                        </div>

                        <div class="form-group mt-3">
                            <label for="duetime">Time</label>
                            <input type="time" class="form-control" id="duetime" name="duetime" placeholder="00:00" required />
                        </div>

                        <div class="form-group mt-3">
                            <label for="course">Course</label><br>
                            <!-- <input type="text" class="form-control" id="course" name="course" placeholder="Course Name" data-sb-validations="required" />  -->
                            <select name="course" class="form-control" id="courseSelect" name="course" onchange="toggleOtherInput()">
                                <option value="">Select Course</option>
                                <option value="Math">Math</option>
                                <option value="English">English</option>
                                <option value="Science">Science</option>
                                <option value="Computer">Computer</option>
                                <option value="Physics">Physics</option>
                                <option value="Biology">Biology</option>
                                <option value="Urdu">Urdu</option>
                                <option value="Other">Other</option>
                            </select>

                            <input type="text" class="form-control mt-3" name="otherCourse" id="otherCourseInput" name="course" style="display: none;">

                            <script>
                                function toggleOtherInput() {
                                    var selectElement = document.getElementById("courseSelect");
                                    var otherInput = document.getElementById("otherCourseInput");

                                    if (selectElement.value === "other") {
                                        otherInput.style.display = "block";
                                    } else {
                                        otherInput.style.display = "none";
                                    }
                                }
                            </script>

                        </div>


                        <div class="form-group mt-3">
                            <input type="submit" value="Submit" name="Submit" class="btn button-style">
                            <input type="reset" class="btn button-style">
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>



</body>

</html>