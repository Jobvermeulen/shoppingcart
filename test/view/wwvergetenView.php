<!DOCTYPE html>
<html>
<head>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post = $_POST;
        
        $controller = new wwvergetenController($post);
        $controller->checkUser();
    } else {
    }
    ?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shoppingcart homepagina signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" media="screen" href="css/css.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/css.css')) ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/css_wwvergeten.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/css_wwvergeten.css')) ?>" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="javascript/wwvergeten.js?$$REVISION$$"></script>

</head>
<body>
    <section class="page">
        <div id='box'>
        <h1>Welkom op <span id="special"> shoppingcart!</span></h1>
        </div>
        <p id="uitlegtekst">Wachtwoord vergeten!</p>
        <a class="apart" href="index">Terug naar homepagina</a>

        <section class="form-wwvergeten">
            
            <form class='wrapper' method="POST">
                <section class="top-wwvergetenForm-email">
                    <section id="WWVergetenForm-email" method="POST">
                        <h3>Vul hier je email adres in!</h3>
                        <p class='error'><span id="wwHint"></span></p>
                        <input id="emailinput" class="inputform email" type="text" name="user_email" placeholder="e-mailadres">
                    </section>
                    <button id="emailbtn" class="btn" type="button">Controleer email</button>
                 </section>

                <section class="top-WWVergetenForm-username">
                    <section id="WWVergetenForm-username" method="POST">
                        <h3>Vul hier je username in!</h3>
                        <p class='error'><span id="awwHint"></span></p>

                        <input class="inputform" type="text" name="username" placeholder="username">                
                        <button class="btn" type="submit">Stuur vergeten email!</button>
                    </section>
                    <button class="btn terug" type="button">Terug</button>
                </section>
            </form>
        </section>       
    </section>

    <footer>
        <p class='footertekst'> © JVERMEULEN </p>
    </footer>
        
</body>
</html>