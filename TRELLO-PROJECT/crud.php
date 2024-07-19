<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "databases";

$id = "";
$location = "";
$street = "";
$bedroom = "";
$restroom = "";
$price = "";
$userid = "";
$fullName = "";
$phone = "";
$email = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    echo 'Error';
}

function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['id'];
    $posts[1] = $_POST['location'];
    $posts[2] = $_POST['street'];
    $posts[3] = $_POST['bedroom'];
    $posts[4] = $_POST['restroom'];
    $posts[5] = $_POST['price'];
    return $posts;
}

// Search
if (isset($_POST['search'])) {
    $data = getPosts();

    $search_Query = "SELECT * FROM tblapartments WHERE id = $data[0]";

    $search_Result = mysqli_query($connect, $search_Query);

    if ($search_Result) {
        if (mysqli_num_rows($search_Result) > 0) {
            while ($row = mysqli_fetch_assoc($search_Result)) {
                $id = $row['id'];
                $location = $row['location'];
                $street = $row['street'];
                $bedroom = $row['bedroom'];
                $restroom = $row['restroom'];
                $price = $row['price'];
            }
        } else {
            echo 'No Data For This Id';
        }
    } else {
        echo 'Result Error';
    }
}


// Insert
if (isset($_POST['insert'])) {
    $data = getPosts();

    // Insert into tblapartments
    $insert_Query = "INSERT INTO tblapartments (location, street, bedroom, restroom, price) 
                     VALUES ('$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]')";
    
    try {
        $insert_Result = mysqli_query($connect, $insert_Query);

        if ($insert_Result) {
            echo 'Data Inserted into tblapartments';
        } else {
            echo 'Data Not Inserted into tblapartments';
        }
    } catch (Exception $ex) {
        echo 'Error Insert ' . $ex->getMessage();
    }
}

// Delete
if (isset($_POST['delete'])) {
    $data = getPosts();
    $delete_Query = "DELETE FROM tblapartments WHERE id = $data[0]";
    try {
        $delete_Result = mysqli_query($connect, $delete_Query);
        if ($delete_Result) {
            echo 'Data Deleted';
        } else {
            echo 'Data Not Deleted';
        }
    } catch (Exception $ex) {
        echo 'Error Delete ' . $ex->getMessage();
    }
}

// Edit
if (isset($_POST['update'])) {
    $data = getPosts();
    $update_Query = "UPDATE tblapartments SET location = '$data[1]', street = '$data[2]', 
                    bedroom = '$data[3]', restroom = '$data[4]', price = '$data[5]' WHERE id = '$data[0]'";
    try {
        $update_Result = mysqli_query($connect, $update_Query);
        if ($update_Result) {
            echo 'Data Updated';
        } else {
            echo 'Data Not Updated';
        }
    } catch (Exception $ex) {
        echo 'Error Update ' . $ex->getMessage();
    }
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
            <div class="upload-image-div">
                <form action="crud.php" method="post">
                    <legend>Upload Image</legend>
                    <input accept="image/*" type="file" id="photo" name="photo" multiple>
                </form>
                <div id="image-container"></div>
                <button onclick="goToNextPage()">Go to Homepage</button>
            </div>
            <div class="container">
                <form action="crud.php" method="post">
                    <legend>Apartment Information</legend>
                    <input type="number" name="id" placeholder="Product ID" value="<?php echo $id; ?>"><br><br>
                    <input type="text" name="location" placeholder="Location" value="<?php echo $location; ?>"><br><br>
                    <input type="text" name="street" placeholder="Street" value="<?php echo $street; ?>"><br><br>
                    <input type="number" name="bedroom" placeholder="Bedroom" value="<?php echo $bedroom; ?>"><br><br>
                    <input type="number" name="restroom" placeholder="Restroom" value="<?php echo $restroom; ?>"><br><br>
                    <input type="number" name="price" placeholder="Price" value="<?php echo $price; ?>"><br><br>
                    <div>
                        <input type="submit" name="insert" value="Add">
                        <input type="submit" name="update" value="Update">
                        <input type="submit" name="delete" value="Delete">
                        <input type="submit" name="search" value="Find">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('photo').onchange = function () {
    var imageContainer = document.getElementById('image-container');
    uploadedFiles = [];

    for (var i = 0; i < this.files.length; i++) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var src = e.target.result;
            var image = document.createElement('img');
            image.src = src;
            imageContainer.appendChild(image);

            uploadedFiles.push(src);
            localStorage.setItem('uploadedImages', JSON.stringify(uploadedFiles));
        };

        reader.readAsDataURL(this.files[i]);
    }
    };
    function goToNextPage() {
            // Redirect to the next page
            alert("APARTMENT LISTED!")
            window.location.href = 'homepage.php';
        }
    </script>
</body>
</html>
 
 