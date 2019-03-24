<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

class loginModel extends baseModel
{
    public $uid;
    public $password;

    public function __construct($uid, $password)
    {
        $this->uid = $uid;
        $this->password = $password;
    }

    //controleer of de gebruiker in de DB staat
    //haalt password op voor controle in de controller
    public function CheckDBForUser()
    {
        //get the connection
        $db = db::getInstance();
        $con = $db->con;
        //Query
        $sql = "SELECT user_id, user_uid, user_Admin FROM users WHERE user_uid LIKE ? and user_pwd LIKE ?;";

        //Prepare statement
        if($stmt = $con->prepare($sql)) {
            //Bind parameters
            $stmt->bind_param("ss", $this->uid, $this->password);
            //Execute statement 
            if(!$stmt->execute()){ 
                //Throw exception if execution goes wrong
                throw new Exception('Loginsystem failed. Try again later!');
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
}
?>