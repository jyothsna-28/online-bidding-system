<?php
if(isset($_POST['confirm']))
{
	include 'connect.php';
	session_start();
	$uid = $_SESSION['uid'];
	$bid = $_POST['bid'];
	$aid = $_POST['aid'];
    $p = "yes";
    $q = "UPDATE bidding set aid=$aid where bid = $bid";
    $sp = mysqli_prepare($conn,$q);
    mysqli_stmt_execute($sp);

    
	echo "<script>if (window.confirm('Successfully Bought')) 
            {
                window.location.href='http://localhost/WebProject/dashboard.php'
            };</script>";    	
    	exit();

    echo $aid;
    echo $p;

}else{
	header("Location:login.php?sfgd=NotAllowed");
    exit();
}
?>