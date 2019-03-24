<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
class wwvergetenModel
{

    public $db;

    public function __construct()
    {
        $this->db = db::getInstance();      
    }

    //Controleer of de user met de opgegeven email en username in de DB staat
    public function checkforCombination($email, $username){

        $con = $this->db->con;
        //Query
        $sql = "SELECT user_id FROM users WHERE user_email LIKE ? and user_uid LIKE ?;";

        //Prepare statement
        if($stmt = $con->prepare($sql)) {
            //Bind parameters
            $stmt->bind_param("ss", $email, $username);
            //Execute statement 
            if(!$stmt->execute()){ 
                //Throw exception if execution goes wrong
                throw new Exception('checksystem failed. Try again later!');
            }
            else {
                //Get result
                $result = $stmt->get_result();
            }
            // if(!$this->closeDB($con)){
            //     throw new Exception("Couldn't close the DB.");
            // }else{ }
            //Return result
            return $result;
        }
        else {
            //Throw exception when prepare statement goes wrong
            throw new Exception('Loginsystem failed. Try again later!');
        }   
    }

    public function uploadToken($token, $username){
        $con = $this->db->con;
        //Query
        $sql = "UPDATE `users` SET `user_Token` = ? WHERE `user_uid` LIKE ?;";

        //Prepare statement
        if($stmt = $con->prepare($sql)) {
            //Bind parameters
            $stmt->bind_param("ss", $token, $username);
            //Execute statement 
            if(!$stmt->execute()){ 
                //Throw exception if execution goes wrong
                throw new Exception('upload token failed. Try again later!');
            }
            else {
                //Get result                
                $result = $stmt->get_result();
            }
            // if(!$this->closeDB($con)){
            //     throw new Exception("Couldn't close the DB.");
            // }else{ }
            //Return result
            return $result;
        }
        else {
            //Throw exception when prepare statement goes wrong
            throw new Exception('upload token  failed. Try again later!');
        }   
    }

    //het token(tijdelijke wachtwoord) wordt bij de user weggehaald
    public function deleteToken($token){
        $con = $this->db->con;
        //query
        $sql = "UPDATE `users` SET `user_Token` = NULL WHERE `user_Token` like ?;";
        //Prepare statement
        if($stmt = $con->prepare($sql)) {
            //Bind parameters
            $stmt->bind_param("s", $token);
            //Execute statement 
            if(!$stmt->execute()){ 
                //Throw exception if execution goes wrong
                throw new Exception('upload token failed. Try again later!');
            }
            else {
                //Get result
                $result = $stmt->get_result();
            }
            // if(!$this->closeDB($con)){
            //     throw new Exception("Couldn't close the DB.");
            // }else{ }
            //Return result
            return $result;
        }
        else {
            //Throw exception when prepare statement goes wrong
            throw new Exception('remove token failed. Try again later!');
        }  
    }

    public function uploadNewPWS($token, $pws){
        $con = $this->db->con;
        //Query
        $sql = "UPDATE `users` SET `user_pwd`= ? WHERE `user_Token` like ?;";
        //Prepare statement
        if($stmt = $con->prepare($sql)) {
            //Bind parameters
            $stmt->bind_param("ss", $pws, $token);
            //Execute statement 
            if(!$stmt->execute()){ 
                //Throw exception if execution goes wrong
                throw new Exception('upload pws failed. Try again later!');
            }
            else {
                //Get result
                $result = $stmt->get_result();
                $this->deleteToken($token);
            }
            // if(!$this->closeDB($con)){
            //     throw new Exception("Couldn't close the DB.");
            // }else{ }
            //Return result
            return true;
        }
        else {
            //Throw exception when prepare statement goes wrong
            throw new Exception('upload pws failed. Try again later!');
        }   
    }

    public function checkToken($token){
        $con = $this->db->con;
        //Query
        $sql = "SELECT 'user_uid' FROM `users` WHERE `user_Token` like ?;";

        //Prepare statement
        if($stmt = $con->prepare($sql)) {
            //Bind parameters
            $stmt->bind_param("s", $token);
            //Execute statement 
            if(!$stmt->execute()){ 
                //Throw exception if execution goes wrong
                throw new Exception('check token failed. Try again later!');
            }
            else {
                //Get result
                $result = $stmt->get_result();
            }
            // if(!$this->closeDB($con)){
            //     throw new Exception("Couldn't close the DB.");
            // }else{ }
            //Return result
            return $result;
        }
        else {
            //Throw exception when prepare statement goes wrong
            throw new Exception('check token failed. Try again later!');
        }   
    }

}

?>