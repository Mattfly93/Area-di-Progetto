<html>
<head>
<link rel="stylesheet" type="text/css" href="css/prova.css" />
<title>Login</title>

<?php
include "connessioneDatabase.php";

	echo "
	<h1>Registro</h1>
	<form style='text-align:center; background-color:green' action='Login.php' method='post'>
	<div class='dati'>
		
		<p>...............................................................................</p>
			Utente <input type='text' name='utente'>
		<p>...............................................................................</p>	
			Password <input type='password' name='pwd'>
		<p>...............................................................................</p>
			<br>
	</div>
	
		<div class='login'>
		
		<input type='submit' value='LogIn' />
		
	</div>

	<div class='img-buzzi' >
		
		<img src='img/buzzi.jpg' width='1237' height='419' />
			
	</div>
		
	<div id='footer'>
		
			<div id='sx'>
			
				<img src='img/html.jpg.jpg'	alt=' ' width='80' height='40'/>
				<img src='img/css.jpg.jpg'	alt=' ' width='80' height='40'/>
				
			</div>
			
			<div id='dx'>	
			
				<a href='http://copyright.it/index.html?utm_source=AdWords&utm_medium=PPC&utm_term=copyright&utm_content=22022512005&utm_campaign=AdGroup&Network=Search&SiteTarget=&gclid=CMbOv8fE3rYCFYmS3godqGAAfw'>Copyright &copy; 2013 ITIS TULLIO BUZZI, Italia</a>
			
			</div>
			
	</div>
	</form>
	";
     
?>
</head>

<body>


<?php

session_start();

	if(isset($_REQUEST['utente']) && isset($_REQUEST['pwd']))
	{
		include "connessioneDatabase.php";
		
		$utente=$_POST['utente']; 
		$pwd=sha1($_POST['pwd']);
		$istruzione="select nomeu,pwd,codP from accesso where nomeu='$utente'";
		$risultati=mysql_query($istruzione);
		if(mysql_num_rows($risultati)==0 || $pwd=="")
			{
				echo"<script type='text/javascript'>alert('Nome Utente o Password Sbagliata')</script>";
			}
		else
		{
			$_SESSION["nomeu"]=$_POST['utente'];
			
			while($pwdUt=mysql_fetch_array($risultati))
			{
				$controlloidAtt="select * from attivita";
				$QcontrolloidAtt=mysql_query($controlloidAtt);
				
				if($pwd==$pwdUt[1])
					{
						$codP=(int)$pwdUt[2];
						echo "<div style='text-align:center'> Login In Corso.....Attendere </div>";
						$oraIns=(string)strftime("%H:%M",mktime());
						$dataIns=mysql_real_escape_string(date("Y-m-d"));
						$codM=5;
						$inserimento="insert into attivita (Orario,CodP,CodLab,CodMat,DataIns) values ('$oraIns',$codP,'S42',$codM,'$dataIns')";
						$ins=mysql_query($inserimento);
							
							if($ins==true)
								{
									echo "<meta http-equiv='Refresh' content='1 ; URL=registrolab.php'>";
									$_SESSION['prof']=$codP;
								}
							else
								{
									echo "Ops".$ins.mysql_error();
								}
					}
				else
				{
					echo"<script type='text/javascript'>alert('Nome Utente o Password Sbagliata')</script>";
				}
				
			}
			
		}
		
	}

?>

</body>
</html>
