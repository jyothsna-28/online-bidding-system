<?php
session_start();
if(isset($_SESSION["uid"])){
  header("Location:dashboard.php");   
}
$error1 ='';
$error2 ='';
$error3 ='';
$error4 ='';
if(isset($_GET['err1']))
{
    if($_GET['err1']=='empty_u')
    {
        $error1 = "username required";
    }
    if($_GET['err2']=='empty_p')
    {
        $error2 = "password required";
    }
}
if(isset($_GET['err3'])){
    if($_GET['err3']=='wrong username')
    {
        $error3 = "Wrong Username";
    }
    if($_GET['err4']=='wrong password')
    {
        $error4 = "Wrong Password";
    }
    
    
}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="loginCSS.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="login">
    <h1>Enter OTP</h1>
    <form method="post" action="passwordReset.php">
        <input type="text" name="otp" placeholder="enter otp" required="required" />
        <br/>
        <br />
        <button type="submit" class="btn btn-primary btn-block btn-large" name="submit">submit</button>
    </form>
    <br />
    <br />
    
</div>
</body>
</html>