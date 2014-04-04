<?php

session_start();

include "connessioneDatabase.php";

	

?>

<html>
<title> Registro Laboratorio </title>

<script language='javascript'>
if(history.length>0)history.forward()
</script>

<script language="javascript">
	function nascondi(){
	document.getElementById("reg").style.display="none";
	}
	</script>
<script language="javascript">
	var stile = "top=10, left=10, width=250, height=200, status=no, menubar=no, toolbar=no, scrollbars=no";
	function Popup(apri){
	window.open(apri, "", stile);
	}
	</script>
	<font style='font-family:'Verdana'; size:'10>


 <body onLoad='show_clock()'>
 <p align="right"><script language='javascript' src='liveclock.js'></script></p> 
 
 <?php

	$nomeu=$_SESSION["nomeu"];
	$prof=$_SESSION['prof'];
	$istruzione="select NomeP,CognomeP from accesso a,professore p where nomeu='$nomeu' and a.codP=p.codP";
	$risultato=mysql_query($istruzione);

	while($riga=mysql_fetch_array($risultato))
	{
		$nome=$riga[0];
		$cognome=$riga[1];
	}
	
?>



<?php
	$istruzione="select IdAt,CodMat from attivita order by IdAt desc limit 1";
	$ris=mysql_query($istruzione);
	$FAris=mysql_fetch_array($ris);
	$_SESSION['IdAt']=$FAris[0];
	if($FAris[1]==5)
	{
	echo "<div id='reg'>";
	echo "<form action='registrolab.php' method='post' >";
	echo " <b> Materia: </b><select name='scelta_materia'>";
		$Mat="select distinct i.CodMat,DescM from materia m,professore p,insegna i,accesso a where i.CodP=$prof and i.CodMat=m.CodMat";
		$risMat=mysql_query($Mat);

		while($riga=mysql_fetch_array($risMat))
		{
			echo "<option value='$riga[0]'>".$riga[1]." </option>";
		}
		
	echo"	<option value='4'> Supplenza </option> </select>";
	
		
		echo " <b>Prof. :</b> ".$nome." ".$cognome;
		
		echo" Classe <select name='Classe'>";
 
	$istruzione="select CodCl from classe";
	 
	$risultato=mysql_query($istruzione);

	while($riga=mysql_fetch_array($risultato))
	{
	 	echo "<option value='$riga[0]' >".$riga[0]." </option>";
	}
	echo" </select>";
		echo"
		Ore: <input name='ore' maxlenght='1' size='1' type='text'>
		<input type='submit' name='Aggiorna' value='Aggiorna'>
		</form> </div>";
		
	}
	else
	{
			$istruzione="select IdAt,CodMat,CodCl from attivita order by IdAt desc limit 1";
			$ris=mysql_query($istruzione);
			$FAris=mysql_fetch_array($ris);
			$classe=$FAris[2];
			$mat=$FAris[1];
			$id=$FAris[0];
			$descM="select DescM from materia where CodMat=$mat";
			$QdescM=mysql_query($descM);
			$FAdescM=mysql_fetch_array($QdescM);
			echo "<b> Materia :</b> ".$FAdescM[0]." <b>Prof. :</b> ".$nome." ".$cognome." <b>Classe:</b> ".$classe."
				<script language=javascript>nascondi()</script> ";
			echo " <ul type='square'> 
	        <li><a href='ins_segnalazione.php'>Inserisci Segnalazione</a></li>
			<li><a href='mod_segnalazione.php'>Modifica Segnalazione</a></li>
			<li><a href='visu_segnalazione.php'>Visualizza Segnalazione</a></li>
			<li><a href='canc_segnalazione.php'>Cancella Segnalazione</a></li>
			</ul>
			";
			
			if (!isset ($_COOKIE ['utente'])) 
				{
					setcookie('utente');
					die ("<meta http-equiv='Refresh' content='0 ; URL=login.php'>");
				}	
	}
	
?>

<?php
		if(isset($_REQUEST['scelta_materia']) && isset($_REQUEST['Classe']) && isset($_REQUEST['ore']))
		{	
			$nomeu=$_SESSION["nomeu"];
			$istruzione="select IdAt,CodMat,CodCl from attivita order by IdAt desc limit 1";
			$ris=mysql_query($istruzione);
			$FAris=mysql_fetch_array($ris);
			$mat=$_POST['scelta_materia'];
			$classe=$_POST['Classe'];
			$id=$FAris[0];
			$update="update attivita set CodCl='$classe',CodMat=$mat where IdAt=$id";
			$Qupdate=mysql_query($update);
			$descM="select DescM from materia where CodMat=$mat";
			$QdescM=mysql_query($descM);
			$FAdescM=mysql_fetch_array($QdescM);
			echo "<b> Materia :</b> ".$FAdescM[0]." <b>Prof. :</b> ".$nome." ".$cognome." <b>Classe:</b> ".$classe."
				<script language=javascript>nascondi()</script> 
				<ul type='square'> 
	        <li><a href='ins_segnalazione.php'>Inserisci Segnalazione</a></li>
			<li><a href='mod_segnalazione.php'>Modifica Segnalazione</a></li>
			<li><a href='visu_segnalazione.php'>Visualizza Segnalazione</a></li>
			<li><a href='canc_segnalazione.php'>Cancella Segnalazione</a></li>
			</ul>";
			$ore=(int)$_POST['ore'];
			$minuti=$ore*60;
			$minutiAtt=(int)date("i");
			$mCookie=$minuti-$minutiAtt;
			setcookie('utente',$nomeu,time()+20);
			
		}
	
?>

	<form action='Login.php' method='post'>
		<input type='submit' value='Logout'>  
	</form>
	
	
		
	</form>
		
</font>
</body>

	<meta http-equiv='Refresh' content='10 ; URL=registrolab.php'>

</html>
