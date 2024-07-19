<?php
include('database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM tblapartments WHERE id='$id'";
    $result = $conn->query($query);

    if ($result) {
        header('Location: admin.php'); // Redirect to the main page after deleting
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
