<?php
class salesController extends baseController{
    //Function for generating csv file with sales per day
    public function doGetSalesPerDay()
    {
        try {
            $salesModel = new salesModel();
            $result = $salesModel->getSalesFromDB();
            //Get result from database
            if($result)
            { 
                // write the first line to a file, make sure you have modified the rights of the directory to make the directory writable!!! (CHMOD)
                $file = "shoppingCart_Sales_Per_Day.csv";
                $path = "/home/jobvewi308/domains/jvermeulen.nl/public_html/test/csv/shoppingCart_Sales_Per_Day.csv";

                $csv = fopen("/home/jobvewi308/domains/jvermeulen.nl/public_html/test/csv/shoppingCart_Sales_Per_Day.csv", "w") or die("Unable to create file!");
                
                $line = "userID; username; order ID; price; status; date\n";
                fwrite($csv, $line);
                
                while($row = $result->fetch_assoc())
                {
                    $line = '';  
                    
                    $line .= $row["userID"].";";
                    $line .= $row["user_uid"].";";
                    $line .= $row["orderID"].";";
                    $line .= number_format($row["price"], 2).";";
                    $line .= $row["status"].";";
                    $line .= $row["date"].";";
                    
                    $line .= "\n";
                    fwrite($csv, $line);	
                }	
                
                fclose($csv);

                //set headers to download file rather than displayed
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$file");
                header("Content-Type: application/csv; charset=UTF-8");
                header("Content-Transfer-Encoding: binary");

                // read the file from disk
                readfile($path);
                
            }
            else 
            {
                //Exception if it did not get the volunteers
                throw new Exception('Generating csv failed!');
            }
        }
        catch (Exception $e) {
            //Get exception messages
            echo $e->getMessage();
        }
    }
    
}

