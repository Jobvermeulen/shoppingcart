$(document).ready(function () {

    $("#emailbtn").click(function(){
        var emailwwaarde = $("#emailinput").val();
        if(validateEmail(emailwwaarde)){
            $("#wwHint").text("Juist email adres!");
            GoToNext();
        }
        else{
            $("#wwHint").text("Email adres is niet juist!");
        }
    });
    
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    
    function GoToNext(){
        $('.form-wwvergeten .wrapper').addClass('move');
        $("body").css('background-color',' #abe289');
        $(".form-wwvergeten .wrapper .top-WWVergetenForm-username button").removeClass('active');
        $(this).addClass('active');
    };
    
    $(".form-wwvergeten .wrapper .top-WWVergetenForm-username button").click(function(){
        $('.form-wwvergeten .wrapper').removeClass('move');
        $("body").css('background-color','#b4d7fb');
        $(".form-wwvergeten .wrapper .top-wwvergetenForm-email button").removeClass('active');
        $(this).addClass('active');
    });
    
});


// function wwVergeten() {
//     var email = document.forms["WWVergetenForm"]["email"].value;
//     if (email.length == 0) {
//         document.getElementById("wwHint").innerHTML = "Er is nog geen e-mailadres ingevuld!";
//     }
// }

