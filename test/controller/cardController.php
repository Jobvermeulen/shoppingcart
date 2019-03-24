<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
class cardController extends baseController
{
    protected $cardModel;

    public function __construct(){
        $this->cardModel = new cardModel($this->getuserID());
    }

    //get the shoppingcards
    public function getCardArray()
    {
        try{
            $result = $this->cardModel->getarrayfromDB();
            if($result){
                return $result;
            }else{
                throw new Exception("couldn't load cards");
                exit();
        }        
        }catch(Exception $e){
            echo $e->getMessage();
        }  
    }

    //toevoegen van een (shopping)card
    public function addcard($post, array $image)
    {
        $articleName = $post['articleName'];
        $articlePrice = $post['articlePrice'];
        $articleDiscount = $post['articleDiscount'];
        $articleWeb = $post['articleWeb'];
        $articleStore = $post['articleStore'];

        try{
            if (!empty($articleName) || !empty($articlePrice) || !empty($articleStore)) {
                $cardIDresult = $this->cardModel->addCardtoDB($articleName,$articlePrice,$articleDiscount,$articleWeb, $articleStore);
                $cardID = mysqli_fetch_assoc($cardIDresult);
               
                if(!empty($cardID)){
                    if(empty($image['tmp_name'])){
                        header('Location:cards?card_added'); 
                    }else{
                        $result = $this->checkImage($image);
                        if($result == true){
                            $uploadresult = $this->uploadImage($image, $cardID);
                            if($uploadresult == true){                            
                                header('Location:cards?card_added'); 
                            }else{
                                return $uploadresult;
                            }
                        }else{
                            return $result;
                        }
                    }
                }else{
                    return "couldn't add a card to the DB.";
                }
            }else{
                return "fields are empty!";
                exit();
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }        
    } 
    
    public function checkImage(array $image){
        //Get data from image
        $fileName = basename($image['name']);
        $fileTemp = $image['tmp_name'];
        $fileSize = $image["size"];
        $fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($fileTemp);
        if($check !== false) {
            //Check if image is not bigger than 2MB
            if ($fileSize > 2097152) {
                return 'File is bigger than 2MB!';
            }  
            //Check if image has the right extension
            else if($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg') {
                return 'Please use a JPG or PNG file. Not GIF or any other type';
            }else{
                return true;
            }
        }else { //Error when file is not an image
            $error = 'File is not an image!';
            return $error;
        }
    }

    //Function to upload a image
    public function uploadImage(array $image, $imageID) 
    {
        //Set destination map
        $map = '/home/jobvewi308/domains/jvermeulen.nl/public_html/test/images/';

        //Get data from image
        $fileTemp = $image['tmp_name'];
        $fileSize = $image["size"];
        
        //This applies the function to our file
        $ext = $this->findexts($image['name']);
        $fileName = $map.$imageID['shoppingcartItem'].'.'.$ext;
        // Rotate
        // $rotate = imagerotate($fileName, $degrees, 0);
        
        //Check if image name already exists
        if (file_exists($fileName)) {
            return 'Sorry, file already exists. Try another file name';
        }     

        

        //Upload the file
        elseif(move_uploaded_file($fileTemp, $fileName)) {
            // $this->addstamp($fileName);
            $result = $this->cardModel->uploadImageUrl($imageID['shoppingcartItem'], $fileName);
            if($result->num_rows == 1){
                return true;
            }else{
                return 'image upload went wrong';
            }
        } 
        else { //Give error if uploading goes wrong
            return 'There was an error uploading your file.';
        }
    }

    public function findexts ($filename)
    {
        $filenamenew = strtolower($filename);
        $pathinfo = pathinfo($filenamenew);
        $exts = $pathinfo['extension'];
        // $exts = explode('.', $filename)[1];
        // $n = count($exts)-1;
        // $exts = $exts[$n];
        return $exts;
    }

    // public function addstamp($fileName){
    //     // Load the stamp and the photo to apply the watermark to
    //     $stamp = imagecreatefrompng('images/LogoMakr_7aSUrU.png');
    //     $image = imagecreatefrompng($fileName);

    //     // Set the margins for the stamp and get the height/width of the stamp image
    //     $marge_right = 10;
    //     $marge_bottom = 10;
    //     $sx = imagesx($stamp);
    //     $sy = imagesy($stamp);

    //     // Copy the stamp image onto our photo using the margin offsets and the photo 
    //     // width to calculate positioning of the stamp. 
    //     imagecopy($image, $stamp, imagesx($image) - $sx - $marge_right, imagesy($image) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

    // }

    public function removeCard($cardID){
        try{
            $result = $this->cardModel->removeCardFromDB($cardID);
            if($result->num_rows == 1){
                $resultPath = mysqli_fetch_assoc($result);
                if(@unlink($resultPath['shoppingcartPhoto'])){
                    return true;
                }else{
                   return false;
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }   
}
?>