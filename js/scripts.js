window.onload = function() {
    getPageContent();
    var field = document.getElementById('registerPlz');
    if(field != null) {
        getPlaces();
    }
}

$(document).ready(function() {
    $(document).keypress(function(e) {
        if(e.keyCode == 27) {
            closeAllBoxes();
            closeMenuIfOpen();
        }
        if(e.keyCode == 113) {
            toggleMenu();
            $('#menuButton').toggleClass('rotate');
            $('#menuButton').toggleClass('rotate-reset');
        }
    });
    $('#menuButton').click(function(event) {
        toggleMenu();
        $(this).toggleClass('rotate');
        $(this).toggleClass('rotate-reset');
        event.stopPropagation();
    });
    $('html').click(function() {
        closeMenuIfOpen();
    });
    $('#pageBlocker').click(function() {
        closeImgPreviewBox();
    })
    $('#imgPreviewBoxWrapper').click(function() {
        closeImgPreviewBox();
    })
    $('#navBar').click(function(event) {
        event.stopPropagation();
    });
});
function closeAllBoxes() {
    if(document.getElementById('errorBoxWrapper').style.display == 'block') {
        closeErrorBox();
    }
    if(document.getElementById('successBoxWrapper').style.display == 'block') {
        closeSuccessBox();
    }
    if(document.getElementById('infoBoxWrapper').style.display == 'block') {
        closeInfoBox();
    }
    if(document.getElementById('newPlaceBoxWrapper').style.display == 'block') {
        closeNewPlaceBox();
    }
    if(document.getElementById('userDeleteBoxWrapper') != null && document.getElementById('userDeleteBoxWrapper').style.display == 'block') {
        closeUserDeleteBox();
    }
    if(document.getElementById('imgPreviewBoxWrapper') != null && document.getElementById('imgPreviewBoxWrapper').style.display == 'block') {
        closeImgPreviewBox();
    }
}

