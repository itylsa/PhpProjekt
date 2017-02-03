window.onload = function() {
    var field = document.getElementById('registerPlz');
    if(field != null) {
        getPlaces();
    }
}

$(document).keypress(function(e) {
    if(e.keyCode == 27) {
        if(document.getElementById('errorBoxWrapper').style.display == 'block') {
            closeErrorBox()
        }
        if(document.getElementById('successBoxWrapper').style.display == 'block') {
            closeSuccessBox()
        }
        if(document.getElementById('infoBoxWrapper').style.display == 'block') {
            closeInfoBox()
        }
    }
})

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
            getPageContent();
        } else {
            showErrorBox('Email oder Passwort falsch')
        }
    } else {
        return false;
    }
}

function logout() {
    doRequest('logout', null);
    getPageContent();
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
            showSuccessBox('Benutzer erfolgreich erstellt');
        } else {
            showErrorBox('Email bereits vorhanden');
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
            showSuccessBox('Angelegt');
        } else {
            showErrorBox('Nicht angelegt');
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
            showSuccessBox('Passwort geändert');
        } else {
            showErrorBox('Passwort nicht geändert');
        }
    } else {
        return false;
    }
}

function editUser(formName) {
    var valid = validateForm(formName);
    if(valid) {
        var email = document.getElementById('editEmail').value;
        var pwd = document.getElementById('editPassword').value;
        var firstName = document.getElementById('editFirstName').value;
        var lastName = document.getElementById('editLastName').value;
        var street = document.getElementById('editStreet').value;
        var nr = document.getElementById('editNr').value;
        var place = document.getElementById('editPlace').value;
        e = document.getElementById('editPlz');
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

        var result = doRequest('edit', arguments);
        if(result) {
            showSuccessBox('Benutzerdaten erfolgreich gespeichert');
        } else {
            showErrorBox('Benutzerdaten konnten nicht gespeichert werden');
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
    closeErrorBox();
    closeSuccessBox();
    var page;
    jQuery.ajax({
        type: "POST",
        url: '../request/page.php',
        dataType: 'json',
        async: false,

        success: function(obj, textstatus) {
            page = obj;
        }
    });
    $('#content').slideToggle(300, function() {
        $(this).html(page).slideToggle(300, function() {
            $('form').find(':input').filter(':visible:first').select();
        });
    });

    var nav;
    jQuery.ajax({
        type: "POST",
        url: '../request/nav.php',
        dataType: 'json',
        async: false,

        success: function(obj, textstatus) {
            nav = obj;
        }
    });
    document.getElementById('navBar').innerHTML = nav;
    var field = document.getElementById('registerPlz');
    if(field != null) {
        getPlaces();
    }
}

function showLogin() {
    $('#registerForm').fadeOut(200);
    $('#loginForm').delay(200).fadeIn(200, function() {
        $('#loginEmail').focus();
    });
    document.getElementById('loginHead').style.backgroundColor = '#959595';
    document.getElementById('registerHead').style.backgroundColor = 'transparent';
}

function showRegister() {
    $('#loginForm').fadeOut(200);
    $('#registerForm').delay(200).fadeIn(200, function() {
        $('#registerEmail').focus();
    });
    document.getElementById('registerHead').style.backgroundColor = '#959595';
    document.getElementById('loginHead').style.backgroundColor = 'transparent';
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
    closeErrorBox();
    closeSuccessBox();
    var loginPage = document.getElementById('loginWrapper');
    var overviewPage = document.getElementById('overviewWrapper');
    var addPlacePage = document.getElementById('addPlaceWrapper');
    var forgotPasswordPage = document.getElementById('forgotPasswordWrapper');
    var userEditViewPage = document.getElementById('userEditViewWrapper');
    var notLogged = [
        loginPage,
        addPlacePage,
        forgotPasswordPage
    ]
    var logged = [
        addPlacePage,
        userEditViewPage,
        overviewPage
    ]
    if(loginPage != null) {
        for(var i = 0; i < notLogged.length; i++) {
            if(notLogged[i].style.display == 'block') {
                $('#' + notLogged[i].id).slideToggle(300);
            }
        }
    } else {
        for(var i = 0; i < logged.length; i++) {
            if(logged[i].style.display == 'block') {
                $('#' + logged[i].id).slideToggle(300);
            }
        }
    }
    if(page == 'userEditViewWrapper') {
        getUserData();
    }
    $('#' + page).delay(300).slideToggle(300, function() {
        $('form').find(':input').filter(':visible:first').select();
    });
}

function showErrorBox(message) {
    if(document.getElementById('successBoxWrapper').style.display == 'block') {
        closeSuccessBox()
    }
    if(document.getElementById('infoBoxWrapper').style.display == 'block') {
        closeInfoBox()
    }
    document.getElementById('errorBox').innerHTML = message;
    $('#errorBoxWrapper').fadeIn(500);
}

function closeErrorBox() {
    $('#errorBoxWrapper').fadeOut(500);
    $('#errorBox').delay(500, "clear").queue("clear", function(next) {
        $(this).html('');
        next();
    });
}

function showSuccessBox(message) {
    if(document.getElementById('errorBoxWrapper').style.display == 'block') {
        closeErrorBox()
    }
    if(document.getElementById('infoBoxWrapper').style.display == 'block') {
        closeInfoBox()
    }
    document.getElementById('successBox').innerHTML = message;
    $('#successBoxWrapper').fadeIn(500);
}

function closeSuccessBox() {
    $('#successBoxWrapper').fadeOut(500);
    $('#successBox').delay(500, "clear").queue("clear", function(next) {
        $(this).html('');
        next();
    });
}

function showInfoBox(message) {
    if(document.getElementById('errorBoxWrapper').style.display == 'block') {
        closeErrorBox()
    }
    if(document.getElementById('successBoxWrapper').style.display == 'block') {
        closeSuccessBox()
    }
    document.getElementById('infoBox').innerHTML = message;
    $('#infoBoxWrapper').fadeIn(500);
}

function closeInfoBox() {
    $('#infoBoxWrapper').fadeOut(500);
    $('#infoBox').delay(500, "clear").queue("clear", function(next) {
        $(this).html('');
        next();
    });
}

function showUserDeleteBox() {
    $('#userDeleteBoxWrapper').fadeIn(500);
}

function closeUserDeleteBox() {
    $('#userDeleteBoxWrapper').fadeOut(500);
    $('#userDeleteBox').delay(500, "clear").queue("clear", function(next) {
        $(this).html('');
        next();
    });
}

function deleteUser() {
    result = doRequest('deleteUser', null);
    logout();
    showSuccessBox('Benutzer erfolgreich gelöscht');
}

function checkUserExists() {
    result = doRequest('checkUserExists', null);
    alert(result);
}