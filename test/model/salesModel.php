<?php
    class salesModel{
        private $db;

        public function __construct(){
            $this->db = db::getInstance();
        }

        public function getSalesFromDB(){
            //Function for getting sales information per day from db       
            $con = $this->db->con;

            //Query
            $sql = 'SELECT P.userID, U.user_uid, P.orderID, P.price, P.status, P.date FROM payment as P JOIN users as U on P.userID = U.user_id ORDER BY P.date DESC';

            if($result = mysqli_query($con, $sql))
            {     
                //Get result
                return $result;
            }
            else {
                //Throw exception if execution goes wrong
                throw new Exception('Getting ticket data failed!');
            }
        }
        
    }
?>