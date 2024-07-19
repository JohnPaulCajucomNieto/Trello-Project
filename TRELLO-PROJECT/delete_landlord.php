<?php
include('database.php');

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    $query = "DELETE FROM tbllandlord WHERE userid='$userid'";
    $result = $conn->query($query);

    if ($result) {
        header('Location: admin.php'); // Redirect to the main page after deleting
        exit();
    } else {
        echo "Error deleting landlord: " . $conn->error;
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
