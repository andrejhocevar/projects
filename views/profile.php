<?php
    include_once ("../model/model.php");
    include_once ("../functions.php");
    session_start();
    
    $data = get_user_data($_SESSION['email'], $conn);
    $username=$data['user_name'];
    $user_id = $data['user_id'];

    
    $sql = "SELECT photo_title, photo_description, photo FROM photo WHERE author_id = $user_id ORDER BY upload_date DESC";
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
        <a href="store.php">Store</a>
        <a href="news.php">News</a>
        <a class = "active" href=""><?php  echo $username ?></a>
        <a class = "about" href="about.php">About</a>
        <a class = "logout" href="../app/logout.php">Logout</a>
    </div>

    <section class="vh-1000" style="background-color: #d9dad7;">
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="w-50 h-100">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                            <div class="form-outline mb-4">
                                <img src="../public/images/photo.png" alt="" width = 100px>
                                <a href="add-photo.php">Add</a> photo
                            </div>    
                            <div class="form-outline mb-4">
                                <img src="../public/images/profile.png" alt="" width = 120px>
                                <a href="edit-profile.php">Edit</a> profile
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                <?php while($row = $result->fetch_assoc()) {?>            
                                    <h1><?php echo $row['photo_title'] ?></h1>
                                    <p><?php echo $row['photo_description'] ?></p>
                                    <img src="photo/<?php echo $row['photo']?>">
                                <?php } ?>
                            </div>    
                        </div>  
                    </div>
                </div>
            </div>
        </section>

</body>
</html>

