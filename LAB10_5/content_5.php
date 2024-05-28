<?php
if(isset($_SESSION['lang']))
{
	if( $_SESSION['lang'] == 'IT' )
	{
		$titolo_menu = "Seleziona citt&agrave;:";
		$to = "Torino";
		$mi = "Milano";
		$mi_content = "Milano &egrave; un comune italiano di 1.300.000 abitanti circa, capoluogo della regione Lombardia. &Egrave; il secondo comune italiano per popolazione......";
		$to_content = "Torino &egrave; un comune italiano di circa 900.000 abitanti, capoluogo della regione Piemonte.....";
		$indietro = "Indietro";
	}
	elseif( $_SESSION['lang'] == 'EN' )
	{
		$titolo_menu = "Select city:";
		$to = "Turin";
		$mi = "Milan";
		$mi_content = "Milan is the second-largest city in Italy and the capital of Lombardy. The city has a population of about 1,300 million......";
		$to_content = "Turin is an Italian city of 900.000 inhabitants, capital of the Piedmont region......";
		$indietro = "Back";
	}
}
else
{
   echo "<p>Errore nella richiesta della pagina, risorsa acceduta in modo non previsto</p>";
}
?>