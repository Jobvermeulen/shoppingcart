<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
class baseModel
{
    public $db;

    public function __construct(){
        $this->db = db::getInstance();
    }

    public function getUserInfo($userID){
        $con = $this->db->con;

        $sql = "SELECT `user_first`,`user_last`,`user_email` FROM `users` WHERE `user_id` LIKE ?;";

        //Prepare statement
        if($stmt = $con->prepare($sql)) {
            //Bind parameters
            $stmt->bind_param("i", $userID);
            //Execute statement 
            if(!$stmt->execute()){ 
                //Throw exception if execution goes wrong
                throw new Exception('failed to get user info from db. Try again later!');
            }
            else{

                $result = $stmt->get_result();
            }
            return $result;
        }else{
            throw new Exception("Couldn't prepare statement");
        }  
    }
}
?>