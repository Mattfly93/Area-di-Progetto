<html>
<?php
include "connessioneDatabase.php";

?>
<head>

<script language='javascript'>
if(history.length>0)history.forward()
</script>

<title>Visualizza Segnalazione</title>

</head>

<body>
<div id='reg'>
<form action="visu_segnalazione.php" method="post">
<table border='1'>
<tr>
<td> <br>Scelta</br> </td>
<td> <br>Tipo Segnalazione</br> </td>
<td> <br>Oggetto Segnalazione</br> </td>
</tr>
<?php

		$segna="select IdS,Tipo,OggettoS from segnalazione";
		$risSegna=mysql_query($segna);
		while($riga=mysql_fetch_array($risSegna))
		{
		    echo "<tr>";
			echo "<td> <input type='radio' name='OggettoS' value=$riga[0] /> </td>";
			echo "<td>".$riga[1]."</td>";
			echo "<td>".$riga[2]."</td>";
			echo "</tr>";
		}

?>
</table>
<input type='submit' value='Visualizza' name='Visualizza'>
</form>
</div>
<?php
if(isset($_POST['OggettoS']))
{
	$idS=$_POST['OggettoS'];
	$istruzione="select Tipo,DescS,IdAt,CodAs,DataInse,OggettoS from segnalazione where IdS=$idS";
	$risultato=mysql_query($istruzione);
	while($riga=mysql_fetch_array($risultato))
	{
		echo " Tipo : ".$riga[0]."<br><br>";
		echo " Descrizione : ".$riga[1]."<br><br>";
		echo " Id Attivit� : ".$riga[2]."<br><br>";
		$query="select NomeAs from assistente where CodAs=$riga[3]";
			$risultatoq=mysql_query($query);
			while($nome=mysql_fetch_array($risultatoq))
			{
				echo " Nome Assistente : ".$nome[0]."<br><br>";
			}
		echo " Data Inserimento: ".$riga[4]."<br><br>";
		echo " Oggetto Segnalazione: ".$riga[5]."<br><br>";
	}
}
?>

<a href='registrolab.php'>Torna Al Men�</a>
</body>

</html>
