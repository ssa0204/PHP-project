<!-- Code written by
	Subramanya Soujanya Akella
	Student id: 11333719
	Date: 20th February, 2020
	Code for web page, "The Antique". 
	page 2 of 2.
-->

<?php
//First we establish connection with database.
	$dbConnection =mysqli_connect("student-db.cse.unt.edu","ssa0204","ssa0204","ssa0204");
	//check db connection
	if(mysqli_connect_errno()){
		echo "Database connection could not be established.".mysqli_connect_error(); 
	}
	$quer= mysqli_query($dbConnection,"SELECT * FROM Orders WHERE Order_status='Cart'");
	$numb = mysqli_num_rows($quer);
	//we need to make sure the user has items in cart
	if($numb==0)
		exit("No items in cart.Go back to choose items.");
?>
<html>
<head>
	<style>
	.button {background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;}
	body {border:2px solid blue; background-color:lightgrey;text-align:left; font-size:50px; font-family:; color:black;}
	h6 {color:red;}
	</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Customer details </title>
</head>
<body>
<!-- First we allow user to be able to go back to first page -->
<a href="antique.php" ><button class="button" >HOME</button> </a> <br>
<strong> Fill in the below details to continue...</strong><br>
If you already have a valid customer id number, you can directly place order. <br>
<form method="post">
	<label for="custid"> Customer Id: </label>
	<input type="number" style="font-size:18pt;" id="custid" name="custid" required><br> 
	<button class="button" type="submit" name="submit1" value="Submit">Submit</button>
</form>
<?php
	if( isset($_POST['submit1']))
	{
		//using sql query to check if custmer exists
		$custidno=$_POST['custid'];
		$query=mysqli_query($dbConnection,"SELECT * FROM Customers WHERE custid='$custidno'");
		$count=mysqli_num_rows($query);
		$row=mysqli_fetch_assoc($query);
		if($count>0)
		{
			$query1=mysqli_query($dbConnection,"SELECT * FROM Orders WHERE Order_status='Cart' AND custid=0");
			$totalamt =0.0;
			while($res = mysqli_fetch_array($query1)){
				$totalamt = $res['totcost'];
		}
		mysqli_query($dbConnection,"UPDATE Orders SET custid='$custidno', Order_status='Placed' WHERE custid=0");
		//Now order is fully placed and summary is displayed
		echo "Given below is your order summary: <br>";
		echo "Congratulations!! <br>";
		echo "Your order is successfully placed. Look below for order summary and final price. <br>";
		echo "Thank you for shopping with us. We hope you enjoyed you experience.";
		echo "To give us any feedback, mail us at feedback@gmail.com <br> ";
			echo "Date&Time of order: ".date("M-D-Y h:i:s");
			echo "<br>";
			echo "Customer-id: ".$custidno;
			echo "<br>";
			echo "Total cost: ".$totalamt;
			echo "<br>";
			echo "To make changes to order or cancel the order please call us at 9119110000. <br>";
			
		}
		//if the user is not registered
		else
		{
			echo "Please register by filling below details. <br>"; }
		}
?>
<form method="post">
	<label for="custname"> Full name: </label>
	<input type="text" style="font-size:18pt;" id="custname" name="custname" required><br> 
	<label for="saddress">Street adress: </label>
	<input type="text" style="font-size:18pt;" id="sadress" name="saddress" required><br>
	<label for="aptno">Unit or Apt #:</label>
	<input type="number" style="font-size:18pt;" id="aptno" name="aptno" required><br>
	<label for="Zipcode">Zipcode: </label>
	<input type="number" style="font-size:18pt;" id="zipcode" name="zipcode" required><br>
	<label for="Gender"> Gender: </label>
	<select name="Gender" id="Gender"> 
        <option value="male">Male</option> 
        <option value="female" selected>Female </option> 
        <option value="other" >other </option> 
    </select> <br>
	<label for="phno"> Phone number: </label>
	<input type="number" style="font-size:18pt;" id="phno" name="phno" required><br>
	<button class="button" type="submit" name="submit2" value="Submit">Submit</button>
	<button class="button" type="reset" value="Reset">Reset</button>
</form>
<!-- End of form. now user entered details are present in page. we will store them in variables, and insert those values into database. --> 
<?php 
	if(isset($_POST['submit2']))
	{
		$custname=$_POST['custname'];
		$staddr=$_POST['saddress'];
		$aptno=$_POST['aptno'];
		$zipcode=$_POST['zipcode'];
		$gender=$_POST['Gender'];
		$phno=$_POST['phno'];
		mysqli_query($dbConnection,"INSERT INTO Customers (custname,saddress,aptno,zipcode,phno) VALUES ('$custname','$staddr','$aptno','$zipcode','$phno')");
		//data inserted into customers table
		$queryy=mysqli_query($dbConnection,"SELECT * FROM Customers WHERE phno='$phno'");
		$row=mysqli_fetch_assoc($queryy);
		$idno=$row['custid'];
		$query1=mysqli_query($dbConnection,"SELECT * FROM Orders WHERE Order_status='Cart' AND custid=0");
			$totalamt =0.0;
			while($res = mysqli_fetch_array($query1)){
				$totalamt = $totalamt + $res['totcost'];
			}
			mysqli_query($dbConnection,"UPDATE Orders SET custid='$idno', Order_status='Placed' WHERE custid=0");
		//data updated in orders table.
		echo "Given below is your order summary: <br>";
		echo "Congratulations!! <br>";
		echo "Your order is successfully placed. Look below for order summary and final price. <br>";
		echo "Thank you for shopping with us. We hope you enjoyed you experience.";
		echo "To give us any feedback, mail us at feedback@gmail.com <br> ";
		echo "Date&Time of order: ".date("M-d-Y h:i:s");
		echo "<br>";
		echo "Customer-id: ".$idno;
		echo "<br>";
		echo "Total cost: ".$totalamt;
		echo "<br>";
		echo "To make changes to order or cancel the order please call us at 9119110000. <br>";
	}
?>
</body>
</html>