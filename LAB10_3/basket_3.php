<?php 
    $session = true;
    
    if( session_status() === PHP_SESSION_DISABLED )
        $session = false;
    elseif( session_status() !== PHP_SESSION_ACTIVE )
        session_start();
    
    if (isset($_POST['svuota_carrello'])) {
        // Elimina solo le variabili di sessione relative ai prodotti del carrello
        /*in questo caso avrei anche potuto cancellare tutti facendo destroy_session --> in questo caso, dato che ho pochi valori, posso 
        eliminare anche solo le variabili senza dover distruggere e poi riaprire la sessione*/ 
        $prodotti = array("cd", "dvd", "sd", "usb");
        foreach ($prodotti as $prodotto) {
            unset($_SESSION[$prodotto]);
        }
    }
?>
<!doctype html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <title>Esercizio 10.3 - Carrello</title>
    </head>
    
    <body>
        <?php
            if(!$session) {
                echo "<p>SESSIONI DISABILITATE, impossibile proseguire</p>";
            } else {
        ?>
                <h1>Carrello</h1>
                <table>
                    <caption>Prodotti selezionati:</caption>
                    <tr>
                        <th>Prodotto</th>
                        <th>Prezzo unitario</th>
                        <th>Quantit&agrave; selezionata</th>
                        <th>Prezzo totale per prodotto</th>
                    </tr>
                    <?php
                        $prezzi = array("cd" => 0.5 , "dvd" => 1 , "sd" => 7.5 , "usb" => 5);
                        $nomi = array("cd" => "CD" , "dvd" => "DVD" , "sd" => "Memoria SD" , "usb" => "Memoria USB");
                        
                        $items = 0;
                        $tot = 0;

                        foreach($_SESSION as $key => $value) {
                            if( $value > 0 ) {
                                ++$items;
                                $tot += $prezzi[$key] * $value;
                                echo "<tr>\n<td>{$nomi[$key]}</td>\n<td>{$prezzi[$key]}&euro;</td>\n<td>{$value}</td>\n<td>" . ($prezzi[$key] * $value) . "&euro;</td>\n</tr>\n";
                            }
                        }
                        
                        if( $items > 0 ) {
                            echo "<tr><td colspan='4'>Prezzo Totale: {$tot} &euro;</td></tr>\n";
                    ?>
                           <tr>
                              <td colspan="4">
                              <form name="f_compra" action="checkout_3.php" method="POST">
                                <p><input type="submit" name="acquisto" value="compra"></p>
                              </form>
                              <form name="f_svuota" action="" method="POST">
                                <!--se non specifico niente allora l'action rimanda alla stessa pagina (penso)-->
                                <p><input type="submit" name="svuota_carrello" value="Svuota carrello"></p>
                              </form>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <p class="move">
                <?php
                    if ($items == 0)
                        echo "non ci sono elementi nel carrello";
                    else if ($items == 1) 
                        echo "c'&egrave; ".$items." elemento nel carrello";
                    else
                        echo "ci sono ".$items." elementi nel carrello";                                            
                ?> 
                </p>
                <p class="move"><a href="prod_3.php">&lt;&lt; Clicca qui per tornare alla pagina iniziale</a></p>
        <?php
            }
        ?>
    </body>
</html>
