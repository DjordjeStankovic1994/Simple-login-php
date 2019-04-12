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

<title>Registration new User</title>

<link href="../css/login.css" rel="stylesheet" type="text/css">
</head>

<body>
<body>
	<div id="nav">
		<a href="#">POCETNA</a> 
		<a href="login.php">Loguj se</a>

	</div>


<div class="log">
					<p>Registracija novog korisnika</p><br>
				<?php
					if(isset($_POST['ime']) and $_POST['ime']!="")
							{
							$ime=$_POST['ime'];
							$prezime=$_POST['prezime'];
							$email=$_POST['email'];
							$lozinka=$_POST['lozinka'];
							$potvrdalozinke=$_POST['potvrdalozinke'];			
							$imeSlike="";
							if($_FILES['avatar']['name']!="")
							{
								if($_FILES['avatar']['size']<100000)
								{
									$ekstenzija=pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
									$imeSlike=time().".".$ekstenzija;
									@move_uploaded_file($_FILES['avatar']['tmp_name'], "../image/image-user/".$imeSlike);
								}else
									echo "Prevelika slika";

							}
							if($lozinka==$potvrdalozinke)
							{
                                $upit2="SELECT * FROM user WHERE email='{$email}'";
                                    $rez=$db->upit($upit2);
                                
                                    if( $db->brojRedova($rez) >= 1)
                                    {
                                        echo "Korisnik vec postoji sa ovim email-om pokusajte drugi mail";
                                      echo " <a href='regNewUser.php'>Pokusaj ponovo</a>";
                                      return false;
                                    }else{
								$upit="INSERT INTO user (name, surname,  password, email, slika_kor) VALUES ('{$ime}', '{$prezime}', '{$lozinka}', '{$email}', '{$imeSlike}')";
								
								$db->Upit($upit);
							
								echo "Dodato korisnika: ".$db->promenjeniRedovi()."<br><br>";
								
                                    }
							}else
								echo "Lozinka i potvrda lozinke nisu iste<br><br>";
								
								
							
			}
					// if (!isset($_GET['reload'])) {
					// 			 echo '<meta http-equiv=Refresh content="0;url=regNewUser.php?reload=1">';
					// 		}
					
				?>
					<form method="post" id="formreg" action="regNewUser.php" enctype="multipart/form-data">
					<input type="text" class="set" name="ime" placeholder="Unesite ime" /><br><br>
					<input type="text" class="set" name="prezime" placeholder="Unesite prezime" /><br><br>
					<input type="text" class="set" name="email" placeholder="Unesite email" /><br><br>
					<input type="text" class="set" name="lozinka" placeholder="Unesite lozinku" /><br><br>
					<input type="text"class="set" name="potvrdalozinke" placeholder="Potvrdite lozinku" /><br><br>
					<input type="file"  name="avatar"/><br><br>
					
					<input type="submit" id="dugme" value="Registruje se"  />
					</form >
				
					
	</div>		

</body>
</html>

