<?php
error_reporting(0);
if(isset($_POST['submit']) && isset($_POST['check'])){
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $pass1=$password;
    $check=$_POST['check'];
    if(empty(!$username) && empty(!$email) && empty(!$check)){
        if(is_dir("user/".$email)){
            $fo=fopen("user/".$email."/details".$username.".txt","r");
            fgets($fo);
            $pass=trim(fgets($fo));
            if($pass==$password){
                echo "Login Successful";
                session_start();
                $_SESSION['sid']=$email;
                setcookie("email","$email",time()+3600*20);
                setcookie("password","$pass1",time()+3600*20);
                header('Location:dashboard.php');
            }else{
                echo "Password Incorrect";
            }
        }else{
            echo "No records Found";
        }
    }else{
        echo "Fill in the fields";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        .mar{
            margin-left: 400px;
            margin-right: 400px;
            margin-top: 20px    ;
        }
    </style>
    <script>
        function cook(){
            if("<?php echo $_COOKIE['email'] ?>"!=undefined){
                if(document.getElementById("email").value=="<?php echo $_COOKIE['email']; ?>"){
                    document.getElementById("password").value="<?php echo $_COOKIE['password']?>";
                }else{
                    doc.getElementById("email").value="";
                }
            }
        }
    </script>
</head>
<body>
<form class="mar" method="post">
    <h2 style="text-align: center;">Login Panel</h2>
    <div class="form-group ">
        <label for="username">Username:</label>
        <input type="text" name="username" class="form-control" id="username"  placeholder="Enter Username">
    </div>
    <div class="form-group ">
        <label for="email">Email address:</label>
        <input type="email" name="email" class="form-control" id="email" onchange="cook()" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
    </div>
    <div class="form-group form-check">
        <input name="check" value="0" type="hidden">
        <input type="checkbox" name="check" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
    </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="register.php">New User</a>
</form>
</body>
</html>