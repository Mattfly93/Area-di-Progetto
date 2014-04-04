<html>

<script language="javascript">
	function nascondi(){
	document.getElementById("reg").style.display="none";
	}
</script>

<head>

<script language='javascript'>
if(history.length>0)history.forward()
</script>

</head>

<body>
<?php
session_start();
include "connessioneDatabase.php";
if(isset($_POST['OggettoS']))
{

	$idS=$_POST['OggettoS'];
	$_SESSION['idSegn']=$_POST['OggettoS'];
	$istruzione="select Tipo,DescS,DataInse,OggettoS from segnalazione where IdS=$idS";
	$risultato=mysql_query($istruzione);
	echo "<div id='reg'>";
	echo "<form action='mod2_segnalazione.php' method='post'>";
	while($riga=mysql_fetch_array($risultato))
	{
		echo "Tipo: <input type='text' name='Tipo' value='$riga[0]'>  <br><br>";
		echo "Descrizione: <input type='text' name='DescS' value='$riga[1]'> <br><br>";
		echo "Data Inserimento: <input type='text' name='DataInse' value='$riga[2]'> <br><br>";
		echo "Oggetto Segnalazione: <input type='text' name='oggettoS' value='$riga[3]'> <br><br>";
	}
  echo "<input type='submit' name='Aggiorna' value='Aggiorna' /> </form> </div>";
}


?>

<?php
if(isset($_POST['Aggiorna']))
{
	$tipo=$_POST['Tipo'];
	$desc=$_POST['DescS'];
	$datains=$_POST['DataInse'];
	$oggettos=$_POST['oggettoS'];
	$ids=$_SESSION['idSegn'];
	$istruzione="update segnalazione set Tipo='$tipo',DescS='$desc',DataInse='$datains',OggettoS='$oggettos' where IdS=$ids";
	$risultato=mysql_query($istruzione);
	echo "Modicata Con Succeso...Torno al Menu";
	echo "<meta http-equiv='Refresh' content='0 ; URL=registrolab.php'>"
}
?>

</body>

</html>
