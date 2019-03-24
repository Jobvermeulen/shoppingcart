<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
class makeNewAccountController extends baseController
{
    public $userData;

    public function __construct($userData){
        $this->userData = $userData;
    }

    function signUp()
    {
        $first = $this->Arraydestroyer('first');
        $last = $this->Arraydestroyer('last');
        $email = $this->Arraydestroyer('email');
        $uid = $this->Arraydestroyer('uid');
        $pwd = $this->Arraydestroyer('pwd');

        //Controleer voor lege velden
        if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
            header('Location: ?signup=empty');
            exit();
        } else {
            //controleer voor gekke tekens
            if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                header('Location: ?signup=invalid');
                exit();
            } else {
                    //controleer of email valid is
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header('Location: ?signup=invalid_email');
                    exit();
                } else {
                    //controleer de captcha response
                    if($_POST['g-recaptcha-response']){

                        //new model
                        $newAccountModel = new newAccountModel(); 
                        try{
                            $userResult = $newAccountModel->checkUID($uid);
                            if($userResult->num_rows == 0){
                                //password hash with sha256
                                $hashedpassword = hash('sha256', $pwd);
                                $boolAccount = $newAccountModel->insertUSRinDB($first, $last, $email, $uid, $hashedpassword);
                                //check if account was made!
                                if($boolAccount == 1){
                                    header('Location: ?signup=succes');
                                }else{
                                    header('Location: ?signup=something went wrong!');
                                    exit();}
                            }else{
                                header('Location: ?signup=usertaken');
                                exit();
                            }
                        }catch(Exception $e){
                            echo $e->getMessage();
                        }    
                        
                    }else{
                        grecaptcha.reset();
                        header('Location: ?signup=captcha_fout');
                    }             
                     
                }
            }
        }

    }
}
?>


