<?php
	session_start();
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}

	//unset qunatity
	unset($_SESSION['qty_array']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Shop | Prescription</title>
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
        <link rel="stylesheet" href="css/pres.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<style>
		.product_image{
			height:200px;
		}
		.product_name{
			height:80px; 
			padding-left:20px; 
			padding-right:20px;
		}
		.product_footer{
			padding-left:20px; 
			padding-right:20px;
		}
	</style>
</head>
<body>
     <nav>
            <a href="index.html"><img class="logo" src="img/uleaf.png" width="50px" height="50px"></a>
            <ul>
                <li><a href="about.html">ABOUT</a></li>
                <li><a href="contact.html">CONTACT</a></li>
                <li><a href="#">BLOG</a></li>
                <li><a href="shop.php">SHOP</a></li>
            </ul>
        </nav>
            <div class='row'>
                <div class='triple-column'>
                    <div class='main-column'>
                                <h1>prescription</h1>
                        <p>Our Herbal prescriptions medicines use parts of a plant, such as the leaves, bark, flowers, roots, or berries to treat a medical ailment. The medicines come in many forms, including tablets, teas, capsules, syrups, creams, and powders.</p>
                    </div>
                </div>
            </div>
<div class="container" style="min-height: 110vh;
    position: relative;">
	<nav class="navbar navbar-default">
              <h5>
	      	<li><a href="view_cart.php">(<?php echo count($_SESSION['cart']); ?>) View Cart</a></li></h5>
	</nav>
	<?php
		//info message
		if(isset($_SESSION['message'])){
			?>
			<div class="row">
				<div class="col-sm-12">
					<div class="alert alert-info text-center">
						<?php echo $_SESSION['message']; ?>
					</div>
				</div>
			</div>
			<?php
			unset($_SESSION['message']);
		}
		//end info message
		//fetch our products	
		//connection
		$conn = new mysqli('localhost', 'root', '', 'ustawi');

		$sql = "SELECT * FROM products WHERE catid = 1";
		$query = $conn->query($sql);
		$inc = 4;
		while($row = $query->fetch_assoc()){
			$inc = ($inc == 4) ? 1 : $inc + 1; 
			if($inc == 1) echo "<div class='row text-center'>";  
			?>
			<div class="col-sm-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row product_image">
							<img src="<?php echo $row['photo'] ?>" width="100%" height="auto">
						</div>
						<div class="row product_name">
							<h4><?php echo $row['proname']; ?></h4>
						</div>
						<div class="row product_footer">
							<p class="pull-left"><b>KSH <?php echo $row['price']; ?></b></p>
							<br>
							<span class="pull-right"><a href="add_cart.php?id=<?php echo $row['proid']; ?>" class="btn btn-primary btn-sm">Add to Cart</a></span>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		if($inc == 1) echo "<div></div><div></div><div></div></div>"; 
		if($inc == 2) echo "<div></div><div></div></div>"; 
		if($inc == 3) echo "<div></div></div>";
		
		//end product row 
	?>
</div>
    <div class="footer">
            <div id="social-icons">
                <a href="http://www.facebook.com" target="_blank"><img src="img/facebook.svg" alt="facebook-icon" id="truck"></a>
                <a href="http://www.instagram.com" target="_blank"><img src="img/instagram.svg" alt="instagram-icon" id="ship"></a>
                <a href="http://www.twitter.com" target="_blank"><img src="img/twitter.svg" alt="twitter-icon" id="rail"></a>
            </div>
            <p>© Copyright 2019 Ustawi. All rights reserved.</p>
        </div>
</body>
</html>