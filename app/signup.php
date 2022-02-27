<?php
    include ("../model/model.php");
    require_once("../functions.php");
    $status = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        if (strpos($name, " ")){
            $status = "No spaces in name!";
        }
        if (strlen($name)>10){
            $status = "Name is too long!";
        }
        $email = $_POST['email'];
        if (!check_if_email_exist($email, $conn)){
            $status = "Email already exists!";
        }
        $us_name = $_POST['name'];
        if (!check_if_name_exist($us_name, $conn)){
            $status = "Name already taken!";
        }

        if ($_POST['password'] == $_POST['confirmPassword']){
            $password = $_POST['password'];
        }
        else {
            if ($_POST['confirmPassword'] == ""){
                $status = "Please fill all the forms!";
            }
            else{
                $status = "Passwords don't match!";
            }
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if ($name!="" && $email!="" && $password!="" && $status == ""){
            $sql = "INSERT INTO user(user_name, user_email, user_password) 
            VALUES ('$name', '$email', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                redirect('login');
              } else {
                $status = "Something went wrong. Try again!";
            }

        }
        else{
            if ($status == ""){
                $status = "Please fill all the forms!";
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
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="public/styles.css">
    <title>Sign up</title>
</head>
<body>
    <form action="" method = "POST">
        <section class="vh-100" style="background-color: #d9dad7;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-5">Sign up</h3>
                                <?php if ($status != ""){
                                    echo "<span style='color: red'> $status <br> </span>";
                                } ?>

                                <div class="form-outline mb-4">
                                    <input type="name" id="typeName" name="name" class="form-control form-control-lg" />
                                    <label class="form-label" for="typeName">Name</label>
                                </div>                       
                                <div class="form-outline mb-4">
                                    <input type="email" id="typeEmailX-2" name="email" class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX-2">Email</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="typePasswordX-2" name="password" class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordX-2">Password</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="typePasswordConfirm" name = "confirmPassword" class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordConfirm">Confirm Password</label>
                                </div>
                                
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Sign up</button>
                                <p>Already have an account? <a href="login.php">Login</a></p>                                                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</body>
</html>