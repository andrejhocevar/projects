<?php
    include_once ("../model/model.php");
    include_once ("../functions.php");
    session_start();
    
    $data = get_user_data($_SESSION['email'], $conn);
    $username=$data['user_name'];
    $user_name = $_GET['user']; //Passed from store, when clicked on link to profile
    
    $query = "SELECT user_id FROM user WHERE user_name = '$user_name'";
    $query_res = $conn->query($query);
    $user_result = $query_res->fetch_assoc();
    $user_id = $user_result['user_id'];

    
    $sql = "SELECT photo_title, photo_description, photo FROM photo WHERE author_id = '$user_id' ORDER BY upload_date DESC";
    $result = $conn->query($sql);
    
    
   
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/styles.css">
    <title>Profile</title>
</head>
<body>
    <div class="topnav">
        <a class = "active" href="store.php">Store</a>
        <a href="news.php">News</a>
        <a href=""><?php  echo $username ?></a>
        <a class = "about" href="about.php">About</a>
        <a class = "logout" href="../app/logout.php">Logout</a>
    </div>
    
    <?php while($row = $result->fetch_assoc()) {?>

            <h1>Title: <?php echo $row['photo_title'] ?></h1>
            <p>Description: <?php echo $row['photo_description'] ?></p>
            <img src="photo/<?php echo $row['photo']?>" width=500px height = 500px>
    <?php } ?>

</body>
</html>

