<?php
include '../includes/db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$userID = $_COOKIE['userID'];

if (isset($_GET['taskID'])) {
    $taskID = $_GET['taskID'];

    $conn->begin_transaction();

    try {
        // Delete from UserCourseTask
        $query = "DELETE FROM UserCourseTask WHERE taskID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $taskID);
        $stmt->execute();

        // Find UserCourseIDs which are not linked to any task
        $query = "SELECT UserCourseID FROM UserCourse WHERE UserCourseID NOT IN (SELECT UserCourseID FROM UserCourseTask)";
        $result = $conn->query($query);
        $userCourseIDs = $result->fetch_all(MYSQLI_ASSOC);

        // Delete these UserCourseIDs
        foreach ($userCourseIDs as $id) {
            $query = "DELETE FROM UserCourse WHERE UserCourseID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id['UserCourseID']);
            $stmt->execute();
        }

        // Delete from tasks
        $query = "DELETE FROM tasks WHERE taskID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $taskID);
        $stmt->execute();

        // If no errors, commit the transaction
        $conn->commit();
        echo "Task deleted successfully";
    } catch (Exception $e) {
        // An error occured; rollback!
        $conn->rollback();
        echo "Error deleting task: " . $e->getMessage();
    }
} else {
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
    header("Location: display.php");
}
?>
