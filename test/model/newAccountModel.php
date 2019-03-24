<?php
    class newAccountModel{
   
        //controleer userID
        //als er 0 rows uitkomen bestaat userID nog niet
        public function checkUID($username)
        {   
            //get the connection
            $db = db::getInstance();
            $con = $db->con;
            //query
            $sql = "SELECT user_uid FROM users WHERE user_uid LIKE ?;";
            //Prepare statement
            if($stmt = $con->prepare($sql)) {
                //Bind parameters
                $stmt->bind_param("s", $username);
                //Execute statement 
                if(!$stmt->execute()){ 
                    //Throw exception if execution goes wrong
                    throw new Exception('checkUser failed. Try again later!');
                }
                else {
                    //Get result
                    $result = $stmt->get_result();
                }
                // if(!$con->Close()){
                //     throw new Exception("Couldn't close the DB.");
                // }else{ 
                // }
                //Return result
                return $result;
            }else{
                throw new Exception("Couldn't prepare statement");
            }            
        }

        public function insertUSRinDB($first, $last, $email, $uid, $pwd){
            //get the connection
            $db = db::getInstance();
            $con = $db->con;
            //query
            $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES (?, ?, ?, ?, ?);";
            //Prepare statement
            if($stmt = $con->prepare($sql)) {
                //Bind parameters
                $stmt->bind_param("sssss", $first, $last, $email, $uid, $pwd);
                //Execute statement 
                if(!$stmt->execute()){ 
                    //Throw exception if execution goes wrong
                    throw new Exception('insertUSRinDB failed. Try again later!');
                }
                else {
                    //Get result
                    $result = $stmt->affected_rows;
                }
                // if(!$con->Close()){
                //     throw new Exception("Couldn't close the DB.");
                // }else{ }
                //Return result
                return $result;
            }else{
                throw new Exception("Couldn't prepare statement");
            }  
        }
    
    }
    

?>