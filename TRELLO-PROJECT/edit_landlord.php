<?php
include('database.php');

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    if (isset($_POST['update'])) {
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $query = "UPDATE tbllandlord SET fullname='$fullname', phone='$phone', email='$email' WHERE userid='$userid'";
        $result = $conn->query($query);

        if ($result) {
            header('Location: admin.php'); // Redirect to the main page after updating
            exit();
        } else {
            echo "Error updating landlord: " . $conn->error;
        }
    }

    $query = "SELECT * FROM tbllandlord WHERE userid='$userid'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
    } else {
        echo "Landlord not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP INSERT UPDATE DELETE SEARCH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Forum;
        }
        * {
            box-sizing: border-box;
        }
        input[type=text], input[type=number], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 8px;
            resize: vertical;
        }
        input[type=submit] {
            background-color: #AF8C53;
            color: black;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: brown;
        }
        .main-container{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-content: center;
            background-image: url('media/bg-review.png');
            background-size: cover;
        }
        .overlay1{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-content: center;
            background: rgba(0, 0, 0, 0.3);
            height: 100vh;
            width: 100vw;
            padding-top: 5vh;
        }
        .container {
            border-radius: 5px;
            background-color: #000000;
            padding: 20px;
            width: 30vw;
            height: fit-content;
            border: 1px solid black;
            box-shadow: 5px 5px 5px;
        }
        legend { 
        color: #000000;
        background-color: #AF8C53;
        padding: 3px 5px;
        font-size: 20px;
        width: 20vw;
        }
        .upload-image-div{
            width: 15vw;
            height: 40vh;
            border: 1px solid black;
            background-color: rgba(0, 0, 0, 0.3);
            margin-right: .5vw;
            padding: 10px;
        }
        .image-container img{
            width: 30vh;
            height: 100%;
            display: flex;
            flex-wrap: wrap;
        }
        #image-container img {
            width: 100%; /* Adjust this value to your desired width */
            height: 70%; /* Maintain aspect ratio */
            margin-bottom: 10px;
        }
        .upload-image-div button{
            margin-top: 5vh;
        }
        .upload-image-div legend{
            font-size: 20px;
            width: 10vw;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="overlay1">
            <div class="container">
                <form action="edit_landlord.php" method="post">
                    <legend>Landlord/Users Information</legend>
                    <p style="color: white">User ID:<?php echo $userid; ?></p><br><br>
                    <input type="text" name="fullname" placeholder="Fullname" value="<?php echo $data['fullname']; ?>"><br><br>
                    <input type="number" name="phone" placeholder="Phone" value="<?php echo $data['phone']; ?>"><br><br>
                    <input type="email" name="email" placeholder="Email" value="<?php echo $data['email']; ?>"><br><br>
                    <div>
                        <input type="submit" name="update" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
