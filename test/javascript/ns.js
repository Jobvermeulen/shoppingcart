$(document).ready(function(){   
    getArray();

});

function getArray(){
    var stations = [];    
    
    if(isEmpty(stations)){
        try {
            var functionn = 'getStationList';
            $.ajax({
                type: "POST",
                url: 'ajax',
                data: 'functionname=' + functionn,
                success: function (output) {
                    var newrow = JSON.parse(output);
                    //var newrow = output;
                    var station;
                    $('#test').text('Stationslijst is geladen!');
                    for(var i=0; i<newrow.length; i++ ){
                        station = newrow[i];
                        stations[i] = station[0];                       
                    }                     
                    autocomplete(document.getElementById("stationsInput"), stations);
                }
            });  
        } catch (error) {
            alert(error);
        }
               
    }
}

function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}


// With help from w3schools, thank you w3schools ;-)
// the autocomplete code
function autocomplete(inp, arr) {
    var currentFocus;

    inp.addEventListener("input", function(e) {
        var autocomplete_list, matching_element, i, val = this.value;
        //vallue a,b,i are empty -- val is filled with this.value == whats been enterd
        closeAllLists();

        if (!val) { 
            return false;
        }        
        currentFocus = -1;

        //create a DIV element that will contain the items (values)
        autocomplete_list = document.createElement("Section");
        autocomplete_list.setAttribute("id", this.id + "autocomplete-list");
        autocomplete_list.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(autocomplete_list);
        $('#submit_btn').css('display', 'none');
        $('.autocomplete input').css('width', '100%');

        //for each item in the array...
        for (i = 0; i < arr.length; i++) {
          //check if the item starts with the same letters as the text field value
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

            //add the matching element to the autocomplete_list
            matching_element = document.createElement("DIV");
            matching_element.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            matching_element.innerHTML += arr[i].substr(val.length);
            //nsert a input field that will hold the current array item's value
            matching_element.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";

            /*execute a function when someone clicks on the item value (DIV element):*/
            matching_element.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
                $('#submit_btn').css('display', 'block');
                $('.autocomplete input').css('width', '90%');
            });
            autocomplete_list.appendChild(matching_element);
          }
        }
    });

    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) {
                x[currentFocus].click();
            }
          }
        }
    });

    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }

    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }

    // /*execute a function when someone clicks in the document:*/
    // document.addEventListener("click", function (e) {
    //     closeAllLists(e.target);
    // });  

    var searchBTN = document.getElementById("submit_btn");
    searchBTN.addEventListener("click", function(e){
        var station = document.getElementById("stationsInput").value;
        try {
            var functionn = 'getStationInfo';
            $.ajax({
                type: "POST",
                url: '/ajax',
                data: {functionname: functionn, station: station},
                success: function(output) {
                    if(output != 'falseInfo'){
                        pasteStationInfo(output);
                    }else{
                        alert('Something went wrong whilst ')
                    }
                    // var output1 = JSON.parse(output);
                    //append the popup to the HTML
                    // $( "#test1" ).append(output);
                }
            });  
        } catch (error) {
            alert(error);
        }
    });  
}

function pasteStationInfo(TrainStationDepartInfo){
    $( "#test1" ).append(TrainStationDepartInfo);
}
  