<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
class wwvergetenController extends baseController
{
    public $userData;

    public function __construct($post)
    {
        $this->userData = $post;
    }

    //controleren van de user in de database
    public function checkUser(){
        $email = $this->Arraydestroyer('user_email');
        $username = $this->Arraydestroyer('username');
        
        try{        
            $vergetenModel = new wwvergetenModel();
            $result = $vergetenModel->checkforCombination($email, $username);
        }catch(Exception $e){
            echo $e->getMessage();
        }      

        // controleren van user en email gelijk zijn aan elkaar
        if(mysqli_num_rows($result) != 1){
            header('Location:?Checkuser=false');
        }else{
            //het creeren van een token
            $token = $this->createToken();
            //doorsturen naar het model voor de upload
            $resulttoken = $vergetenModel->uploadToken($token, $username);

            if($resulttoken->num_rows == 1){
                header('Location: ?token_upload_went_wrong');
                exit();
            }
            else{
                $emailtxt = "<html>
                            <head>
                                <title>Wachtwoord vergeten</title>
                            </head>
                            <body>
                                <h1>Beste shoppingcart gebruiker,</h1></br>
                                <p>Deze email is gestuurd omdat u uw wachtwoord bent vergeten op Shoppingcart.nl</p></br>
                                <p>Via deze link: https://test.jvermeulen.nl/newWW kunt u uw wachtwoord opnieuw invullen.</p></br>
                                <p>Hiervoor heeft u een tijdelijk wachtwoord gekregen: ". $token ." </p></br>
                                <h2>Met vriendelijke groet,</h2></br>
                                <h2>Shoppingcart.nl</h2></br>
                                <h2>https://shoppingcart.jvermeulen.nl</h>
                            </body>
                            </html>";

                $mailController = new mailController();
                if($mailController->sendEmailPWD($emailtxt, $this->userData)){
                    //als email verstuurd is!
                    header('Location: ?mail_send');
                }else{
                    header('Location: ?error_mail_didnt_send');

                }
            }
        }       
    }
  
    public function createToken(){
        // creeren van een token die wordt mee geven aan de user. (tijdelijk wachtwoord...)
        $token = bin2hex(random_bytes(12));
        return $token;
    }

    //methode die nieuwe wachtwoord controleert en doorstuurt naar model
    public function newWW(){
        $ww1 = $this->Arraydestroyer('ww1');
        $ww2 = $this->Arraydestroyer('ww2');
        $token = $this->Arraydestroyer('tokenInput');

        try{
            if($ww1 == $ww2){
                //het hashen van het nieuwe wachtwoord
                $hashedpassword = hash('sha256', $ww1);
                $wwvergetenModel = new wwvergetenModel();
                $result = $wwvergetenModel->uploadNewPWS($token, $hashedpassword);
                if($result == true){
                    header('Location:?Password_changed!');
                }else{
                    header('Location:?Something_went_wrong');
                }
            }else{
                header('Location:?Passwords_dont_match');       
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }   
    }

    public function checkToken($token){
        try{
            $wwvergetenModel = new wwvergetenModel();
            $result = $wwvergetenModel->checkToken($token);
            if($result->num_rows == 1){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }  
    }
}
?>