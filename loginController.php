<?php

if(isset($_POST['login']))
{
    include 'connect.php';
    $error1 = $error2 =$error3=$error4='';
    $un = $_POST['email'];
    $pw = $_POST['password'];
    
    
    
        $q = "SELECT * from users where email =?";

        $sp = mysqli_prepare($conn,$q);
        mysqli_stmt_bind_param($sp,'s',$un);
        mysqli_stmt_execute($sp);
        $result = mysqli_stmt_get_result($sp);
        $id = null;
        $username= null;
        $password = null;
        while($rows = $result->fetch_assoc()){
            $id = $rows['id'];
            $username = $rows['email'];
            $password = $rows['password'];
        }
        echo $un;
        if($username!=$un){
        	$error3 = "wrong username";
        	header("Location:login.php?err3=$error3&err4=$error4");
        }
        else if($password!=$pw){
        	$error4 = "wrong password";
        	header("Location:login.php?err3=$error3&err4=$error4");
        }
        else{
            session_start();
            $_SESSION["uid"] = $id;
        	header("Location:dashboard.php?sfgd=xyz");
        	exit();
        }
// echo mysqli_num_rows($result);
        
    


 

    }
    else
    {
    
        header("Location:login.php?sfgd=xyz");
        exit();
    }

?>
