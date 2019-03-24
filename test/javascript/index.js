$(document).ready(function () {
    var location = window.location.href;
    var uri = window.location.toString();
    if (uri.indexOf("?") > 0) {
        var clean_uri = uri.substring(0, uri.indexOf("?"));
        //window.history.replace(clean_uri);
        window.history.replaceState({}, document.title, clean_uri);
    }
    if(location.includes("?")){
        if(location.includes("?credentials_were_undefined_in_db")){
            showAlert('De gebruikersnaam of het wachtwoord staan niet in de database!', 'red');
        }else if(location.includes()){

        }
    }else{  }
});


function signUp(){
    if(checkForEmptyFields()){
        alert(true);
    }else{
        $("#alertbar").text("Een van de velden zijn leeg!");
        $('#alertbar').css('background-color', 'red');
        var x = document.getElementById("alertbar"); 
        x.className = "show";  
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 6000);
    }
}

function checkForEmptyFields(){
    if($('#signupform #first').val()==""){
        return false;
    }else if($('#signupform #last').val()==""){
        return false;
    }else if($('#signupform #email').val()==""){
        return false;
    }else if($('#signupform #username').val()==""){
        return false;
    }else if($('#signupform #pwd').val()==""){
        return false;
    }else{
        return true;
    }
}

function showAlert(text, color){
    $("#alertbar").text(text);
    $('#alertbar').css('background-color', color);
    var x = document.getElementById("alertbar"); 
    x.className = "show";  
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 6000);
}