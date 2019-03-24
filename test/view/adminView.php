<!DOCTYPE html>
<html>
<head>
    <?php   
        $baseController = new baseController();
        $bool = $baseController->checkAdmin();
        if(!$bool){
            header('Location: index');
        }else{
            
        }
    ?>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shoppingcart homepagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="css/css.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/css.css')) ?>" />
    <meta name="google-site-verification" content="D-7NEApjSnwpBJlLojGTJyb86OO3TzuJ8XPiXAYAd4Y" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='../jquery/homepage.js?$$REVISION$$'></script>

</head>
    <body>
        <!-- head -->
        <div id='box'>
        <h1>Welkom op <span id="special"> shoppingcart!</span></h1>
        </div>
       <section class='choose_option'>
            <a class='btnsignin btn' href='csvdownload'>Download csv file!</a>
            <a class="btnsignin btn" href="logout">Log uit</a>
       </section>

        <!-- footer         -->
        <footer> 
                <p class='footertekst'> © JVERMEULEN </p>
        </footer>
    </body>
</html>