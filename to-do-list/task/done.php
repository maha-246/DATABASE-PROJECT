<?php
include '../includes/db.php';

if (isset($_GET['taskID'])) {
    $taskID = $_GET['taskID'];

    $updateStatusQuery = "UPDATE tasks SET taskStatus = 'Complete' WHERE taskID = ?";
    $stmt = $conn->prepare($updateStatusQuery);
    $stmt->bind_param("i", $taskID);
    $stmt->execute();

    // Redirect back to the display page after updating the task status
    header("Location: display.php");
    exit();
} else {
    die("Task not found.");
}
?>
