function minusPassenger() 
{
    var doc = document.getElementById("numPassengers");
    var num = parseInt(doc.value);
    if(num > 1)
    {
        doc.value = num - 1;
    }
    doc.innerHTML = doc.value;
}

function plusPassenger()
{
    var doc = document.getElementById("numPassengers");
    var num = parseInt(doc.value);
    doc.value = num + 1;
    doc.innerHTML = doc.value;
}

var button;
var buttonValue;
function changeTripType()
{
    if(button == null)
    {
        button = document.getElementById("tripWay");
        buttonValue = document.getElementById("tripWayValue");
    }
    if(button.value == "Round Trip")
    {
        buttonValue.value = "One Way";
        button.innerHTML = "One Way";
    }
    else 
    {
        buttonValue.value = "Round Trip";
        button.innerHTML = "Round Trip";
    }
}



function removeWow()
{
    var tag = document.getElementById("emptySearchResultsMessage");
    tag.remove();
}

var autocomplete;
var autocomplete2;
function activatePlacesAutoComplete()
{
    var options = {types: ['airport'], fields: ['name']};
    var input = document.getElementById("from");
    autocomplete = new google.maps.places.Autocomplete(input, options);

    var input2 = document.getElementById("to");
    autocomplete2 = new google.maps.places.Autocomplete(input2, options);
}

