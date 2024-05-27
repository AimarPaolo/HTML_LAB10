<?php
    $session = true;
    
if( session_status() === PHP_SESSION_DISABLED  )
    $session = false;
elseif( session_status() !== PHP_SESSION_ACTIVE && isset($_REQUEST['acquisto']) && $_REQUEST['acquisto']==='compra' )
{
    session_start();
    session_destroy();
    $_SESSION=array();
    // cancella il cookie
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time()-42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]);
}
else
//ti rimanda ad un'altra location
    header('Location: prod_3.php');
    exit();

?>
<!doctype html>
<html lang="it">
    <head>
	    <meta charset="utf-8">
        <title>Esercizio 10.3 - Conferma Acquisto</title>
    </head>
    
    <body>
        <?php
            if(!$session)
            {
                echo "<p>SSESSIONI DISABILITATE, impossibile proseguire</p>";
            }
            else
            {
        ?>
                <h1>Risultato acquisto</h1>
                <p class="move">L'ordine &egrave; avvenuto con successo! <a href="prod_3.php">Torna alla homepage</a></p>
        <?php
            }
        ?>
    </body>
    
</html>