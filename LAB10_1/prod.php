<?php
    $session = true;
    if(session_status() === PHP_SESSION_DISABLED){
        $session = false;
    }elseif(session_status() !== PHP_SESSION_ACTIVE){
        //se la sessione non è attiva allora ne creo una, inizializzando le variabili al valore che voglio
        session_start();
        if(!isset($_SESSION["cd"])){
            $_SESSION["cd"] = 0;
        }if( !isset($_SESSION["dvd"]) )
            $_SESSION["dvd"] = 0;
        if( !isset($_SESSION["sd"]) )
            $_SESSION["sd"] = 0;
        if( !isset($_SESSION["usb"]) )
            $_SESSION["usb"] = 0;
        //in questo caso ho inizializzato le variabili a 0 perchè il cliente non era mai entrato prima in questa pagina (o non 
        //era mai stata inizializzata una connessione)
    }

    
?>


<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Esercizio 10.1</title>
        <meta charset="utf-8">
        <meta name="author" content="Paolo Aimar">
        <script>
           function validateForm(arguments){
                var err = false;
                var regex = /^\d+$/;     
                console.log(arguments);          
                for(i=0; i<arguments.length && !err; ++i){
                    if( !regex.test(arguments[i]))
                        err = true;
                }
                if( err ) 
                {
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
                echo "<p>Sessioni disabilitate, impossibile presentare la pagina in modo corretto</p>";
            else{
        ?>
                <h1>Pagina acquisto beni</h1>
                <form name="product" action="basket.php" method="GET" onSubmit="return validateForm((ncd.value,ndvd.value,nsd.value,nusb.value));">
                    <table>
                        <caption>Lista beni acquistabili</caption>
                        <tr>
                            <th>Prodotto</th>
                            <th>Descrizione</th>
                            <th>Prezzo</th>
                            <th>Quantit&agrave;</th>
                        </tr>
                        <tr>
                            <td>CD</td>
                            <td>Supporto di memorizzazione digitale della capacit&agrave; massima di 870 MB</td>
                            <td>0.5 &euro;</td>
                            <td><input type='text' name='ncd' value='<?php echo $_SESSION["cd"]; ?>' ></td>
                        </tr>
                        <tr>
                            <td>DVD</td>
                            <td>Supporto di memorizzazione digitale della capacit&agrave; massima di 17 GB</td>
                            <td>1 &euro;</td>
                            <td><input type='text' name='ndvd' value='<?php echo $_SESSION["dvd"]; ?>' ></td>
                        </tr>
                        <tr>
                            <td>Memoria SD</td>
                            <td>Secure Digital &egrave; il pi&ugrave; diffuso formato di schede di memoria</td>
                            <td>7.5 &euro;</td>
                            <td><input type='text' name='nsd' value='<?php echo $_SESSION["sd"]; ?>' ></td>
                        </tr>
                        <tr>
                            <td>Memoria USB</td>
                            <td>Memoria di massa portatile di dimensioni molto contenute collegabile al computer mediante porta USB</td>
                            <td>5 &euro;</td>
                            <td><input type='text' name='nusb' value='<?php echo $_SESSION["usb"]; ?>' ></td>
                        </tr>
                        <tr>
                            <td colspan="4"><input type="submit" value="Inserisci"></td>
                        </tr>
                    </table>
                </form>
        <?php
            }
        ?>
    </body>
</html>