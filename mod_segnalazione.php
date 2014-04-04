<html>
<?php
include "connessioneDatabase.php";

?>
<head>

<script language='javascript'>
if(history.length>0)history.forward()
</script>

<title>Modifica Segnalazione</title>

</head>

<body>
<form action="mod2_segnalazione.php" method="post">
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
<input type='submit' value='Invio' name='invio'>
</form>
<a href='registrolab.php'>Torna Al Men�</a>

</body>

</html>
