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
    ff = document.forms[formName].elements;
    valid = true;
    for(var i = 0; i < ff.length; i++) {
        filled = true;
        value = ff[i].value;
        if(value == null || value == '') {
            if(ff[i].hasAttribute('required')) {
                valid = false;
                filled = false;
                if(document.getElementById(ff[i].id + 'Error') != null) {
                    document.getElementById(ff[i].id + 'Error').innerHTML = 'Muss ausgefüllt sein';
                    document.getElementById(ff[i].id + 'Error').style.display = 'block';
                }
            } else {
                filled = false;
                if(document.getElementById(ff[i].id + 'Error') != null) {
                    document.getElementById(ff[i].id + 'Error').innerHTML = '';
                    document.getElementById(ff[i].id + 'Error').style.display = 'none';
                }
            }
        } else {
            minlength = ff[i].min;
            maxlength = ff[i].max;
            pattern = ff[i].pattern;
            type = ff[i].type;
            if(document.getElementById(ff[i].id + 'Error') != null) {
                document.getElementById(ff[i].id + 'Error').innerHTML = '';
                document.getElementById(ff[i].id + 'Error').style.display = 'none';
            }
            if(minlength != null && minlength != '') {
                if(value.length < minlength) {
                    valid = false;
                    if(document.getElementById(ff[i].id + 'Error') != null) {
                        innerHTML = document.getElementById(ff[i].id + 'Error').innerHTML;
                        if(innerHTML != null && innerHTML != '') {
                            innerHTML = innerHTML + '<br>';
                        } else {
                            innerHTML = '';
                        }
                        document.getElementById(ff[i].id + 'Error').innerHTML = innerHTML + 'Muss mindestens ' + minlength + ' Zeichen lang sein';
                        document.getElementById(ff[i].id + 'Error').style.display = 'block';
                    }
                }
            }
            if(maxlength != null && maxlength != '') {
                if(value.length > maxlength) {
                    valid = false;
                    if(document.getElementById(ff[i].id + 'Error') != null) {
                        innerHTML = document.getElementById(ff[i].id + 'Error').innerHTML;
                        if(innerHTML != null && innerHTML != '') {
                            innerHTML = innerHTML + '<br>';
                        } else {
                            innerHTML = '';
                        }
                        document.getElementById(ff[i].id + 'Error').innerHTML = innerHTML + 'dark maximal ' + maxlength + ' Zeichen lang sein';
                        document.getElementById(ff[i].id + 'Error').style.display = 'block';
                    }
                }
            }
            if(pattern != null && pattern != '') {
                if(value.match(pattern) == null) {
                    valid = false;
                    if(document.getElementById(ff[i].id + 'Error') != null) {
                        innerHTML = document.getElementById(ff[i].id + 'Error').innerHTML;
                        if(innerHTML != null && innerHTML != '') {
                            innerHTML = innerHTML + '<br>';
                        } else {
                            innerHTML = '';
                        }
                        document.getElementById(ff[i].id + 'Error').innerHTML = innerHTML + 'Muss der Regular Expression ' + pattern + ' entsprechen';
                        document.getElementById(ff[i].id + 'Error').style.display = 'block';
                    }
                }
            }
            if(type != null && type != '') {
                if(type == 'email') {
                    regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    if(value.match(regex) == null) {
                        valid = false;
                        if(document.getElementById(ff[i].id + 'Error') != null) {
                            innerHTML = document.getElementById(ff[i].id + 'Error').innerHTML;
                            if(innerHTML != null && innerHTML != '') {
                                innerHTML = innerHTML + '<br>';
                            } else {
                                innerHTML = '';
                            }
                            document.getElementById(ff[i].id + 'Error').innerHTML = innerHTML + 'Muss eine Email sein';
                            document.getElementById(ff[i].id + 'Error').style.display = 'block';
                        }
                    }
                }
            }
        }


    }
    if(valid) {
        for(var i = 0; i < ff.length; i++) {
            if(document.getElementById(ff[i].id + 'Error') != null) {
                document.getElementById(ff[i].id + 'Error').innerHTML = '';
                document.getElementById(ff[i].id + 'Error').style.display = 'none';
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
        if(result) {
            document.getElementById('errorBox').value = '';
            document.getElementById('errorBox').style.display = 'none';
            getPageContent();
        } else {
            document.getElementById('errorBox').innerHTML = 'Email und/oder Passwort falsch';
            document.getElementById('errorBox').style.display = 'block';
        }
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
        alert(result);
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

function forgotPassword(formName) {
    var valid = validateForm(formName);
    if(valid) {
        var email = document.getElementById('forgotPasswordEmail').value;
        var pwd = document.getElementById('forgotPasswordPwd').value;
        arguments = {
            email: email,
            pwd: pwd
        }
        var result = doRequest('forgotPassword', arguments);
        if(result) {
            alert('Passwort geändert');
        } else {
            alert('Passwort nicht geändert');
        }
    } else {
        return false;
    }
}

function editUser(formName) {
    var valid = validateForm(formName);
    if(valid) {
        var email = document.getElementById('forgotPasswordEmail').value;
        var pwd = document.getElementById('forgotPasswordPwd').value;
        arguments = {
            email: email,
            pwd: pwd
        }
        var result = doRequest('forgotPassword', arguments);
        if(result) {
            alert('Passwort geändert');
        } else {
            alert('Passwort nicht geändert');
        }
    } else {
        return false;
    }
}

function getUserData() {
    var result = doRequest('getPlaces', null);
    var select = document.getElementById('editPlz');
    for(var i = 0; i < result.length; i++) {
        opt = document.createElement('option');
        opt.value = result[i][2];
        opt.textContent = result[i][1];
        select.appendChild(opt);
    }
    user = doRequest('loadUser', null);
    placeId = user[4];
    plz = '';
    place = '';
    if(placeId != null && placeId != '') {
        arguments = {
            placeId: placeId
        }
        pp = doRequest('loadPlace', arguments);
        plz = pp[0];
        place = pp[1];
    }
    streetNr = user[5];
    streetNr = streetNr.split(" ");
    document.getElementById('editEmail').value = user[1];
    document.getElementById('editPassword').value = user[6];
    document.getElementById('editFirstName').value = user[3];
    document.getElementById('editLastName').value = user[2];
    document.getElementById('editStreet').value = streetNr[0];
    document.getElementById('editNr').value = streetNr[1];
    document.getElementById('editPlz').value = plz;
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
    var forgotPasswordPage = document.getElementById('forgotPasswordWrapper');
    var userEditViewPage = document.getElementById('userEditViewWrapper');
    if(loginPage != null) {
        loginPage.style.display = 'none';
        addPlacePage.style.display = 'none';
        forgotPasswordPage.style.display = 'none';
    } else {
        overviewPage.style.display = 'none';
        addPlacePage.style.display = 'none';
        userEditViewPage.style.display = 'none';
    }
    if(page == 'userEditViewWrapper') {
        getUserData();
    }
    document.getElementById(page).style.display = 'block';
}