$(document).ready(function () {
    var location = window.location.href;
    var uri = window.location.toString();
    if (uri.indexOf("?") > 0) {
        var clean_uri = uri.substring(0, uri.indexOf("?"));
        //window.history.replace(clean_uri);
        window.history.replaceState({}, document.title, clean_uri);
    }
    if(location.includes("?")){
        if(location.includes("?card_added")){
            showAlert('Kaart is toegevoegd!', '#6EC951');
        }else if(location.includes()){

        }
    }else{  }
    
});

function removeCard(cardID){
    var functionn = 'alertbox';
    $.ajax({
        type: "POST",
        url: '/ajax',
        data: { functionname: functionn},
        success: function (output) {
            if(output){
                $( "#page" ).append(output);
                listener(cardID);

            }else{
                alert('something went wrong. Please try again.');
            }
        }   
    });  

    
}

function listener(cardID){
    var addButton = document.getElementById('jaBTN');
    addButton.addEventListener('click', function(e){
        $(this).off('click');            
        var functionn = 'removeCard';
        $.ajax({
            type: "POST",
            url: '/ajax',
            data: { functionname: functionn, cardID: cardID },
            success: function (output) {
                location.reload(); 
            }   
        });   
    });
    //for the closeButton
    var closeButton = document.getElementById('neeBTN');
    closeButton.addEventListener('click', function(e){
        $(this).off('click');
        closeDonate();
    });
}

function closeDonate(){
    $("#overlay").remove();
}

function openDonate(){
    var functionn = 'getDonateHTML';
    $.ajax({
        type: "POST",
        url: '/ajax',
        data: { functionname: functionn},
        success: function (output) {
            if(output){
                $( "#page" ).append(output);
            }else{
                alert('something went wrong. Please try again.');
            }
        }   
    });  
}