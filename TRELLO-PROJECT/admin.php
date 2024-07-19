<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@800&family=Arimo&family=Barlow:wght@500&family=Bebas+Neue&family=Dancing+Script&family=Lobster&family=Montserrat:wght@100;400&family=Quicksand:wght@300&family=Roboto:wght@300&family=Tilt+Warp&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <title>ApartmentTour | Admin</title>
    <link rel="icon" href="/images/icons8-chef-hat-50.png">
    <style>
        .sec-container{
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: url(/media/bg-review.png);
    background-color: #252926;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 630px;
}
body {
  font-family: 'lato', sans-serif;
}
.container {
  max-width: 1000px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 10px;
  padding-right: 10px;
}

h2 {
  font-size: 26px;
  margin: 20px 0;
  text-align: center;
  small {
    font-size: 0.5em;
  }
}
table{
    margin-left:25%;
}
.responsive-table {
  li {
    border-radius: 3px;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
  }
  .table-header {
    background-color: #95A5A6;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .table-row {
    background-color: #ffffff;
    box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
  }
  .col-1 {
    flex-basis: 10%;
  }
  .col-2 {
    flex-basis: 40%;
  }
  .col-3 {
    flex-basis: 25%;
  }
  .col-4 {
    flex-basis: 25%;
  }
  
  @media all and (max-width: 767px) {
    .table-header {
      display: none;
    }
    .table-row{
      
    }
    li {
      display: block;
    }
    .col {
      
      flex-basis: 100%;
      
    }
    .col {
      display: flex;
      padding: 10px 0;
      &:before {
        color: #6C7A89;
        padding-right: 10px;
        content: attr(data-label);
        flex-basis: 50%;
        text-align: right;
      }
    }
  }
}
    </style>
</head>
<body>

    
    <div class="main-container">
        <div class="logo">
            <div class="ourlogo">ApartmentTour</div>
        </div>
        <div class="navi">
            <a class="homenavi" href="/Webpage3 - Homepage/homepage.html">HOME</a>
            <a class="recipenavi" href="/Webpage4 - Recipe/recipe.html">USERS</a>
            <a class="videonavi" href="/Webpage5 - Video/videospage.html">APARTMENTS</a>
        </div>
        <div class="searchbar">
            <input class="searchrecipe" type="search" placeholder="Search user/apartment">
        </div>
    </div>

    <div class="sec-container">
        <div class="box">
            <p class="description">WELCOME ADMIN</p>
        </div>
    </div>
    <div class="third-container">
        <div class="table-div">
            <table>

            </table>
        </div>
        
    </div>
    <?php
include('database.php');
$query = "SELECT id, location, street, bedroom, restroom, price FROM tblapartments";
$result = $conn->query($query);
?>
<div class="table-div">
    <div class="table1">
        <p class="description" style="font-size: 20px; color: Black; float:rigth;">Apartments Table</p>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr class="table-row">
                <th class="table-header">S.N</th>
                <th>ID</th>
                <th>Location</th>
                <th>Street</th>
                <th>Bedroom</th>
                <th>Restroom</th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                $sn = 1;
                while ($data = $result->fetch_assoc()) {
                ?>
            <tr class="table-row">
                <td><?php echo $sn; ?> </td>
                <td><?php echo $data['id']; ?> </td>
                <td><?php echo $data['location']; ?> </td>
                <td><?php echo $data['street']; ?> </td>
                <td><?php echo $data['bedroom']; ?> </td>
                <td><?php echo $data['restroom']; ?> </td>
                <td><?php echo $data['price']; ?> </td>
                <td><a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a></td>
                <td><a href="delete.php?id=<?php echo $data['id']; ?>">Delete</a></td>
            </tr>
            <?php
        $sn++;
        }
    } else {
        ?>
        <tr>
        <td colspan="9">No data found</td>
        </tr>
    <?php
    }
    ?>
        </table>
    </div>
</div>

<?php
$query = "SELECT userid, fullname, phone, email FROM tbllandlord";
$result = $conn->query($query);
?>

    <div class="table2">
    <p class="description" style="font-size: 20px; color: Black; float:rigth;">Users Table</p>
            <table border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <th>S.N</th>
                    <th>UserID</th>
                    <th>Fullname</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                // Fetch data for tbllandlords and display it similarly as above
                if ($result->num_rows > 0) {
                    $sn = 1; // Use the same $sn variable for consistency
                    while ($data = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $data['userid']; ?></td>
                            <td><?php echo $data['fullname']; ?></td>
                            <td><?php echo $data['phone']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><a href="edit_landlord.php?userid=<?php echo $data['userid']; ?>">Edit</a></td>
                            <td><a href="delete_landlord.php?userid=<?php echo $data['userid']; ?>">Delete</a></td>
                        </tr>
                <?php
                        $sn++;
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="7">No data found</td>
                    </tr>
                <?php
                }
                ?>
            </table>
</body>
</html>