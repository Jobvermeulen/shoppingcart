<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
class nsController{

    public $station_Array = array();
    public $info_station = array();

    public function fill_Station_Array(){
        $ns_api_model = new nsModel();
        $info = $ns_api_model -> getStationList();

        if($info === "Failed loading XML!"){
            throw('Failed loading XML');
            exit();
        }else{ }

        $int = 0;
        foreach($info as $name){
                $name_kort = $name->Kort;
                $name_middel = $name->Middel;
                $name_lang = $name->Lang;
                
                if ($this->excistInArray($name_kort)){
                    $this->station_Array += array_fill($int, 1, $name_kort);
                    $int ++;
                }else { }
                if($this->excistInArray($name_middel)){
                    $this->station_Array += array_fill($int, 1, $name_middel);
                    $int ++;
                }else { }
                if($this->excistInArray($name_lang)){
                    $this->station_Array += array_fill($int, 1, $name_lang);
                    $int ++;
                }else{ }            
        }            
        
        //echo $this->station_Array;
        return json_encode($this->station_Array);
        //return $this->station_Array;
    }

    //checks if the name already excists in the current array
    public function excistInArray($name){
        if(count($this->station_Array) === 0){
            return true;
        }else {
            $hitcounter = 0;
            for($row=0; $row < count($this->station_Array); $row++){
                $name_array = $this->station_Array[$row];     
                if($name == $name_array){
                    if(strlen($name) == strlen($name_array)){
                        $hitcounter++;
                    }else {  }
                }else{  }
            }
            if($hitcounter > 0){
                return false;
            }else{ return true; }
        }
    }


    public function departinfoForStation($station){
        //first get station depart info 
        //this info will return in an multidemensional array (departArray)
        $station = preg_replace('/\s+/', '%20', $station);       
        
        $ns_api_model = new nsModel();
        $departArray = $ns_api_model->getStationDepartList($station);
        

        $HTMLstring = " <table id='StationDepart'>
                            <tr>
                                <th id='TbHdRitNummer'>Rit nummer</th>
                                <th id='TbHdEindBestemming'>EindBestemming</th>
                                <th id='TbHdRouteTekst'>RouteTekst</th>
                                <th id='TbHdVertrekTijd'>VertrekTijd</th>
                                <th id='TbHdTreinSoort'>TreinSoort</th>
                                <th id='TbHdVertraging'>Vertraging</th>
                                <th id='TbHdOpmerkingen'>Opmerkingen</th>
                                <th id='TbHdReisTip'>Reis tip</th>
                                <th id='TbHdVertrekSpoor'>Vertrek spoor</th>
                            </tr>";

        // for($i=0; $i < count($departArray); $i++){
        //     $HTMLstring .= "<ul>
        //                         <li>". $departArray[$i]->RitNummer."</li>
        //                         <li>". $departArray[$i]->VertrekTijd."</li>
        //                         <li>". $departArray[$i]->TreinSoort."</li>
        //                         <li>". count($departArray)."</li>
        //                     </ul>";
        // }
        foreach($departArray as $VertrekkendeTrein){
            $HTMLstring .= "<tr>
                                <td>". $VertrekkendeTrein->RitNummer."</td>
                                <td>". $VertrekkendeTrein->EindBestemming."</td>
                                <td>". $VertrekkendeTrein->RouteTekst."</td>
                                <td>". $VertrekkendeTrein->VertrekTijd."</td>
                                <td>". $VertrekkendeTrein->TreinSoort."</td>
                                <td>". $VertrekkendeTrein->VertrekVertraging."</td>
                                <td>". $VertrekkendeTrein->Opmerkingen."</td>
                                <td>". $VertrekkendeTrein->ReisTip."</td>
                                <td>". $VertrekkendeTrein->VertrekSpoor."</td>
                            </tr>";
        }
        $HTMLstring .= "</table>";
        return $HTMLstring;
    }
}
?>