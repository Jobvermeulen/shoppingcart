<!DOCTYPE html>
<html>
<head>
    <?php
    $baseController = new baseController();
    $userUID = $baseController->checkLogin();

    $cardController = new cardController();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['buttonsumbitarticle'])) {
        $post = $_POST;
        $result = $cardController->addcard($post, $_FILES['image']);
        print_r($result);
        }elseif(isset($_POST['buttondonatie'])){
            $post = $_POST;
            $price = $post['donateVAL'];
            $payController = new payController();
            $payController->pay($price);
        }else{}
    }
    ?>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Uw shoppingcart</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/cssuser.css?version=<?php echo date('Y-m-d-H-i-s', filemtime('css/cssuser.css')) ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="javascript/cards.js?$$REVISION$$"></script>


    </head>
    <body>        
        <section id="page">
                <div id='box'>
                <h1>Welkom op <span id="special"> shoppingcart!</span></h1>
                </div>
                
                <section id="menubalk">
                    <p class="username"><?php echo $userUID; ?></p>
                    <a class="username buttonuitlog" href='logout'>logout</a>
                </section>

                <h2 class="underline">Uw shoppingcarts</h2>
                <section id="shoppingcart_cards">       

                    <!--add an shoppingcart -->          
                    <section class="adding">
                        <p class="Headtoevoegen">Product toevoegen</p>
                        <form method="POST" enctype="multipart/form-data">
                            <input class="1 artikelinput" type="text" name="articleName" placeholder="Naam product *" required>
                            <input class="2 artikelinput" type="number" min="0.00" step="0.01" name="articlePrice" placeholder="€ Prijs *" required>
                            <input class="3 artikelinput" type="number" min="0.00" step="0.01" name="articleDiscount" placeholder="€ Aanbiedingen (optioneel)">
                            <input class="4 artikelinput" type="text" name="articleStore" placeholder="Winkel *" required>
                            <input class="5 artikelinput" type="website" name="articleWeb" placeholder="Website product">
                      
                            <p class="info">Foto uploaden:</p>
                            <p class="error" id="photohint"></p>
                            <input type="file" name="image" class="floatr" id="photoUpload" onchange="changeDisable()">

                            <button id="buttonsumbitarticle" name="buttonsumbitarticle" type="sumbit">Toevoegen</button>
                        </form>
                        <p class="info">* is verplicht.</p>
                    </section>
                
                <!-- plaats andere section blokken met daar artikelen daarin! -->
                <?php
                    $result = $cardController->getCardArray();
                    //de return waarde bevat een aantal 'kaarten'
                    if (!empty($result)) {
                        while ($card = mysqli_fetch_assoc($result)) {
                            echo "<section class='artikel'>";
                            // echo "<p class='hide_tag_card'>" . $card['shoppingcartItem'] . "</p>";
                            echo "<h3 class='title'>" . $card['shoppingcartName'] . "</h3>";

                            if(!empty($card['shoppingcartPhoto'])){
                                echo "<section class='photo'>";
                                echo "<img src='". explode('test/', $card['shoppingcartPhoto'])[1]. "'>";
                                echo "</section>"; 
                            }else {  }

                            echo "<section class='block'>";
                            if (empty($card['shoppingcartDiscount'])) {
                                echo "<h3 class='info'>Prijs: €" . $card['shoppingcartPrice'] . " </h3>";
                                echo "<h3 class='korting'>Er is geen korting op dit product </h3>";
                            } else {
                                echo "<h3 class='info'>Orginele prijs: €" . $card['shoppingcartPrice'] . " </h3>";
                                echo "<h3 class='korting'>Korting: €" . $card['shoppingcartDiscount'] . "</h3>";
                                echo "<h3 class='newprice'>Totaal prijs: € " . ($card['shoppingcartPrice'] - $card['shoppingcartDiscount']) . "</h3>";
                            }
                            echo "</section>";

                            echo "<h3>Winkel: " . $card['shoppingcartStore'] . "</h3>";
                            if(!empty($card['shoppingcartWebsite'])){
                                echo "<section class='website'>";
                                if(strpos($card['shoppingcartWebsite'], 'https://') !== false){
                                    $url = $card['shoppingcartWebsite'];
                                }else{
                                    $url = "https://" . $card['shoppingcartWebsite'];
                                }
                                echo "<h3>Website: <a target=blank href='" . $url . "'>";
                                if (count($card['shoppingcartWebsite']) < 45) {
                                    $website = substr($card['shoppingcartWebsite'], 0, 45);
                                    $website = $website . '...';
                                    echo $website;
                                } else {
                                }
                                echo "</a></h3>";
                                echo "</section>";

                            }
                            else{

                            }                  
                            echo "<h3>Aanmaakdatum van kaart: </br>";
                            echo $card['shoppingcartCreationDate'];
                            echo "</h3>";
                            echo "<div class='tooltip'>";
                            echo "<button class='deleteCard' onclick=removeCard(".$card['shoppingcartItem'].")>Verwijder shoppingcart! </button>"; 
                            echo "<span class='tooltiptext'>Verwijderen betekent dat dit kaartje voor eeuwig weg is! En dat is lang!</span>";
                            echo "</div>";
                            echo "</section>";
                        }
                    
                    } else {
                    }
                ?>

                </section>     
            <!-- footer         -->
                 
        </section>   

        <footer class='footer'>
                <p class='footertekst'> © JVERMEULEN </p>
                <button class='donateBTN' onclick=openDonate()>Doneer aan de ontwikkelaar!</button>
        </footer>      
    </body>
</html>