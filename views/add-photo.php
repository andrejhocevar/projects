<?php
    include_once ("../model/model.php");
    include_once ("../functions.php");
    session_start();
    $directory = dirname("htdocs/views/add-photo.php");
    $data = get_user_data($_SESSION['email'], $conn);
    $username=$data['user_name'];
    $user_id = $data['user_id'];
    $status = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['title'])){
            $title = $_POST['title'];
            if (strlen ($title)>30){
                $status = " Title is too long!";
            }
        }
        else $status = "Please fill all the forms!";
        if (!empty('description')){
            $description = $_POST['description'];
            if (strlen ($description)>1000){
                $status = " Title is too long!";
            }
        }
        else $status = "Please fill all the forms!";
        if (!empty($_FILES['photo'])){
            $photo = $_FILES['photo']['name'];
        }
        else $status = "Add photo";
        if ($status == ""){
            $sql = "INSERT INTO photo(author_id, photo_title, photo_description, photo) 
            VALUES ('$user_id', '$title', '$description', '$photo')";
            if ($conn->query($sql) === TRUE) {
                move_uploaded_file($_FILES['photo']['tmp_name'], "C:/MAMP/htdocs/views/photo/$photo");
                redirect('profile');
            } else {
                $status = "Something went wrong. Try again!";
            }
        }
    }
    

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
    <form action="add-photo.php" method = "POST" enctype="multipart/form-data">  <!-- enctype="multipart/form-data" -->
        <section class="vh-100" style="background-color: #d9dad7;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="w-100 h-100">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-5">Upload photo</h3>
                                <?php if ($status != ""){
                                    echo "<span style='color: red'> $status <br> </span>";
                                }?>
                            <div class="form-outline mb-4">
                                <input type="text" id = "typeEmail" name="title" class="form-control form-control-lg"/>
                                <label class="form-label" for="typeUsername">Title</label>
                            </div>    
                            <div class="form-outline mb-4">
                                <input type="text" id = "typeUsername" name="description" class="form-control form-control-lg" />
                                <label class="form-label" for="typeUsername">Description</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="file" id="typePasswordX-2" name="photo" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX-2">Add photo</label>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" name = "submit" type="submit">Upload</button>
                            <br>
                            <a href="profile.php">Back</a>                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</body>
</html>

