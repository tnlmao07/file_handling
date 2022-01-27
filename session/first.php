<?php
if (isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    if(!empty($email)&&!empty($password)){
        session_start();
        $_SESSION['tnl']=$email;
        setcookie("Email","$email");
        header('Location:second.php');
    }else{
        echo "Fill the blank fields";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        Email: <input type="email" name="email"><br>
        Password: <input type="password" name="password">
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html> 