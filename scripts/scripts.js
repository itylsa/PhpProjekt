window.onload = function() {
    var field = document.getElementById('registerPlz');
    if(field != null) {
        getPlaces();
    }
}

function doRequest(functionname, arguments) {
    var result;
    jQuery.ajax({
        type: "POST",
        url: '../request/request.php',
        dataType: 'json',
        async: false,
        data: {functionname: functionname, arguments: arguments},

        success: function(obj, textstatus) {
            result = obj;
        }
    });
    return result;
}

function validateForm(formName) {
    valid = true;
    formFields = document.forms[formName].elements;
    for(var i = 0; i < formFields.length; i++) {
        if(formFields[i].value == null || formFields[i].value == '') {
            valid = false;
            if(document.getElementById(formFields[i].id + 'Error') != null) {
                document.getElementById(formFields[i].id + 'Error').innerHTML = 'Muss ausgefüllt sein asd asd asd asd asd asd asd asd asd asdas ';
                document.getElementById(formFields[i].id + 'Error').style.display = 'block';
            }
        } else {

        }
    }


    if(valid) {
        for(var i = 0; i < formFields.length; i++) {
            if(document.getElementById(formFields[i].id + 'Error') != null) {
                document.getElementById(formFields[i].id + 'Error').innerHTML = '';
                document.getElementById(formFields[i].id + 'Error').style.display = 'none';
            }
        }
    }
    return valid;
}

function login(formName) {
    var valid = validateForm(formName);
    if(valid) {
        var email = document.getElementById('loginEmail').value;
        var pw = document.getElementById('loginPassword').value;

        arguments = {
            email: email,
            pw: pw
        };
        var result = doRequest('login', arguments);
        getPageContent();
    } else {
        return false;
    }
}

function register(formName) {
    var valid = validateForm(formName);
    if(valid) {
        var email = document.getElementById('registerEmail').value;
        var pwd = document.getElementById('registerPassword').value;
        var firstName = document.getElementById('registerFirstName').value;
        var lastName = document.getElementById('registerLastName').value;
        var street = document.getElementById('registerStreet').value;
        var nr = document.getElementById('registerNr').value;
        var place = document.getElementById('registerPlace').value;
        e = document.getElementById('registerPlz');
        var plz = e.options[e.selectedIndex].text;

        street = street + ' ' + nr;
        arguments = {
            email: email,
            pwd: pwd,
            firstName: firstName,
            lastName: lastName,
            street: street,
            place: place,
            plz: plz
        }

        var result = doRequest('create', arguments);
        if(result) {
            alert('Benutzer erfolgreich erstellt');
        } else {
            alert('Benutzer konnte nicht erstellt werden');
        }
    } else {
        return false;
    }
}

function addPlace(formName) {
    var valid = validateForm(formName);
    if(valid) {
        var plz = document.getElementById('plz').value;
        var place = document.getElementById('place').value;
        arguments = {
            plz: plz,
            place: place
        }
        var result = doRequest('addPlace', arguments);
        if(result) {
            alert('Angelegt');
        } else {
            alert('Nicht angelegt');
        }
    } else {
        return false;
    }
}

function getPlaces() {
    var result = doRequest('getPlaces', null);
    var select = document.getElementById('registerPlz');
    for(var i = 0; i < result.length; i++) {
        opt = document.createElement('option');
        opt.value = result[i][2];
        opt.textContent = result[i][1];
        select.appendChild(opt);
    }
}

function getPageContent() {
    var result;
    jQuery.ajax({
        type: "POST",
        url: '../request/page.php',
        dataType: 'json',
        async: false,

        success: function(obj, textstatus) {
            result = obj;
        }
    });
    document.getElementById('content').innerHTML = result;

    var result;
    jQuery.ajax({
        type: "POST",
        url: '../request/nav.php',
        dataType: 'json',
        async: false,

        success: function(obj, textstatus) {
            result = obj;
        }
    });
    document.getElementById('navBar').innerHTML = result;
    var field = document.getElementById('registerPlz');
    if(field != null) {
        getPlaces();
    }
}

function showLogin() {
    $('#loginForm').css({opacity: 0.0, display: "block"}).animate({opacity: 1.0});
    $('#registerForm').css({opacity: 1.0, display: "none"}).animate({opacity: 0.0});
    document.getElementById('loginHead').style.backgroundColor = 'lightgrey';
    document.getElementById('registerHead').style.backgroundColor = 'transparent';
    document.getElementById('loginEmail').focus();
}

function showRegister() {
    $('#registerForm').css({opacity: 0.0, display: "block"}).animate({opacity: 1.0});
    $('#loginForm').css({opacity: 1.0, display: "none"}).animate({opacity: 0.0});
    document.getElementById('registerHead').style.backgroundColor = 'lightgrey';
    document.getElementById('loginHead').style.backgroundColor = 'transparent';
    document.getElementById('registerEmail').focus();
}

function selectPlz(val) {
    document.getElementById('registerPlace').value = val.value;
    var e = document.getElementById('registerPlz');
    document.getElementById('plzHidden').value = e.options[e.selectedIndex].text;
}

var menuOpened = false;
function menu() {
    if(menuOpened) {
        document.getElementById('navList').style.display = 'none';
        menuOpened = false;
    } else {
        document.getElementById('navList').style.display = 'block';
        menuOpened = true;
    }
}

function showPage(page) {
    var loginPage = document.getElementById('loginWrapper');
    var overviewPage = document.getElementById('overviewWrapper');
    var addPlacePage = document.getElementById('addPlaceWrapper');
    var userEditViewPage = document.getElementById('userEditViewWrapper');
    if(loginPage != null) {
        loginPage.style.display = 'none';
        addPlacePage.style.display = 'none';
    } else {
        overviewPage.style.display = 'none';
        addPlacePage.style.display = 'none';
        userEditViewPage.style.display = 'none';
    }
    document.getElementById(page).style.display = 'block';
}