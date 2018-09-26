<?php
$con=mysqli_connect("localhost","root","root","system_problem");
date_default_timezone_set('Asia/Kolkata');
$c_time=date('d-m-Y H:i')

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>\
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<table align="center" class="table table-bordered" >
	<form method="post" action="">
		<tr>
			<td align="right">Sr.Name</td><td><input type="text" name="sr_name" value="Ravi" readonly style="height: 30px; width: 200px;"></td>
		</tr>
		<tr>
			<td align="right">Problem</td><td><textarea name="problem" style="height: 100px; width: 200px;" required></textarea></td>
			
		</tr>
		<tr>
			<td></td><td align="left"><!-- <input type="submit" name="s" value="Send"> -->
			<button type="submit" class="btn btn-danger" name="s">Send</button></td>
		</tr>
	</form>
</table>
<?php
	if(isset($_POST["s"]))
	{
		extract($_POST);

		$qry=mysqli_query($con,"INSERT INTO `problem`(`sr_name`, `problem`, `c_time`) VALUES ('$sr_name','$problem','$c_time')");
		if($qry)
		{
			echo "<script>alert('Send Sucess')</script>";
		}
	}
?>

<hr>
<table border="1" width="1200">
	<tr>
		<td style="width: 100px;" align="center">Sr.Name</td>
		<td style="width: 800px;" align="center">Problem</td>
		<td align="center">Reply</td>
		<td align="center">Admin Reply</td>
	</tr>
	<?php
	$qry1=mysqli_query($con,"select * from problem where sr_name='Ravi' order by id desc");
	while(@$row=mysqli_fetch_array($qry1))
	{
		extract($row);
	?>
	<tr>
		<td><?php echo $sr_name ?></td>
		<td><?php echo $problem ?></td>

	 <form method="post" action="">
	       <td><input type="text" name="solve" value="<?php echo $solve; ?>" style="width: 100px;">
		       <input type="hidden" name="getid" value="<?= $row['id'] ?>" >
		       
		       <!-- <button type="submit" class="btn btn-danger" name="f">Update</button></td> -->
		       <?php if($solve==NULL){

		       echo '<button type="submit" class="btn btn-danger" name="f">Update</button></td>';
		       }
		       ?> 
	      </td>
    </form>
    <td><?php echo $admin_reply; ?></td>
	</tr>
	<?php
	}
	?>


<?php

if(isset($_POST["f"]))
{
  extract($_POST);
  // if($solve==NULL)
  // {
  $qry=mysqli_query($con, "update problem set solve='$solve',solve_time=NOW() where id='$getid'");
  echo "<script>alert('update')</script>";
  echo "<script>window.open('ravi.php','_self')</script>";
  //}
}

?>
</table>
</div>
</body>
</html>