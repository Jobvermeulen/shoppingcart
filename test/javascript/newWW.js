$(document).ready(function () {
    var location = window.location.href;
    var uri = window.location.toString();
    if (uri.indexOf("?") > 0) {
        var clean_uri = uri.substring(0, uri.indexOf("?"));
        //window.history.replace(clean_uri);
        window.history.replaceState({}, document.title, clean_uri);
    }
    if(location.includes("?")){
        if(location.includes("?asswords_dont_match")){
            showAlert('De wachtwoorden zijn niet gelijk aan elkaar!', 'red');
        }else if(location.includes('?Something_went_wrong')){
            showAlert('Er ging iets niet goed! Probeert u het opnieuw', 'red');
        }else if(location.includes('?Password_changed!')){
            showAlert('Wachtwoord is aangepast!', '#6EC951');
        }
    }else{  }

    
    $("#tokenbtn").click(function () {
        var token = $("#tokenInput").val();
        if (token == '') {
            showAlert('De token moet worden ingevuld!', 'red');
        } else {
            $("#tokenHint").text("");
            // call to php script with ajax
            $.ajax({
                type: "POST",
                url: 'ajax',
                data: { functionname: 'checkToken', tokenwaarde: token },
                success: function (output) {
                    if (output== true) {
                        showAlert('De opgegeven token staat in het systeem!','#6EC951');
                        $("#newPWS").css('display', 'block');
                    } else if (output == false) {
                        showAlert('De opgegeven token staat niet in het systeem','red');
                    } else if (output.includes('error')) {
                        showAlert(output,'red');
                    }
                }
            });
        }
    });

});


function passwordCheck() {
    $ww1 = $("#wwinput_1").val();
    $ww2 = $("#wwinput_2").val();

    if ($ww1 == $ww2) {
        $("#wwinput_1").css('background-color', ' #62b92d');
        $("#wwinput_2").css('background-color', ' #62b92d');
        $('#WWbtn').removeAttr("disabled");
    } else {
        $("#wwinput_1").css('background-color', ' #ff3333');
        $("#wwinput_2").css('background-color', ' #ff3333');
        showAlert("De wachtwoorden zijn niet gelijk aan elkaar!", 'red');
    }

}

function showAlert(text, color){
    $("#alertbar").text(text);
    $('#alertbar').css('background-color', color);
    var x = document.getElementById("alertbar"); 
    x.className = "show";  
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 6000);
}