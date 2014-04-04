<HTML>
<HEAD>
<title>Inserisci Segnalazione</title>
<?php
session_start();
include "connessioneDatabase.php";

echo "

<form action='ins_segnalazione.php' method='post'>
	
   Tipo <select name='scelta_tipo'>
			<option value='-'>-</option>
			<option value='H'>Hw</option>
			<option value='S'>Sw</option>
		</select>
		
<br><br>

   Assistente: <select name='scelta_assistente'> 

";
		
	$istruzione="select CodAs,NomeAs from assistente order by NomeAs ASC";
		
	$risultato=mysql_query($istruzione);
		
	while($riga=mysql_fetch_array($risultato))
	{
		echo " <option value='$riga[0]' >".$riga[1]." </option>";
	}
  
echo "
   
	</select>
<br><br>
		Oggetto Descrzione: <input type='text' name='OggettoS'>
<br><br>

		Descrizione: <input type='text' name='Descrizione'>

<br><br><br>

	<input type='submit' value='Invio'>
	<a href='registrolab.php'>Torna Al Menu</a>
	
<br><br><br>
</form>

";

?>

<script language='javascript'>
if(history.length>0)history.forward()
</script>

</HEAD>

<BODY>
<?php	
include "connessioneDatabase.php";
	
	if(isset($_REQUEST['scelta_tipo']) && isset($_REQUEST['scelta_assistente']) && isset($_REQUEST['Descrizione']))
	{
		$dataIns=mysql_real_escape_string(date("Y-m-d"));
		$varTipo=$_POST['scelta_tipo'];
		$varAssistente=$_POST['scelta_assistente'];
		$varDesc=$_POST['Descrizione'];
		$varIdAt=$_SESSION['IdAt'];
		$varOggettoS=$_POST['OggettoS'];
		$des1="insert into segnalazione(Tipo,DescS,IdAt,CodAs,DataInse,OggettoS) values ('$varTipo','$varDesc','$varIdAt',$varAssistente,'$dataIns','$varOggettoS')";	
		
		$ris=mysql_query($des1);
			
	}
	
?>
</BODY>

<HEAD>

<script language="JavaScript">

function printPage(){
 
	if(document.all)
	{ 
		document.all.stampa.style.visibility = 'hidden'; 

		window.print(); 

		document.all.stampa.style.visibility = 'visible'; 
	} 
	
	else 
	{ 
	
		document.getElementById('stampa').style.visibility = 'hidden'; 
		
		window.print(); 
		
		document.getElementById('stampa').style.visibility = 'visible'; 
		
	} 
} 
	
</script>
</HEAD>

<BODY>

<div id="stampa"> 

	<input type="button" value = "Stampa" onclick="printPage()">

</div>
</BODY>
</HTML>
