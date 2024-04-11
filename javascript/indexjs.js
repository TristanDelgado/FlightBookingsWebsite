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

function login()
{
    var doc = document.getElementById("loginform");
    doc.style.display = "block";
}

function signup()
{
    var doc = document.getElementById("loginform");
    doc.style.display = "none";
    var doc2 = document.getElementById("signupform");
    doc2.style.display = "block";
}