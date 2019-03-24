<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
    class paymentModel{
        public $db;

        public function __construct(){
            $this->db = db::getInstance();
        }

        public function setOrderInDB($price, $orderId, $userID){
            $con = $this->db->con;

            $sql = "INSERT INTO `payment`(`userID`, `orderID`, `price`) VALUES (?,?,?);";

            //Prepare statement
            if($stmt = $con->prepare($sql)) {
                //Bind parameters
                $stmt->bind_param("isd", $userID, $orderId, $price);
                //Execute statement 
                if(!$stmt->execute()){ 
                    //Throw exception if execution goes wrong
                    throw new Exception('failed to add payment to db. Try again later!');
                }
                else{
                    
                }

            }else{
                throw new Exception("Couldn't prepare statement");
            }  
        }

        public function changeStatusOrder($orderId, $status){
            $con = $this->db->con;

            $sql = "UPDATE `payment` SET `status`= ? WHERE `orderID` LIKE ?;";

            //Prepare statement
            if($stmt = $con->prepare($sql)) {
                //Bind parameters
                $stmt->bind_param("ss", $status, $orderId);
                //Execute statement 
                if(!$stmt->execute()){ 
                    //Throw exception if execution goes wrong
                    throw new Exception('failed to add payment to db. Try again later!');
                }
                else{
                    $result = $this->getUserID_OrderID($orderId);
                }
                return $result;
            }else{
                throw new Exception("Couldn't prepare statement");
            }
        }

        public function getUserID_OrderID($orderId){
            // mail("jobvermeulen@gmail.com","Betaald!", 'dit is een testje');

            $con = $this->db->con;

            $sql = "SELECT `userID` FROM `payment` WHERE `orderID` LIKE ?";

            //Prepare statement
            if($stmt = $con->prepare($sql)) {
                //Bind parameters
                $stmt->bind_param("s", $orderId);
                //Execute statement 
                if(!$stmt->execute()){ 
                    //Throw exception if execution goes wrong
                    throw new Exception('failed to add payment to db. Try again later!');
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