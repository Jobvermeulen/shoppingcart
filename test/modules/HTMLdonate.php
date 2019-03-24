<?php
    class HTMLdonate{
        public function returnHTML(){
            $htmlString = " <section id='overlay'>
                                <section id='donate'>
                                    <h2>Maakt u veel gebruik van de applicatie? 
                                        Doneer dan aan de ontwikkelaar.</h2>

                                        <form id='donatieForm' method='POST'>
                                            <input class='donate' type='number' min='0.00' step='0.01' name='donateVAL' placeholder='€ Donatie ' required>
                                            <button id='buttondonatie' name='buttondonatie' type='sumbit'>Doneer!</button>
                                        </form> 

                                        <a id='buttonsumbitarticle' onclick='closeDonate()'>Sluit</a>
                                </section>
                            </section>";
            return $htmlString;
        }
    }
?>