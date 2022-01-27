<?php 
 session_start();
 $sid=$_SESSION['sid'];
 if(empty($sid)){
   header("location:login.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        *{
            box-sizing: border-box;
        }
        .side{
            width: 25%;
            margin-top:70px;
            float: left;
            list-style-type: none;  
        }
        .textpart{
            width: 75%;
            float: right ;
            text-align: justify;
            margin-top: 10px;
        }
        .nav-item{
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
</head>
<body>
    <header>
    <?php
            include 'nav.php';
        ?>
    </header>
    <section class="row container">
        <aside class="col-sm-4">
            <?php
                include 'sidebar.php';  
            ?>
        </aside>
        <aside class="col-sm-8">
                <?php 
                switch(@$_GET['con']){
                case 'changepass' : include("changepass.php");
                break;
                case 'category' : include("category.php");
                break;
                case 'orders' : include("orders.php");
                break;
                case 'products' : include("products.php");
                break;
                case 'feedback' : include("feedback.php");
                break;
                }
               ?>
        </aside>
    </section>
</div>
</body>
</html>