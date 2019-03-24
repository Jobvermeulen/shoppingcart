<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
class payController extends baseController{

    protected $payModel;

    public function __construct(){
        $this->payModel = new paymentModel();
    }

    public function pay($price){
        $userID =  $this->getuserID();
        require_once("vendors/mollie-api-php/vendor/autoload.php");
        try{
            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey("test_mfH3KQhFkhkJ4FT3z6JgmvkkQuMhgR");
    
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => number_format($price, 2)
                ],
                "description" => "My first API payment",
                "redirectUrl" => "https://www.test.jvermeulen.nl/cards",
                "webhookUrl"  => "https://www.test.jvermeulen.nl/webhook",
            ]);
            
            $orderId = $payment->id;

            try{
                $this->payModel->setOrderInDB($price, $orderId, $userID);                
            }catch(Exception $e){
                echo $e->getMessage();
            }

            header("Location: " . $payment->getCheckOutUrl(), true, 303);
        }catch (\Mollie\Api\Exceptions\ApiException $e){
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }        
    }

    public function verifyPayWebhook(){   
        try {
            require_once( "vendors/mollie-api-php/examples/initialize.php");
            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey("test_mfH3KQhFkhkJ4FT3z6JgmvkkQuMhgR");    
           
            $payment = $mollie->payments->get($_POST["id"]);
            $orderId = $payment->id;

            try{
                $userIDNON = $this->payModel->changeStatusOrder($orderId, $payment->status);
                $userID = mysqli_fetch_assoc($userIDNON);

            }catch(Exception $e){
                mail("jobvermeulen@gmail.com","Betaald!", $e->getMessage());
            }

            if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {   
                $userInfo = $this->getUserInfo($userID['userID']);             

                $this->makePDFAndSendMail($userInfo, $orderId);
                /*
                 * The payment is paid and isn't refunded or charged back.
                 * At this point you'd probably want to start the process of delivering the product to the customer.
                 */
            } elseif ($payment->isOpen()) {
                
            } elseif ($payment->isPending()) {
                /*
                 * The payment is pending.
                 */
            } elseif ($payment->isFailed()) {

            } elseif ($payment->isExpired()) {               
                /*
                 * The payment is expired.
                 */
            } elseif ($payment->isCanceled()) {
                //remove form db               
            } elseif ($payment->hasRefunds()) {
                //unable
            } elseif ($payment->hasChargebacks()) {
                //unable
            }
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }

    public function makePDFAndSendMail($userInfo, $orderId){

        require_once("pdfController.php");
        $pdfController = new pdfController();
        $pdf = $pdfController->makePDF($userInfo, $orderId);

        require_once("mailController.php");
        $mailController = new mailController();
        $result = $mailController->sendEmailPDF($pdf, $userInfo);

    }

}

?>