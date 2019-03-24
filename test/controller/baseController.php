<?php  
    class baseController
    {
        //Function to load the views
        public static function createView(string $viewName) 
        {
            require_once('view/'.$viewName. 'View.php');
        }

        // //Function to load the menu
        // public function loadMenu(string $active) {
        //     include('views/modules/navVisitor.php');
        // }

        // //Function to load the footer
        // public function loadFooter() {
        //     include('views/modules/footer.php');
        // }

        // //Function to load the css files
        // public function loadHead(string $title, string $pageName) {
        //     include('views/modules/head.php');
        // }

        public function Arraydestroyer($waarde)
        {
            $result = $this->userData[$waarde];
            return $result;
        }

        public function checkLogin(){
            if(session_id() == ''){
                session_start();
            }else{ }
            if($_SESSION['user']['signedIn']){
                return $_SESSION['user']['user_uid'];
            }else{                
                header('Location: index');
            }
        }

        public function getuserID(){
            if(session_id() == ''){
                session_start();
            }else{ }
            if($_SESSION['user']['signedIn']){
                return $_SESSION['user']['user_id'];
            }else{                
                header('Location: index');
            }
        }

        public function getUserInfo($userID){
            try{
                require_once('model/baseModel.php');
                $baseModel = new baseModel();

                $result = $baseModel->getUserInfo($userID);
                $secondresult = mysqli_fetch_assoc($result);
                return $secondresult;
            }catch(Exception $e){
                mail("jobvermeulen@gmail.com","Betaald!", $e->getMessage());

                echo $e->getMessage();
            }
        }

        public function checkAdmin(){
            if(session_id() == ''){
                session_start();
            }else{ }
            if($_SESSION['user']['user_admin']){
                return true;
            }else{                
                return false;
            }
        }
    }
?>