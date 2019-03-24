<?php
    class alertbox{
        public function returnHTML(){
            $htmlString = " <section id='overlay'>
                                <section id='alertbox'>
                                    <h2>Weet u zeker dat u dit kaartje wilt verwijderen?</h2>
                                    <button id='jaBTN' >Ja</button>
                                    <button id='neeBTN' >Nee</button>
                                </section>
                            </section>";
            return $htmlString;
        }
    }
?>