<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

class loginController extends baseController
{
    public $userData;

    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    //login doormiddel van uid en password
    public function Login()
    {   
        //uid en password kunnen niet leeg zijn vanwege required veld in html
        $uid = $this->Arraydestroyer('uid');
        $password = $this->Arraydestroyer('pwd');
        $hashedpassword = hash('sha256', $password);
        try{
            $loginModel = new loginModel($uid, $hashedpassword);
            $result = $loginModel->CheckDBForUser();
            //Check if user credentials are right
            if($result->num_rows == 1) {
                $user = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['user']['signedIn'] = true;
                $_SESSION['user']['user_id'] = $user['user_id'];
                $_SESSION['user']['user_uid'] = $user['user_uid'];
                $_SESSION['user']['user_admin'] = $user['user_Admin'];
                if($this->checkAdmin()){
                    header('Location: chooseMenu');
                }else{
                    header('Location: cards');
                }
            }else{
                $error = 'Je username of password staan niet in de database!';
                return $error;
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }      
    }
    
}
?>