function closeMenuIfOpen() {
    if($('#menuButton').hasClass('rotate-reset')) {
        toggleMenu();
        $('#menuButton').toggleClass('rotate');
        $('#menuButton').toggleClass('rotate-reset');
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
                    document.getElementById(ff[i].id + 'Error').innerHTML = 'Muss ausgefüllt sein.';
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
            message = ff[i].title;
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
                        document.getElementById(ff[i].id + 'Error').innerHTML = innerHTML + 'Muss mindestens ' + minlength + ' Zeichen lang sein.';
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
                        document.getElementById(ff[i].id + 'Error').innerHTML = innerHTML + 'Darf maximal ' + maxlength + ' Zeichen lang sein.';
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
                        document.getElementById(ff[i].id + 'Error').innerHTML = innerHTML + message;
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
                            document.getElementById(ff[i].id + 'Error').innerHTML = innerHTML + 'Muss eine Email sein.';
                            document.getElementById(ff[i].id + 'Error').style.display = 'block';
                        }
                    }
                }
            }
        }
        if(ff[i].id == 'registerPlz') {
            if(ff[i].value == '') {
                if($('#registerPlace').val() != '') {
                    valid = false;
                    innerHTML = $('#registerPlzError').html();
                    if(innerHTML != null && innerHTML != '') {
                        innerHTML = innerHTML + '<br>';
                    } else {
                        innerHTML = '';
                    }
                    $('#registerPlzError').html(innerHTML + 'Wenn Ort ausgefüllt ist muss auch die Plz ausgefüllt werden.');
                    $('#registerPlzError').css('display', 'block');
                }
            }
        }
        if(ff[i].id == 'registerPlace') {
            if(ff[i].value == '') {
                if($('#registerPlz').val() != '') {
                    valid = false;
                    innerHTML = $('#registerPlaceError').html();
                    if(innerHTML != null && innerHTML != '') {
                        innerHTML = innerHTML + '<br>';
                    } else {
                        innerHTML = '';
                    }
                    $('#registerPlaceError').html(innerHTML + 'Wenn Plz ausgefüllt ist muss auch der Ort ausgefüllt werden.');
                    $('#registerPlaceError').css('display', 'block');
                }
            }
        }
        if(ff[i].id == 'editPlz') {
            if(ff[i].value == '') {
                if($('#editPlace').val() != '') {
                    valid = false;
                    innerHTML = $('#editPlzError').html();
                    if(innerHTML != null && innerHTML != '') {
                        innerHTML = innerHTML + '<br>';
                    } else {
                        innerHTML = '';
                    }
                    $('#editPlzError').html(innerHTML + 'Wenn Ort ausgefüllt ist muss auch die Plz ausgefüllt werden.');
                    $('#editPlzError').css('display', 'block');
                }
            }
        }
        if(ff[i].id == 'editPlace') {
            if(ff[i].value == '') {
                if($('#editPlz').val() != '') {
                    valid = false;
                    innerHTML = $('#editPlaceError').html();
                    if(innerHTML != null && innerHTML != '') {
                        innerHTML = innerHTML + '<br>';
                    } else {
                        innerHTML = '';
                    }
                    $('#editPlaceError').html(innerHTML + 'Wenn Plz ausgefüllt ist muss auch der Ort ausgefüllt werden');
                    $('#editPlaceError').css('display', 'block');
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
            getLoggedStatus();
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
    getLoggedStatus();
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
        var plz = document.getElementById('registerPlz').value;
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
        var plz = document.getElementById('editPlz').value;
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


function createAnnonce(formName) {
    alert('create function');
    return false;
}

function getUserData() {
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
    document.getElementById('editPlace').value = place;
    document.getElementById('editPlz').value = plz;
}

function getPlaces() {
    var result = doRequest('getPlaces', null);
    var select = document.getElementById('registerPlz');
    select.options.length = 0;
    opt = document.createElement('option');
    opt.value = '';
    opt.textContent = '';
    select.appendChild(opt);
    for(var i = 0; i < result.length; i++) {
        opt = document.createElement('option');
        opt.value = result[i][2];
        opt.textContent = result[i][1];
        select.appendChild(opt);
    }
}

function getPageContent() {
    closeAllBoxes();
    if(checkUserLogged() != 'doesntExist') {
        if($('#menuButton').hasClass('rotate-reset')) {
            toggleMenu();
            $('#menuButton').toggleClass('rotate');
            $('#menuButton').toggleClass('rotate-reset');
        }
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
                var registerPlz = document.getElementById('registerPlz');
                if(registerPlz != null) {
                    fillPlzPlaceList('register');
                }
                var overview = document.getElementById('overviewWrapper');
                if(overview != null) {
                    getAnnonces();
                    fillPlzPlaceList('edit');
                }
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
    }
    getLoggedStatus();
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
    var e
    if(val.id == 'registerPlz') {
        document.getElementById('registerPlace').value = val.value;
        e = document.getElementById('registerPlz');
    } else {
        document.getElementById('editPlace').value = val.value;
        e = document.getElementById('editPlz');
    }
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
    closeAllBoxes();
    if(checkUserLogged() != 'doesntExist') {
        var loginPage = document.getElementById('loginWrapper');
        var overviewPage = document.getElementById('overviewWrapper');
        var createAnnoncePage = document.getElementById('createAnnonceWrapper');
        var forgotPasswordPage = document.getElementById('forgotPasswordWrapper');
        var userEditViewPage = document.getElementById('userEditViewWrapper');
        var notLogged = [
            loginPage,
            forgotPasswordPage
        ]
        var logged = [
            userEditViewPage,
            createAnnoncePage,
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
            fillPlzPlaceList('edit');
        }
        if(page == 'loginWrapper') {
            fillPlzPlaceList('register');
        }
        $('#' + page).delay(300).slideToggle(300, function() {
            $('form').find(':input').filter(':visible:first').select();
        });
    }
    getLoggedStatus();
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
    $('#userDeleteBoxWrapper').fadeIn(500, function() {
        $(this).css('display', 'block');
    });
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

function toggleMenu() {
    $('#navBar').stop();
    $('#nav').stop();
    $('#menuButton').stop();
    if($('#navBar').hasClass('menuOpened')) {
        $('#navBar').removeClass('menuOpened');
        $('#navBar').addClass('menuClosed');
        $('#navBar').animate({left: '-150px'}, 300);
        $('#nav').animate({left: '-150px'}, 300);
        $('#menuButton').removeClass('rotate');
        $('#menuButton').addClass('rotate-reset');
    } else {
        $('#navBar').removeClass('menuClosed');
        $('#navBar').addClass('menuOpened');
        $('#navBar').animate({left: '0px'}, 300);
        $('#nav').animate({left: '0px'}, 300);
        $('#menuButton').addClass('rotate');
        $('#menuButton').removeClass('rotate-reset');
    }
}

function getAnnonces() {
    var data = doRequest('getAnnonces', null);
    var pageContent = '';
    if(data.length > 0) {
        pageContent = '<h1>Annoncen</h1>';
        pageContent = pageContent + '<table rules="all" frame="void" id="annonceTable">';
        pageContent = pageContent + '<tr><th>Kategorie</th><th>Beschreibung</th></tr>';
        for(var i = 0; i < data.length; i++) {
            pageContent = pageContent + '<tr><td>asd</td><td style="float: none;">asd asd11111</td><td style="float: none;"><input style="margin: auto" type="button" value="Details"</td></tr>';
        }
        pageContent = pageContent + '</table>';
    } else {
        pageContent = '<h1>Keine Annoncen gefunden</h1>';
    }
    document.getElementById('overviewWrapper').innerHTML = pageContent;
}

function getLoggedStatus() {
    var status = checkUserLogged();
    if(status == 'logged') {
        var userName = doRequest('getUsername', null);
        $('#loggedInfo').html('Logged in as ' + userName[3]);
        $('#loggedInfo').css('color', 'blue');
    } else {
        $('#loggedInfo').html('Not logged in');
        $('#loggedInfo').css('color', 'red');
    }
}

function checkUserLogged() {
    var status = doRequest('checkUserLogged', null);
    if(status == 'doesntExist') {
        logout();
        return 'doesntExist';
    } else if(status == 'logged') {
        return 'logged';
    } else {
        return 'notLogged';
    }
}

function fillPlzPlaceList(list) {
    arguments = {
        plz: '',
        place: ''
    }
    plz = doRequest('getAllPlz', arguments);
    place = doRequest('getAllPlaces', arguments);
    $('#' + list + 'PlzList').empty();
    $('#' + list + 'PlaceList').empty();
    for(var i = 0; i < plz.length; i++) {
        opt = document.createElement('option');
        opt.value = plz[i][0];
        opt.textContent = plz[i][0];
        $('#' + list + 'PlzList').append(opt);
    }
    for(var i = 0; i < place.length; i++) {
        opt = document.createElement('option');
        opt.value = place[i][0];
        opt.textContent = place[i][0];
        $('#' + list + 'PlaceList').append(opt);
    }
}

function updatePlzList(list) {
    val = $('#' + list + 'Place').val();
    arguments = {
        place: val
    }
    plz = doRequest('getAllPlz', arguments);
    $('#' + list + 'PlzList').empty();
    for(var i = 0; i < plz.length; i++) {
        opt = document.createElement('option');
        opt.value = plz[i][0];
        opt.textContent = plz[i][0];
        $('#' + list + 'PlzList').append(opt);
    }
}

function updatePlaceList(list) {
    val = $('#' + list + 'Plz').val();
    arguments = {
        plz: val
    }
    place = doRequest('getAllPlaces', arguments);
    $('#' + list + 'PlaceList').empty();
    for(var i = 0; i < place.length; i++) {
        opt = document.createElement('option');
        opt.value = place[i][0];
        opt.textContent = place[i][0];
        $('#' + list + 'PlaceList').append(opt);
    }
}

function getFiles() {
    fileList = document.getElementById('createFile').files;
    $('#fileList').empty();
    for(var i = 0; i < fileList.length; i++) {
        var picture = URL.createObjectURL(fileList[i]);
        var d = document.createElement('div');
        d.className = "previewImgWrapper";
        d.onclick = function() {
            showImagePreview(this);
            return false;
        };
        d.id = (i + 1);
        var b = document.createElement('input');
        b.onclick = function() {
            return false;
        };
        b.className = "previewImg";
        b.id = "img" + (i + 1);
        b.src = picture;
        b.type = "image";
        $('#fileList').append(d);
        d.appendChild(b);
    }
}

function showImagePreview(div) {
    img = $('#img' + div.id).prop('src');
    $('#imgPreviewBox').css('max-width', (screen.width - 100));
    $('#imgPreviewBox').css('max-height', (screen.width - 100));
    $('#imgPreviewBox').prop('src', img);
    $('#imgPreviewBoxWrapper').fadeIn(500);
    $('#pageBlocker').fadeIn(500);
}

function closeImgPreviewBox() {
    if(document.getElementById('imgPreviewBoxWrapper').style.display == 'block') {
        $('#imgPreviewBoxWrapper').fadeOut(500);
        $('#pageBlocker').fadeOut(500);
    }
}