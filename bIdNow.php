
<?php

  
  session_start();
  $bid = $_GET['bid'];

?>

<html>
	
	<head>
		
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}
.size{
	margin-left: 25%;
	width: 800px;
}

.bcolor{
	color: white;
	background-color: blue;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

.error{
	color: red;
}
</style>
</head>
<body>
	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="dashboard.php">Home</a>
  <a href="shop.php">Shop</a>
  <a href="sellItem.php">Sell Items</a>
  <a href="addAddress.php">Add address</a>
  <a href="items.php">Bag</a>
  <a href="addBidding.php">Add Bid</a>
  <a href="viewBids.php">view Bids</a>
  <a href="myBids.php">My Bids</a>
  <a href="myBouBids.php">Bought Bids</a>
  <a href="#">Contact Us</a>
  <a href="logout.php">Logout</a>

</div>

<div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>



	<form class="form-horizontal size" action="updateBid.php" method="post" enctype="multipart/form-data" style="padding-left: 80px;">
    <br/>
    <br/>
    <br />
    <br />
    <?php
        include 'connect.php';
        $q = "SELECT * from bidding where bid = $bid";
        $sp = mysqli_prepare($conn,$q);
        mysqli_stmt_execute($sp);
        $result = mysqli_stmt_get_result($sp);
        $hbid = 0;
        $uid = 0;

        while($r = $result->fetch_assoc()){
          $hbid = $r['price'];
          $uid = $r['suid'];
        }
        $s = "";
        if($uid==$_SESSION['uid']){
          $s = "(YOU)";
        }

    ?>
    <label class="control-label" style="margin-left: 15px;color: green"><b>Highest Bid As Of Now : <?php echo $hbid; ?> <?php echo $s; ?></b></label>
    <br/>
    <br/>
    <input type="text" name="bid" hidden="hidden" value="<?php echo $bid; ?>">
  <div class="form-group">
    <label class="control-label" style="margin-left: 15px;" for="itemname">Enter Your Price:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="price" name = "price" placeholder="Enter your price"><br>
    </div>
  </div>
  
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default bcolor" name="add">Submit</button>
    </div>
  </div>
</form>
</div>
</body>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
</html>

