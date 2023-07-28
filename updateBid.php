<?php
//include 'connect.php';
session_start();
if(isset($_SESSION["uid"])){
  //echo $_SESSION["uid"];  
}else{
  header("Location:login.php");
}
if(isset($_POST['add'])){
	include 'connect.php';
	$bid = $_POST['bid'];
	$price = $_POST['price'];
	$uid = $_SESSION['uid'];

	$q = "SELECT * from bidding where bid = $bid";
        $sp = mysqli_prepare($conn,$q);
        mysqli_stmt_execute($sp);
        $result = mysqli_stmt_get_result($sp);
        $hbid = 0;

        while($r = $result->fetch_assoc()){
          $hbid = $r['price'];
        }

        echo $price;
        echo $hbid;

        if($price<=(int)$hbid){
            echo "Hi";
        	echo "<script>if (window.confirm('You cant bid lesser')) 
            {
                window.location.href='http://localhost/WebProject/bidNow.php?bid=".$bid."';
            };</script>";
        }else{

     	 $q = "UPDATE bidding SET price = $price,suid=$uid WHERE bid = $bid";
         $sp = mysqli_prepare($conn,$q);
         mysqli_stmt_execute($sp);
         echo "<script>if (window.confirm('Bid Succesfull')) 
             {
                 window.location.href='http://localhost/WebProject/bidNow.php?bid=".$bid."';
            };</script>";
        }

}else{
	header("Location:viewBids.php");
}