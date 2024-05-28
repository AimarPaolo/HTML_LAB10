<?php
    $session = true;

    // Check the session status and start a session if necessary
    if(session_status()===PHP_SESSION_DISABLED){
        $session = false;        
    } elseif(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    // Check and set the language
    if( isset($_REQUEST['lang']) && ($_REQUEST['lang']=='IT' || $_REQUEST['lang']=='EN')){
        $lang = $_SESSION['lang'] = $_REQUEST['lang'];
    } elseif( isset($_SESSION['lang'])){
        $lang = $_SESSION['lang'];
    } else {
        // Set default language to Italian
        $lang = $_SESSION['lang'] = 'IT';
    }

    // Include the content file
    include("content_5.php");
?>
<!doctype html>
<html lang="it">
    <head>
        <title>Esercizio 10.5</title>
        <meta charset="utf-8">
        <meta name="author" content="Paolo Aimar" >
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

                <h1><?php echo $titolo_menu; ?></h1>
                <ul>
                    <li><a href="torino.php"><?php echo $to; ?></a></li>
                    <li><a href="milano.php"><?php echo $mi; ?></a></li>
                </ul>
        <?php
            }
        ?>
    </body>
</html>
