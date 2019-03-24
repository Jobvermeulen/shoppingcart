<!DOCTYPE html>
<html>
<head>
    <?php
    // als je op de submit button heb gedrukt.
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $userData = $_POST;
        //nieuwe class aanmaken
        $loginController = new loginController($userData);
        $result = $loginController->Login();
        if($result){
            header('location:?credentials_were_undefined_in_db');
        }
    } else { }
    ?>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shoppingcart homepagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="css/css.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/css.css')) ?>" />
    <meta name="google-site-verification" content="D-7NEApjSnwpBJlLojGTJyb86OO3TzuJ8XPiXAYAd4Y" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='javascript/index.js?$$REVISION$$'></script>

</head>
<body>
        <section id="alertbar"></section>

        <div id='box'>
        <h1>Welkom op <span id="special"> shoppingcart!</span></h1>
        </div>
        <p class="uitlegtekst">Op shoppingcart kunt u uw eigen lijstjes maken van artikelen die u bij winkels gezien heeft. 
        Hierdoor hoeft u nooit meer te denken "ah hoe heet dat product ook alweer!".</p>

        <section class="forms">
            <h2>Log hier in!</h2>
            <form id="loginform" method="POST">
                <input class="inputform" type="text" name="uid" maxlength="25" placeholder="Gebruikersnaam">
                <input class="inputform" type="password" name="pwd" maxlength="25" placeholder="Wachtwoord">
                <button class="btn" type="submit">login</button>
            </form>            
            <section id='extraoptions'>
                <a class="floatl btn" href="signUpView">Geen account klik hier!</a>
                <a class="floatr btn" href="wwvergeten">Wachtwoord vergeten</a>  
                <a class="btn nsBTN" href="ns_api">Of kijk hoelaat de treinen rijden!</a>
            </section>
         
            <?php
            // $url = $_SERVER['REQUEST_URI'];
            // switch (true) {
            //     case stripos($url, 'signup=succes'):
            //         echo '<p id="gelukt">Je account is aangemaakt!</p>';
            //         break;
            //     case stripos($url, 'login=foutje'):
            //         echo '<p class="error">Met deze waarden sta je niet in het systeem</p>';
            //         break;
            // }
            ?>
        </section>
        <!-- footer         -->
        <footer> 
                <p class='footertekst'> © JVERMEULEN </p>
        </footer>
</body>
</html>