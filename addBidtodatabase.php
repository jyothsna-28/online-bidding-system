<?php
//include 'connect.php';
session_start();
if(isset($_SESSION["uid"])){
  echo $_SESSION["uid"];  
}else{
  header("Location:login.php");
}
if(isset($_POST['add'])){
	include 'connect.php';
	$error1 = $error2 =$error3=$error4=$error5=$error6=$error7='';
	$itemname = $_POST['itemname'];
	
	$price = $_POST['price'];
	$email = $_POST['email'];
    $cat = $_POST['category'];
    $uid = $_SESSION["uid"]; 
	$des = $_POST['description'];
	$img = null;
	$target_dir = "bidding/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image

    	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    	if($check !== false) {

        	echo "File is an image - " . $check["mime"] . ".";
        	$uploadOk = 1;
    	} else {
        	echo "<script>if (window.confirm('File is not an image..')) 
            {
                window.location.href='http://localhost/WebProject/addBidding.php';
            };</script>";
        	$uploadOk = 0;
    	}
	
// Check if file already exists
	if (file_exists($target_file)) {
    	echo "<script>if (window.confirm('Sorry, file already exists.')) 
            {
                window.location.href='http://localhost/WebProject/addBidding.php';
            };</script>";
    	$uploadOk = 0;
	}
// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
    	
    	echo "<script>if (window.confirm('Sorry, your file is too large.')) 
            {
                window.location.href='http://localhost/WebProject/addBidding.php';
            };</script>";
    	$uploadOk = 0;
	}
// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
    	echo "<script>if (window.confirm('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')) 
            {
                window.location.href='http://localhost/WebProject/addBidding.php';
            };</script>";
    	$uploadOk = 0;
	}
// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
    	
    	echo "<script>if (window.confirm('Sorry, your file was not uploaded.')) 
            {
                window.location.href='http://localhost/WebProject/addBidding.php';
            };</script>";
// if everything is ok, try to upload file
	} else {
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    		
        	$img = "bidding/".basename( $_FILES["fileToUpload"]["name"]);
    	} else {
        	echo "<script>if (window.confirm('Sorry, there was an error uploading your file.')) 
            {
                window.location.href='http://localhost/WebProject/addBidding.php';
            };</script>";
    	}
	}
	
    
        $time = "".time();
        $act = "active";
    
    	$stmt = $conn->prepare("INSERT INTO bidding (uid,suid,category,email,itemname,price,description,imagepath,time) VALUES (?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param('iisssisss',$uid,$uid,$cat, $email, $itemname,$price,$des,$img,$time);
		$stmt->execute();
		echo "<script>if (window.confirm('Items added successfully')) 
            {
                window.location.href='http://localhost/WebProject/addBidding.php';
            };</script>";

    
}else{
	header("Location:addBidding.php?Not entered");
    exit();
} 
?>