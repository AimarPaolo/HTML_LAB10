<?php 
    $session = true;
    
if( session_status() === PHP_SESSION_DISABLED  )
    $session = false;
elseif( session_status() !== PHP_SESSION_ACTIVE )
{
    session_start();

    if( isset($_REQUEST['lang']) && ($_REQUEST['lang']=='IT' || $_REQUEST['lang']=='EN'))
        $lang = $_SESSION['lang'] = $_REQUEST['lang'];
    elseif( isset($_SESSION['lang']) )
        $lang = $_SESSION['lang'];
    else
        $lang = $_SESSION['lang'] = 'IT';

    require("content_5.php");
    /*    require: È comunemente usato quando il file è essenziale per l'esecuzione dello script. Se il file è mancante o non accessibile, è preferibile fermare l'esecuzione poiché lo script potrebbe non funzionare correttamente senza di esso.
    include: È usato quando il file è opzionale. L'esecuzione dello script può continuare anche se il file non è presente, sebbene alcune funzionalità potrebbero non essere disponibili.*/
}
?>
<!doctype html>
<html lang="it">
    <head>
        <title>Esercizio 10.5</title>
        <meta charset="utf-8">
    </head>
    
    <body>
        <?php
            if(!$session)
            {
                echo "<p>SESSIONI DISABILITATE, impossibile proseguire</p>";
            }
            else
            {
        ?> 
                <div id="lang-bar">
                	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    	<p>
                        	<input type="submit" name="lang" value="IT">
                        	<input type="submit" name="lang" value="EN">
                        </p>
                    </form>
                </div>
                
                <h1><?php echo $to;?></h1>
                <p><?php echo $to_content;?></p>
                <p><a href="first_5.php">&lt;&lt; <?php echo $indietro;?></a></p>
        <?php
            }
        ?>
    </body>
    
</html>
