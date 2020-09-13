<?php 
if(isset($_POST['user']))
{
	$user = "root";
	$pass = "tiger";
	$server="localhost";
	$db="test";
	$conn=mysqli_connect($server,$user,$pass,$db);
	if(!$conn)
	{
		die('Error connecting to server. Please try again!'.mysqli_connect_error());
	}
	$u=$_POST['user'];
	$p=$_POST['pwd'];
	
	$salt="aRanDOM_sstring&*#toparsewithPASSWORD";
	$p=hash('sha256',$salt.$p);
	
	
    $sql="select * from test where name='$u' and pass='$p'; ";
	
	$result= mysqli_query($conn,$sql);
	
	if(mysqli_num_rows($result)!=false)
	{	
		echo "<h1>LOGIN SUCCESSFUL</h1><hr>";
		$details=mysqli_fetch_assoc($result);
		echo "Welcome <b>".$details['name'];
		echo "</b><br>Your e-mail id is: <a href='mailto:".$details['email']."'>".$details['email']."</a><br>";
		echo "Your roll number is: <b>".$details['roll']."</b><br>";
		echo "Your section is: <b>".$details['section']."</b><br>";
		
	}
	else
	{
		echo "Invalid login credentials!.<br>";
		
	}
	mysqli_close($conn);
}
else
	echo "POST Data not available";
?>