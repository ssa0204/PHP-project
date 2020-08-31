<!-- Code written by
	Subramanya Soujanya Akella
	Student id: 11333719
	Date: 20th February, 2020
	Code for web page, "The Antique". 
	page 1 of 2.
-->

<?php
//we are establishing connection with database bvv
	$dbConnection =mysqli_connect("student-db.cse.unt.edu","ssa0204","ssa0204","ssa0204");
	//check db connection
	if(mysqli_connect_errno()){
		echo "Database connection could not be established.".mysqli_connect_error(); 
	}
?>
<!DOCTYPE html>
<html>
<head>
	<style>
	.button {background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;}
	body {border:2px solid blue; background-color:lightblue;text-align:center; font-size:50px; font-style:oblique; color:purple;}
	h6 {color:red;}
	</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> THE ANTIQUE</title>
</head>
<body>
<!-- the html page starts from here -->
<h1> WELCOME TO "THE ANTIQUE"!! </h1>
<h3>An online portal where you can buy vintage clothing.</h3>

<form action="" method="post">
	<label>Select any of the below outfits.</label>
	<br>
	<img style align="left" src="16th century.jpg" alt="Blue and grey gown" width="300" height="400">
	<img src="17th century.jpg" alt="White gown" width="300" height="400">
	<img style align="right" src="18th century.jpg" alt="Maroon gown" width="300" height="400"> 
	
	<h5>Select a product in the list: </h5>
	<select style name="prodname" id="prodname">
	<option value="first" checked>Blue and grey 16th century gown $71.99 </option>
	<option value="second">White 17th century gown $54.99</option>
	<option value="third">Maroon 18th century gown $69.99</option>
	</select><br>
	<label for="sizes"> Size: </label>
	<select name="sizes" id="sizes"> 
        <option value="XS">XS</option> 
        <option value="S" selected>S </option> 
        <option value="M" >M </option> 
		<option value="L" >L </option> 
		<option value="XL" >XL </option> 
		<option value="XXL" >XXL </option> 
    </select> <br>
<!-- ok button is used to add items to the cart. cancel to delete items from the cart. -->
<!-- submit is used to proceed to checkout. reset to clear contents on the form. -->
	<label for="quantity"> Quantity: </label>
	<input type="number" id="quantity" name="quantity" required><br>
	<button class="button"  name="ok" >OK</button>
	</form>
	<form action="" method="post">
		<button class="button" name="cancel" >Cancel</button>
	</form>
	<form action="secondpage.php" method="post">
		<button class="button" type="submit" >Submit</button>
		<button class="button" type="reset" value="Reset">Reset</button>
	</form>
	<?php 
	if( isset($_POST['ok']))
	{
		$product=$_POST['prodname'];
		$size=$_POST['sizes'];
		$quantity=$_POST['quantity'];
		$date= date("y-m-d H:i:s");
		if($product=='first'){
			$prodname="Blue and grey 16th century gown";
			$cost=71.99;
		}
		else if($product=='second'){
			$cost=54.99;
			$prodname="White 17th century gown";
		}
		else if($product=='third'){
			$cost=69.99;
			$prodname="Maroon 18th century gown";
		}
		$totcost= $quantity*($cost+($cost/100*8.25));
//inserting data into orders table, with default order status as Cart.
		mysqli_query($dbConnection,"INSERT INTO Orders (custid, prodname, size, quantity, cost, totcost, date) values (0, '$prodname', '$size', '$quantity', '$cost', '$totcost', '$date')");
	}
	?>
<?php
	if(isset($_POST['cancel']))
	{
		$quer=mysqli_query($dbConnection,"DELETE FROM `Orders` WHERE Order_status = 'Cart'");
	}
?>

<h6> Disclaimer: Please check your details before clicking on submit. Submitting would automatically mean your confirmation for order. Above mentioned costs not inclusive of taxes. Final price will be provided in order summary. To make any changes, please scroll up. </h6>
</body>
</html>

