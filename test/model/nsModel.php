<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
    class nsModel{

        public $username = 'jobvermeulen@gmail.com';
        public $password = 'gf5V9WydV84UhXR2cnvH6hvy9s37QmEW0fxuQmvrv8c_5xQaEjqm5w';

        public function getStationList(){
            $api_url = 'http://webservices.ns.nl/ns-api-stations-v2';

            $context = stream_context_create(array(
                    'http' => array(
                        'header'  => "Authorization: Basic " . base64_encode("$this->username:$this->password")
                    )));
            
            $data = file_get_contents($api_url, false, $context);
            $xml= new SimpleXMLElement($data);
            
            if ($xml === false) {
                return "Failed loading XML!";                
            } else {
                $result = $xml->xpath('/Stations/Station/Namen');
                return $result;
            }
        }

        public function getStationDepartList($station){
            $api_url = 'https://webservices.ns.nl/ns-api-avt?station='.$station;

            $context = stream_context_create(array(
                    'http' => array(
                        'header'  => "Authorization: Basic " . base64_encode("$this->username:$this->password")
                    )));
                             
            $data = file_get_contents($api_url, false, $context);
            $xml= new SimpleXMLElement($data);
            
            if ($xml === false) {
                return "Failed loading XML!";                
            } else {
                $result = $xml->xpath('/ActueleVertrekTijden/VertrekkendeTrein');
                return $result;
            }     
        }
    }
?>