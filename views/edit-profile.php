<?php
    include_once ("../model/model.php");
    include_once ("../functions.php");
    session_start();
    $status = "";
    
    $data = get_user_data($_SESSION['email'], $conn);
    $email =  $_SESSION['email'];
    $username=$data['user_name'];
    $password = $data['user_password'];
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['username'])){
            $new_username = $_POST['username'];
            if (strlen ($new_username)>10){
                $status = "Name is too long!";
            }
            if ($status == ""){
                $sql_username = "UPDATE user SET user_name = '$new_username' WHERE user_email = '$email'";
                if ($conn->query($sql_username) === TRUE) {
                } else {
                    $status = "Something went wrong. Try again!";
                }
            }
        }

        if ((!empty($_POST['oldPassword']) && empty($_POST['newPassword']) || empty($_POST['confirmPassword'])) ||
        (!empty($_POST['newPassword']) && empty($_POST['oldPassword']) || empty($_POST['confirmPassword'])) ||
        (!empty($_POST['confirmPassword']) && empty($_POST['newPassword']) || empty($_POST['oldPassword']))){
            $status = "Please fill all the forms!";
        }
        if (empty($_POST['oldPassword']) && empty($_POST['newPassword']) && empty($_POST['confirmPassword'])) {
            $status = "";
        }
        

        if (!empty($_POST['oldPassword']) && $status == ""){
            $oldPassword = $_POST['oldPassword'];
            if (user_authenticate($email, $oldPassword, $conn) == false){
                $status = "Old password incorrect!";
            }
            else {
                if ($_POST['newPassword'] == $_POST['confirmPassword']){
                    $new_password = $_POST['newPassword'];
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    if ($status == ""){
                        $sql_password = "UPDATE user SET user_password = '$hashed_password' WHERE user_email = '$email'";
                        if ($conn->query($sql_password) === TRUE) {
                        } else {
                            $status = "Something went wrong. Try again!";
                        }
                    }
                }
                else {
                    $status = "Passwords don't match";
                }
            }
        }
        if ($status == ""){
            redirect("profile");
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
    <title>Edit- profile</title>
</head>
<body>
    <div class="topnav">
        <a href="store.php">Store</a>
        <a href="news.php">News</a>
        <a class = "active" href=""><?php  echo $username ?></a>
        <a class = "about" href="about.php">About</a>
        <a class = "logout" href="../app/logout.php">Logout</a>
    </div>
    <form action="" method = "POST">
        <section class="vh-100" style="background-color: #d9dad7;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="w-100 h-100">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-5"><?php  echo $username ?></h3>
                                <?php if ($status != ""){
                                    echo "<span style='color: red'> $status <br> </span>";
                                }?>
                            <div class="form-outline mb-4">
                                <input type="email" id = "typeEmail" name="email" value = "<?php echo $_SESSION['email'] ?>" class="form-control form-control-lg" disabled/>
                                <label class="form-label" for="typeUsername">Mail</label>
                            </div>    
                            <div class="form-outline mb-4">
                                <input type="username" id = "typeUsername" name="username" value = "<?php echo $username ?>" class="form-control form-control-lg" />
                                <label class="form-label" for="typeUsername">Username</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="typePasswordX-2" name="oldPassword" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX-2">Old password</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="typePasswordX-2" name="newPassword" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX-2">New password</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="typePasswordX-2" name="confirmPassword" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX-2">Confirm password</label>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" name = "submit" type="submit">Update</button>
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

