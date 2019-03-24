<!DOCTYPE html>
<html>
<head>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['WWbtn'])) {
        $post = $_POST;

        $controller = new wwvergetenController($post);
        $controller->newWW();
        }
    } else {
    }
    ?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shoppingcart homepagina signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" media="screen" href="css/css.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/css.css')) ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/css_newWW.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/css_newWW.css')) ?>" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="javascript/newWW.js?$$REVISION$$"></script>

</head>
<body>
    <section class="page">
    <section id="alertbar"></section>

    <div id='box'>
        <h1>Welkom op <span id="special"> shoppingcart!</span></h1>
        </div>
        <p class="uitlegtekst">Wijzig wachtwoord!</p>

        <section class="newWW_form">
            <p class='error'><span id="tokenHint"></span></p>
            <form id='wwform' class='' method="POST">
                <input class='' id='tokenInput' name='tokenInput' placeholder="Vul hier uw token in" type='text' required> 
                <button id="tokenbtn" class="btn" type="button">Valideer token</button>

                <section id="newPWS">
                    <p class='error'><span id="wwHint"></span></p>
                    <input class='' id='wwinput_1' name='ww1' placeholder="Vul hier uw nieuwe wachtwoord in" type="password" required> 
                    <input class='' id='wwinput_2' name='ww2' placeholder="Vul hier nogmaals uw wachtwoord in" type="password" onchange="passwordCheck()" required> 
                    <button id="WWbtn" class="btn" type="submit" name="WWbtn" disabled>Pas wachtwoord aan</button>
                </section>
            </form>
        </section>
       
    </section>

    <footer>
        <p class='footertekst'> © JVERMEULEN </p>
    </footer>
        
</body>
</html>