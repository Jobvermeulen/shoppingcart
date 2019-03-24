<!DOCTYPE html>
<html>
<head>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userData = $_POST;
      
        //make new class
        $controller = new makeNewAccountController($userData);
        $controller->Signup();
    } else {
    }
    ?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shoppingcart homepagina signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="css/css.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/css.css')) ?>" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='javascript/newAccount.js'></script>
</head>
<body>
    <section class="page">
        <section id="alertbar"></section>

        <section id='box'>
        <h1>Welkom op <span id="special"> shoppingcart!</span></h1>
        </section>

        <p class="uitlegtekst">Op shoppingcart kunt u uw eigen lijstjes maken van artikelen die u bij winkels gezien heeft. Hierdoor hoeft u nooit meer te denken "ah hoe heet dat product ook alweer!".</p>

        <section class="forms">
            <h2>Nog geen gebruiker? <br>
                Vul hier uw gegevens in.</h2>

            <form id="signupform" method="POST">
                <input class="inputform" id='first' type="text" name="first" placeholder="Voornaam" required>
                <input class="inputform" id='last' type="text" name="last" placeholder="Achternaam" required>
                <input class="inputform" id='email' type="text" name="email" placeholder="e-mail" autocomplete="off" required>
                <input class="inputform" id='username' type="text" name="uid" maxlength="25" placeholder="Gebruikersnaam" autocomplete="off" required>
                <input class="inputform" id='pwd' type="password" name="pwd" maxlength="25" placeholder="Wachtwoord" autocomplete="off" required onchange='showpasswordHint()'>
                <p class='error' id='passwordhint'> </p>
                <!-- <section id="captcha">
                <div class="g-recaptcha" data-sitekey="6LcyvHUUAAAAAL5m_a4rpZfOuJFmsWs0L3oaPegZ"></div>
                <p class="powerdby powerdbytext">Powerd by Google</p>
                </section> -->
                <button class="btn" type="submit" onclick='signUp()'>Signup</button>
                <p id='error'>Een van de velden zijn leeg!</p>
            </form>
            <a class="btnsignin btn" href="index">Ga terug naar inloggen!</a>
        </section>
    </section>
        <footer >
            <p class='footertekst'> © JVERMEULEN </p>
        </footer>
        
</body>
</html>