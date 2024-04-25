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

function exitForms()
{
    var doc = document.getElementById("loginform");
    doc.style.display = "none";
    var doc2 = document.getElementById("signupform");
    doc2.style.display = "none";
    
}