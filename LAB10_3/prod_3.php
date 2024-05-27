<?php 
    $session = true;
    
if( session_status() === PHP_SESSION_DISABLED  )
    $session = false;
elseif( session_status() !== PHP_SESSION_ACTIVE )
{
    session_start();
    
    if( !isset($_SESSION["cd"]) )
        $_SESSION["cd"] = 0;
    if( !isset($_SESSION["dvd"]) )
        $_SESSION["dvd"] = 0;
    if( !isset($_SESSION["sd"]) )
        $_SESSION["sd"] = 0;
    if( !isset($_SESSION["usb"]) )
        $_SESSION["usb"] = 0;
}
?>
<!doctype html>
<html lang="it">
    <head>
	    <meta charset="utf-8">
        <title>Esercizio 10.6 - Catalogo</title>
        <meta name="author" content="Paolo Aimar">
        <script>
            function controllaForm()
            {
                var err = false;
                var regex = /^\d+$/;
                
                for(i=0; i<arguments.length && !err; ++i)
                    if( !regex.test(arguments[i]) ) {
                        alert("Inserire un quantitativo valido: attesi numeri interi positivi senza virgola");
                        return false;
                    }
                    else
                        return true;
            }
        </script>
    </head>
    
    <body>
        <?php
            if(!$session)
            {
                echo "<p>SESSIONI DISABILITATE, impossibile proseguire</p>\n";
            }
            else
            {
        ?>     
        <h1>Pagina acquisto beni</h1>
                <?php
					$nome = "";			
					if((isset($_REQUEST['ncd'])) && (isset($_REQUEST['cd'])))
					{
						$nome = "cd";
						$quantita = trim($_REQUEST['ncd']);
					}
					elseif(isset($_REQUEST['ndvd']) && (isset($_REQUEST['dvd'])))
					{
						$nome = "dvd";
						$quantita = trim($_REQUEST['ndvd']);
					}
					elseif(isset($_REQUEST['nsd']) && (isset($_REQUEST['sd'])))
					{
						$nome = "sd";
						$quantita = trim($_REQUEST['nsd']);
					}
					elseif(isset($_REQUEST['nusb']) && (isset($_REQUEST['usb'])))
					{
						$nome = "usb";
						$quantita = trim($_REQUEST['nusb']);
					}
					
					if(!empty($nome))
					{
						if(preg_match("/^\d+$/",$quantita))
						{
							$quantita = intval($quantita);
							
							if($quantita > 0)
								if($_SESSION[$nome] > 0)
									echo "<p class='success'>Quantit&agrave; prodotto aggiornata correttamente!</div>";
								else
									echo "<p class='success'>Prodotto inserito correttamente nel carrello!</div>";
									
							$_SESSION[$nome] += $quantita;
						}
						else
                            echo "<p class='error'>Errore inserimento prodotto! Quantit&agrave; deve essere un valore numerico!</div>\n";
					}
				?>  
                <form name="f" action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET" onSubmit="return controllaForm(ncd.value,ndvd.value,nsd.value,nusb.value);">
                    <table>
                        <caption>Lista beni acquistabili</caption>
                        <tr>
                            <th>Prodotto</th>
                            <th>Descrizione</th>
                            <th>Prezzo</th>
                            <th>Quantit&agrave;</th>
                            <th>Operazione</th>
                        </tr>
                        <tr>
                            <td><a href="cd.html">CD</a></td>
                            <td>Supporto di memorizzazione digitale della capacit&agrave; massima di 870 MB</td>
                            <td>0.5 &euro;</td>
                            <td><input type='text' name='ncd' value='0' ></td>
                            <td><input type="submit" name="cd" value="Aggiungi al Carrello >>"></td>
                        </tr>
                        <tr>
                            <td><a href="dvd.html">DVD</a></td>
                            <td>Supporto di memorizzazione digitale della capacit&agrave; massima di 17 GB</td>
                            <td>1 &euro;</td>
                            <td><input type='text' name='ndvd' value='0' ></td>
                            <td><input type="submit" name="dvd" value="Aggiungi al Carrello >>"></td>
                        </tr>
                        <tr>
                            <td><a href="sd.html">Memoria SD</a></td>
                            <td>Secure Digital &egrave; il pi&ugrave; diffuso formato di schede di memoria</td>
                            <td>7.5 &euro;</td>
                            <td><input type='text' name='nsd' value='0' ></td>
                            <td><input type="submit" name="sd" value="Aggiungi al Carrello >>"></td>
                        </tr>
                        <tr>
                            <td><a href="usb.html">Memoria USB</a></td>
                            <td>Memoria di massa portatile di dimensioni molto contenute collegabile al computer mediante porta USB</td>
                            <td>5 &euro;</td>
                            <td><input type='text' name='nusb' value='0' ></td>
                            <td><input type="submit" name="usb" value="Aggiungi al Carrello >>"></td>
                        </tr>
                        <tr>
                            <td colspan="5"><a href="basket_3.php">Vai al Carrello &gt;&gt;</a></td>
                        </tr>
                    </table> 
                </form>  
        <?php
            }
        ?>
    </body>
</html>
