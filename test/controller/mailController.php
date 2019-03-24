<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
    class mailController
    {        
        //versturen van een email naar een gebruiker
        public function sendEmailPDF($file, $userInfo){
            require_once('vendors/PHPMailer-master/src/PHPMailer.php');
            // require_once('vendors/PHPMailer-master/src/Exception.php');
            require_once('vendors/PHPMailer-master/src/SMTP.php');  

            $email = new PHPMailer();
            $email->SetFrom('info@jvermeulen.nl'); //Name is optional
            $email->Subject   = 'Conformation mail -- shoppingcart.nl';
            $email->isHTML(true);
            $email->Body      = '   <h1>Beste shoppingcart gebruiker,</h1>
                                    <p>Hierbij ontvangt u uw bevestiging van de donatie aan shoppingcart.nl! Wij bedanken u vriendelijk dat u de ontwikkeling steunt van shoppingcart.nl!</p>
                                    <h2>Met vriendelijke groet,</h2>
                                    <h3>Namens de oprichter van shoppingcart.nl,</h3>
                                    <p>Job Vermeulen</p>';
            $email->AddAddress( $userInfo['user_email'] );

            $email->addStringAttachment($file, 'PaymentComplete.pdf' );

            return $email->Send();
        }


        public function sendEmailPWD($emailtxt, $userInfo){
            require_once('vendors/PHPMailer-master/src/PHPMailer.php');
            // require_once('vendors/PHPMailer-master/src/Exception.php');
            require_once('vendors/PHPMailer-master/src/SMTP.php');  

            $email = new PHPMailer();
            $email->SetFrom('info@jvermeulen.nl'); //Name is optional
            $email->Subject   = 'password reset -- shoppingcart.nl';
            $email->isHTML(true);
            $email->Body      = $emailtxt;
            $email->AddAddress( $userInfo['user_email'] );

            return $email->Send();

        }
    }
?>