<?php
    class cardModel{   

        public $userID;

        public function __construct($userID)
        {        
            $this->userID = $userID;
        }

        //get array form DB is het ophalen van alle cards (shoppingcards) die de user heeft gepost
        public function getarrayfromDB(){
            //get the connection
            $db = db::getInstance();
            $con = $db->con;

            $sql = "SELECT * FROM `Shoppingcarts` WHERE `user_ID` = ?;";
            //Prepare statement
            if($stmt = $con->prepare($sql)) {
                //Bind parameters
                $stmt->bind_param("i", $this->userID);
                //Execute statement 
                if(!$stmt->execute()){ 
                    //Throw exception if execution goes wrong
                    throw new Exception('failed to get cards from db. Try again later!');
                }
                else{
                    $result = $stmt->get_result();
                }
                return $result;
            }else{
                throw new Exception("Couldn't prepare statement");
            }  
        }

        //toevoegen van een artikel aan de db
        public function addCardtoDB($articleName,$articlePrice,$articleDiscount,$articleWeb, $articleStore){
            //get the connection
            $db = db::getInstance();
            $con = $db->con;

            $sql = "INSERT INTO `Shoppingcarts`(`user_ID`, `shoppingcartName`, `shoppingcartPrice`, `shoppingcartDiscount`, `shoppingcartWebsite`, `shoppingcartStore`) 
                    VALUES (?,?,?,?,?,?);";
            
            //Prepare statement
            if($stmt = $con->prepare($sql)) {
                //Bind parameters
                $stmt->bind_param("isddss", $this->userID, $articleName, $articlePrice, $articleDiscount, $articleWeb, $articleStore);
                //Execute statement 
                if(!$stmt->execute()){ 
                    //Throw exception if execution goes wrong
                    throw new Exception('failed add card to db. Try again later!');
                }
                else{
                    $result = $this->getID();
                }
                return $result;
            }else{
                throw new Exception("Couldn't prepare statement");
            }  

        }

        public function getID(){
            //get the connection
            $db = db::getInstance();
            $con = $db->con;

            $sql = "SELECT shoppingcartItem FROM Shoppingcarts WHERE user_ID LIKE ? ORDER BY `shoppingcartCreationDate` DESC;";
            if($stmt = $con->prepare($sql)) {
                //Bind parameters
                $stmt->bind_param("i", $this->userID);
                //Execute statement 
                if(!$stmt->execute()){ 
                    //Throw exception if execution goes wrong
                    throw new Exception('failed add card to db. Try again later!');
                }else{
                    $result = $stmt->get_result();
                }
            }else{
                throw new Exception("Couldn't prepare statement");
            }          
            return $result;
        }

        public function uploadImageUrl($shoppingcartItem, $url){
            //get the connection
            $db = db::getInstance();
            $con = $db->con;

            $sql = "UPDATE `Shoppingcarts` SET `shoppingcartPhoto` = ? WHERE `shoppingcartItem` = ?";

            if($stmt = $con->prepare($sql)) {
                //Bind parameters
                $stmt->bind_param("sd", $url, $shoppingcartItem);
                //Execute statement 
                if(!$stmt->execute()){ 
                    //Throw exception if execution goes wrong
                    throw new Exception('failed add card to db. Try again later!');
                }else{
                    $result = $stmt->get_result();
                }
            }else{
                throw new Exception("Couldn't prepare statement");
            }       

        }

        public function removeCardFromDB($cardID){
            //get the connection
            $db = db::getInstance();
            $con = $db->con;

            $sql = "SELECT shoppingcartPhoto FROM Shoppingcarts WHERE shoppingcartItem = ?;";
        
            if($stmt = $con->prepare($sql)) {
            //Bind parameters
            $stmt->bind_param("i", $cardID);
            //Execute statement 
            if(!$stmt->execute()){ 
                    //Throw exception if execution goes wrong
                    throw new Exception('failed to remove card from db. Try again later!');
            }else{
                $result = $stmt->get_result();

                $sql = "DELETE FROM `Shoppingcarts` WHERE `shoppingcartItem` = ?;";
                if($stmt1 = $con->prepare($sql)) {
                //Bind parameters
                $stmt1->bind_param("i", $cardID);
                
                //Execute statement 
                if(!$stmt1->execute()){ 
                //Throw exception if execution goes wrong
                throw new Exception('failed to remove card from db. Try again later!');
                }
                else{
                    
                } 

                return $result;
                }}
                
            }else{
                throw new Exception("Couldn't prepare statement");
            }      
        }

    }
?>
