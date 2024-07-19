<?php
include('database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['update'])) {
        $location = $_POST['location'];
        $street = $_POST['street'];
        $bedroom = $_POST['bedroom'];
        $restroom = $_POST['restroom'];
        $price = $_POST['price'];

        $query = "UPDATE tblapartments SET location='$location', street='$street', bedroom='$bedroom', restroom='$restroom', price='$price' WHERE id='$id'";
        $result = $conn->query($query);

        if ($result) {
            header('Location: admin.php'); // Redirect to the main page after updating
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $query = "SELECT * FROM tblapartments WHERE id='$id'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
    } else {
        echo "Record not found.";
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
                <form action="edit.php" method="post">
                    <legend>Apartment Information</legend>
                    <p style="color: white">Apartment ID:<?php echo $id; ?></p><br><br>
                    <input type="text" name="location" placeholder="Location" value="<?php echo $data['location']; ?>"><br><br>
                    <input type="text" name="street" placeholder="Street" value="<?php echo $data['street']; ?>"><br><br>
                    <input type="number" name="bedroom" placeholder="Bedroom" value="<?php echo $data['bedroom']; ?>"><br><br>
                    <input type="number" name="restroom" placeholder="Restroom" value="<?php echo $data['restroom']; ?>"><br><br>
                    <input type="number" name="price" placeholder="Price" value="<?php echo $data['price']; ?>"><br><br>
                    <div>
                        <input type="submit" name="update" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
