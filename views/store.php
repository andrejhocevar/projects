<?php
    include_once ("../model/model.php");
    include_once ("../functions.php");
    session_start();

    $sql = "SELECT photo_title, photo_description, photo, author_id FROM photo ORDER BY upload_date DESC";
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
    <title>Store</title>
</head>
<body>
    <?php
        $data = get_user_data($_SESSION['email'], $conn);
        $username=$data['user_name'];
    ?>
    <div class="topnav">
        <a class="active" href="">Store</a>
        <a href="news.php">News</a>
        <a href="profile.php"><?php  echo $username ?></a>
        <a class = "about" href="about.php">About</a>
        <a class = "logout" href="../app/logout.php">Logout</a>
    </div>
        <section class="vh-1000" style="background-color: #d9dad7;">
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                <?php while($row = $result->fetch_assoc()) {
                                    $author_id = $row['author_id'];
                                    $query = "SELECT user_name, user_id FROM user WHERE user_id = $author_id";
                                    $query_res = $conn->query($query);
                                    $user = $query_res->fetch_assoc();
                                    ?>
                                    <h1><?php echo $row['photo_title'] ?></h1>
                                    <p><?php echo $row['photo_description'];
                                    echo "<br>";
                                    $user_name = $user['user_name'];
                                    echo '<a href="user-profile.php?user='.urlencode($user_name).'">'.$user_name.'</a>'; ?>
                                    <br>
                                    
                                    <img src="photo/<?php echo $row['photo']?>" width=500px height = 500px>
                                <?php } ?>
                            </div>    
                        </div>  
                    </div>
                </div>
            </div>
        </section>
</body>
</html>



