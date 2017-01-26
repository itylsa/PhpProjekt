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

function login() {
    var email = document.getElementById('loginEmail').value;
    var pw = document.getElementById('loginPassword').value;

    arguments = {
        email: email,
        pw: pw
    };
    var result = doRequest('login', arguments);
    if(result == true) {
        alert('Login erfolgreich');
    } else {
        alert('Login fehlgeschlagen');
    }
}

function register() {
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
}

function getPlaces() {
    alert('doing');
    var result = doRequest('getPlaces', null);

    for(var r in result) {
        alert(result);
        var select = document.getElementById('registerPlz');
        opt = document.createElement('option');
        opt.value = r['ortName'];
        opt.textContent = r['plz'];
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
    return result;
}