<?php
    include_once ("../model/model.php");
    include_once ("../functions.php");
    session_start();
    
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/styles.css">
    <title>About</title>
</head>
<body>
    <?php
        $data = get_user_data($_SESSION['email'], $conn);
        $username=$data['user_name'];
    ?>
    <div class="topnav">
        <a href="store.php">Store</a>
        <a href="news.php">News</a>
        <a href="profile.php"><?php echo $username ?></a>
        <a class = "active about" href="about.php">About</a>
        <a class = "logout" href="../app/logout.php">Logout</a>
    </div>
    <section class="vh-100" style="background-color: #d9dad7;">

    </section>
</body>
</html>

