<?php
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
	<title> GO BACK </title>
</head>
<body>
<h1> WELCOME TO "GO BACK"!! </h1>
<h3>An online portal where you can buy vintage clothing.</h3>
<hr>
<form action="secondpage.html" method="POST">
	<label>Select any of the below outfits.</label>
	<br> <br> <br>
	<img style align="left" src="16th century.jpg" alt="Blue and grey gown" width="300" height="400">
	<img src="17th century.jpg" alt="White gown" width="300" height="400">
	<img style align="right" src="18th century.jpg" alt="Maroon gown" width="300" height="400"> 
	<br> <br> <br>
	<input type="radio" id="first" name="prodname" value="first" checked>
	<label for="first"> Blue and grey 16th century gown $71.99</label> <br>
	<input type="hidden" name="price1" value="71.99">
	<input type="radio" id="second" name="prodname" value="second">
	<label for="second"> White 17th century gown $54.99</label> <br>
	<input type="hidden" name="price2" value="54.99">
	<input type="radio" id="third" name="prodname" value="third">
	<label for="third">Maroon 18th century gown $69.99</label><br> <br> 
	<input type="hidden" name="price3" value="69.99">
	<!-- insert checkbox here to choose dresses --> 
	<label for="sizes"> Size: </label>
		<select name="sizes" id="sizes"> 
        <option value="XS">XS</option> 
        <option value="S" selected>S </option> 
        <option value="M" >M </option> 
		<option value="L" >L </option> 
		<option value="XL" >XL </option> 
		<option value="XXL" >XXL </option> 
    </select> <br>
	<label for="quantity"> Quantity: </label>
	<input type="number" id="quantity" name="quantity" required><br>
	<button class="button"  name="ok" >OK</button>
	<button class="button" type="submit" value="Submit">Submit</button>
	<button class="button" type="reset" value="Reset">Reset</button>
	</form>
	<?php 
	if( isset($_POST['ok']))
	{
		//$prodname=$_POST['prodname'];
		$size=$_POST['sizes'];
		$quantity=$_POST['quantity'];
		$date= date("y-m-d H:i:s");
		if($_post['prodname']=="first"){
			$prodname="Blue and grey 16th century gown";
			$cost=$_POST['price1'];
		}
		else if($_post['prodname']=="second"){
			$cost=$_POST['price2'];
			$prodname="White 17th century gown";
		}
		else if($_post['prodname']=="third"){
			$cost=$_POST['price3'];
			$prodname="Maroon 18th century gown";
		}
		$totcost= $quantity*($cost+($cost/100*8.25));
		mysqli_query($dbConnection,"INSERT INTO Orders (custid, prodname, size, quantity, cost, totcost, date) values (0, '$prodname', '$size', '$quantity', '$cost', '$totcost', '$date')");
	}
	?>

<h6> Disclaimer: Please check your details before clicking on submit. Submitting would automatically mean your confirmation for order. Above mentioned costs not inclusive of taxes. Final price will be provided in order summary. To make any changes, please scroll up. </h6>
</body>
</html>

