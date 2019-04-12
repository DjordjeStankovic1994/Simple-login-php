<?php 
require_once("db.php");
$db=new database();
				if(mysqli_connect_error($db)){
					echo "ERROR".mysqli_connect_error($db);
					exit();
				}

$db=new database();

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<title>Login</title>
	<link href="../css/login.css" rel="stylesheet" type="text/css">
</head>



				<?php
	if(isset($_POST['email']) AND isset($_POST['lozinka']))

	
	{
		$lozinka=@$_POST['lozinka'];
	$email=@$_POST['email'];
		
	
				$upit="SELECT * FROM user WHERE email='{$email}' AND password='{$lozinka}'";
				$rez=$db->upit($upit);
				if($db->brojRedova($rez)==1)
				{
					
		
					session_start();
					$red=$db->procitajRed($rez);
			
					$_SESSION['email']=$red->email;
				
					header("location: index.php");
					exit();
				}else
					echo "Korisnik ne postoji<br><br>";
			
		
			
	
	}


	
	?> 
	<div class="log">

		<form method="post" action="login.php" id="form" enctype="multipart/form-data">
			<input type="text" name="email" id="email" placeholder="Unesite email" required /><br><br>
			<input type="text" name="lozinka"id="lozinka" placeholder="Unesite lozinku"required /><br><br>
			<input type="submit" id="dugme" value="SUBMIT"/>
		</form>
		<br>
		<a href="regNewUser.php">registracija novog korisnika</a> <span> |</span> <a href="#">zaboravili ste lozinku</a>
	</div>	

</body>
</html>