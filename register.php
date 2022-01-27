<?php
include "captcha.php";
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $username=$_POST['username'];
    $age=$_POST['age'];
    if(!empty($_POST['gender'])) {
        $gender=$_POST['gender'];
        
    }

    if(empty($email)||empty($password)||empty($username)||empty($gender)||empty($age)){
        echo "Fill in the fields";
    }else{
        if($_POST['captcha']==$_POST['captchahidden']){
            if(is_dir("user/".$email)){
                $fo=fopen("user/".$email."/details".$username.".txt","w");
                $un=trim(fgets($fo));
                echo "<h1>$un</h1>";
                if($un==$username){
                    echo "Username already Exists";
                }else{
                    $nf="details".$username.".txt"; 
                    $filename = "user/".$email."/".$nf;    
                    $fo = fopen($filename, "w");
                    fwrite($fo,$username."\n");
                    fwrite($fo,$password."\n");
                    fwrite($fo,$gender."\n");
                    fwrite($fo,$age."\n");
                    fwrite($fo,$filename."\n");

                    $tmp=$_FILES['file']['tmp_name'];
                    $filename=$_FILES['file']['name'];
                    $ext=pathinfo($filename,PATHINFO_EXTENSION);
                    $fn=$email.".$ext";
                    if(!empty($tmp)){
                        $dest="user/".$email."/";
                        if(move_uploaded_file($tmp,$dest.$fn)){
                            echo "Registered Successfully";
                            echo "$ext";
                        }else{
                            echo "Uploading error";
                        }
                    }else{
                        echo "Select a file";
                    }
                    }

                
            }
        
        else{
            mkdir("user/".$email);
            $filename = "user/".$email."/details".$username.".txt";    
            $fo = fopen($filename, "w");
            fwrite($fo,$username."\n");
            fwrite($fo,$password."\n");
            fwrite($fo,$gender."\n");
            fwrite($fo,$age."\n");
            fwrite($fo,$filename."\n");

            $tmp=$_FILES['file']['tmp_name'];
            $filename=$_FILES['file']['name'];
            $ext=pathinfo($filename,PATHINFO_EXTENSION);
            $fn=$email.".$ext";
            if(!empty($tmp)){
                $dest="user/".$email."/";
                if(move_uploaded_file($tmp,$dest.$fn)){
                    echo "Registered Successfully";
                    header('Location:welcome.php');
                }else{
                    echo "Uploading error";
                }
            }else{
                echo "Select a file";
            }
        }
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
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        body{
            margin-left: 300px;
            margin-right: 300px;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center">Registration Panel</h2>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group ">
        <label for="exampleInputEmail1">Email address:</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">    
    </div><br>
    <div class="form-group" >
        <label for="exampleInputUsername">Username:</label>
        <input type="text" name="username" class="form-control" placeholder="Username">
    </div>
        <br>
    <div class="form-group">
        <label for="exampleInputPassword1">Password:</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div><br>
    <div class="form-group row">
        <div class="col">
            <label for="">First Name:</label>
            <input type="text" name="fname" class="form-control" placeholder="First name">
        </div>
        <div class="col">
            <label for="">Last Name:</label>
            <input type="text" name="lname" class="form-control" placeholder="Last name">
        </div>
    </div><br>
    <div class="form-group">
        <label for="exampleFormControlInput1">Age:</label>
        <input type="number" name="age" class="form-control" id="exampleFormControlInput1" placeholder="Age">
    </div><br>
    <div class="form-group">
        <label for="">Gender:</label>
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio1" value="Male" name="gender" class="custom-control-input">
            <label class="custom-control-label" for="customRadio1">Male</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio2" value="Female" name="gender" class="custom-control-input">
            <label class="custom-control-label" for="customRadio2">Female</label>
        </div>
    </div><br>
    <div class="form-group">
        <div class="form-group">
            <label for="exampleFormControlFile1">Upload File:</label><br><br>
            <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">  
        </div>
    </div><br>
    <div class="form-group">
        <div class="form-group">
            <label for="captcha">Captcha: <?php echo $pattern; ?></label><br><br>
            <input type="text" name="captcha" class="form-control-input" id="captcha">  
            <input type="hidden" name="captchahidden" value="<?php echo $captchasum; ?>" class="form-control-input" id="captchahid">  
        </div>
    </div><br>
    <button type="submit" name="submit" class="btn btn-primary mb-3">Register</button>
    </form>
</body>
</html>