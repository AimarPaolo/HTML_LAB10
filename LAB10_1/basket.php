<?php 
    $session = true;
    
if( session_status() === PHP_SESSION_DISABLED  )
    $session = false;
elseif( session_status() !== PHP_SESSION_ACTIVE )
    session_start();
?>
<!doctype html>
<html lang="it">
    <head>
        <title>Esercizio 10.1 basket</title>
        <meta charset="utf-8">
        <meta name="author" content="Paolo Aimar" >
    </head>
    <body>
        <?php
            //anche in questo caso controllo che la sessione non sia disabilitata, in caso affermativo stampo il messaggio di errore 
            if(!$session)
            {
                echo "<p>SESSIONI DISABILITATE, impossibile proseguire</p>\n";
            }
            else
            {
        ?>
                <h1>Totale beni selezionati</h1>
                <?php
                    $prezzi = array( "cd"=>0.5 , "dvd"=>1 , "sd"=>7.5 , "usb" =>5 );
                    $nomi = array( "cd"=>"CD" , "dvd"=>"DVD" , "sd"=>"Memoria SD" , "usb" =>"Memoria USB" );
                    $err = false;
                    
                    if(isset($_REQUEST['ncd']) && isset($_REQUEST['ndvd']) && isset($_REQUEST['nsd']) && isset($_REQUEST['nusb'])) 
                    {
                        $numCD = trim($_REQUEST['ncd']);
                        $numDVD = trim($_REQUEST['ndvd']);
                        $numSD = trim($_REQUEST['nsd']);
                        $numUSB = trim($_REQUEST['nusb']);                     
                        $regex = "/^\d+$/";
                        if(preg_match($regex,$numCD) && preg_match($regex,$numDVD) && preg_match($regex,$numSD) && preg_match($regex,$numUSB))
                        {
                            //se tutti i valori sono corretti, allora mi salvo i valori aggiornati del carrello, così quando faccio un nuovo accesso
                            //mi rimarranno in memoria
                            $_SESSION["cd"] = intval($numCD);
                            $_SESSION["dvd"] = intval($numDVD);
                            $_SESSION["sd"] = intval($numSD);
                            $_SESSION["usb"] = intval($numUSB);
                        }
                        else
                            $err = true;
                    }
                                
                    if(!$err)
                    {       
                ?>
                <table>
                    <caption>Beni Selezionati</caption>
                    <tr>
                        <th>Prodotto</th>
                        <th>Prezzo singolo</th>
                        <th>Numero pezzi per articolo</th>
                        <th>Prezzo totale per articolo</th>
                    </tr>     
                    <?php
                        $items = 0;
                        $tot = 0;
                        foreach($_SESSION as $key=>$value)
                            if(( $value > 0 ) && (( $nomi[$key]==="CD")||($nomi[$key]==="DVD")|| ($nomi[$key]==="Memoria SD")||($nomi[$key]==="Memoria USB")))
                            {   
                                ++$items;
                                //in questo caso value è la quantità dei pezzi selezionata mentre prezzi[$key] indica il prezzo di acquisto del prezzo
                                $tot += $prezzi[$key]*$value;
                                echo "<tr>\n<td>$nomi[$key]</td>\n<td>$prezzi[$key]&euro;</td>\n<td>$value</td>\n<td>".($prezzi[$key]*$value)."&euro;</td>\n</tr>\n";
                            }                       
                        if( $items > 0 )
                        {
                           ?>
                           <tr>
                           <td colspan="4">Prezzo totale = <?php echo $tot; ?>&euro;</td>
                           </tr>
                        <?php
                        }
                    ?>
                </table>
                <p class="move"> 
					<?php if ($items==0)
						echo "non ci sono elementi nel carrello";
					else if ($items==1) 
						echo "c'&egrave; ".$items." elemento nel carrello";
					else
						echo "ci sono ".$items." elementi nel carrello";			
					?> 
				</p>
                <?php
                    }
                    else
                        echo "<div class='error'>Errore nelle quantit&agrave inserite</div>";
                ?>
                <p class="move"><a href="prod.php">&lt;&lt; Clicca qui per tornare alla pagina precedente</a></p>  
        <?php
            }
        ?>
    </body>
</html>