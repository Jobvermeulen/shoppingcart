<?php
    class logoutController extends baseController
    {
        //Function to logout
        function doLogout() 
        {
            try 
            {
                //Start session
                session_start();
                //Unset session
                if(session_unset()) {
                    //Destroy session
                    if(session_destroy()) {
                        //Go to index
                        header("Location: index");
                    }
                    else {
                        //go to index and throw exception
                        header("Location: index");
                        throw new Exception('Logout failed. Try again please!');
                    }
                }
                else {
                    //go to index and throw exception
                    header("Location: index.php");
                    throw new Exception('Logout failed. Try again please!');
                }
            }
            catch (Exception $e) {
                //Get exception messages
                echo $e->getMessage;
            }
        }
    }