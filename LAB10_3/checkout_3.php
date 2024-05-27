<?php
//come mai bisogna rifare session_start()? non era già iniziata la sessione nelle pagine precedenti?

//risposta: Hai ragione nel dire che la sessione dovrebbe essere già iniziata se è stata avviata nelle pagine precedenti. 
//Tuttavia, per garantire che lo stato della sessione sia accessibile, è una buona pratica chiamare session_start() all'inizio 
//di qualsiasi script PHP che utilizza le sessioni. Questo perché session_start() recupera 
//i dati di sessione se una sessione esiste già, oppure ne avvia una nuova se non esiste.
    $session = true;
    session_start();
    
    if (session_status() === PHP_SESSION_DISABLED) {
        $session = false;
    } elseif (session_status() === PHP_SESSION_ACTIVE && isset($_REQUEST['acquisto']) && $_REQUEST['acquisto'] === 'compra') {
        if (isset($_SESSION["contatore"])) {
            ++$_SESSION["contatore"];
        } else {
            $_SESSION["contatore"] = 1; // Inizia a contare da 1
        }

        // Salva il contatore in una variabile prima di distruggere la sessione
        $contatore = $_SESSION["contatore"];
        
        // Distruggi la sessione
        session_destroy();
        $_SESSION = array();

        // Rimuovi il cookie di sessione
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]);
    } else {
        // Reindirizza a un'altra location se le condizioni non sono soddisfatte
        header('Location: prod_3.php');
        exit();
    }
?>
<!doctype html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <title>Esercizio 10.3 - Conferma Acquisto</title>
    </head>
    
    <body>
        <?php
            if (isset($contatore)) {
                printf("<p>Hai visitato un totale di %d pagine, compresa quest'ultima</p>", $contatore);
            } else {
                echo "<p>Errore nel calcolo del contatore delle pagine.</p>";
            }
            
            if (!$session) {
                echo "<p>SESSIONI DISABILITATE, impossibile proseguire</p>";
            } else {
        ?>
                <h1>Risultato acquisto</h1>
                <p class="move">L'ordine è avvenuto con successo! <a href="prod_3.php">Torna alla homepage</a></p>
        <?php
            }
        ?>
    </body>
</html>
