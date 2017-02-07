<div id="loginWrapper" style="display: block;">
    <div id="loginInnerWrapper">
        <h1>Loginseite</h1>
        <div id="loginHeaderWrapper">
            <h2 id="loginHead" onclick="showLogin()">Einloggen</h2>
            <h2 id="registerHead" onclick="showRegister()">Registrieren</h2>
        </div>
        <div id="loginFormWrapper">
            <form onsubmit="login('loginForm');event.preventDefault()" novalidate id="loginForm" method="POST">
                <table>
                    <tr>
                        <td>Email:</td><td><input id="loginEmail" title="ErrorMessage Placeholder" type="email" name="loginEmail" required /></td>
                    </tr>
                    <tr><td></td><td><div class="errorMessage" id="loginEmailError"></div></td></tr>
                    <tr>
                        <td>Passwort:</td><td><input id="loginPassword" title="ErrorMessage Placeholder" type="password" name="loginPassword" min="4" required="" /><br></td>
                    </tr>
                    <tr><td></td><td><div class="errorMessage" id="loginPasswordError"></div></td></tr>
                    <tr>
                        <td colspan="1"><input type="submit" value="Login" /></td>
                        <td colspan="2"><input type="button" value="Passwort vergessen" onclick="showPage('forgotPasswordWrapper')" /></td>
                    </tr>
                </table>
            </form>
            <form onsubmit="register('registerForm'); event.preventDefault()" novalidate id="registerForm" method="POST">
                <table>
                    <tr>
                        <td>Email:</td><td colspan="3"><input id="registerEmail" title="Muss eine valide Email sein" type="email" name="email" size="50" required /></td>
                    </tr>
                    <tr><td></td><td colspan="3"><div class="errorMessage" id="registerEmailError"></div></td></tr>
                    <tr>
                        <td>Kennwort:</td><td colspan="3"><input id="registerPassword" title="Passwort sollte sicher sein" type="password" name="password" size="50" min="4" max="20" required  /></td>
                    </tr>
                    <tr><td></td><td colspan="3"><div class="errorMessage" id="registerPasswordError"></div></td></tr>
                    <tr>
                        <td>Vorname:</td><td colspan="3"><input id="registerFirstName" title="Nur Buchstaben. Groß anfangen" type="text" name="vorname" min="2" max="20" pattern="^[A-Z][a-z]+$" size="50" required /></td>
                    </tr>
                    <tr><td></td><td colspan="3"><div class="errorMessage" id="registerFirstNameError"></div></td></tr>
                    <tr>
                        <td>Nachname:</td><td colspan="3"><input id="registerLastName" title="Nur Buchstaben. Groß anfangen" type="text" name="nachname" max="20" pattern="^[A-Z][a-z]+$" size="50" /></td>
                    </tr>
                    <tr><td></td><td colspan="3"><div class="errorMessage" id="registerLastNameError"></div></td></tr>
                    <tr>
                        <td>Straße:</td><td><input id="registerStreet" type="text" title="Nur Buchstaben. Groß anfangen" name="strasse" max="50" pattern="^[A-Z][a-z]+$" /></td>
                        <td>Nr:</td><td><input id="registerNr" type="text" name="hausnummer" title="Nur Zahlen" max="4" pattern="^[0-9]+$" title="Zahlen, 1-4" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><div class="errorMessage" id="registerStreetError"></div></td>
                        <td></td>
                        <td><div class="errorMessage" id="registerNrError"></div></td>
                    </tr>
                    <tr>
                        <td>Ort:</td><td><input id="registerPlace" readonly="true" type="text" name="ort" class="deactivated" /></td>
                        <td>Plz:</td>
                        <td>
                            <select id="registerPlz" onchange="selectPlz(this)">
                                <option value=""></option>
                            </select>
                            <input id="plzHidden" type="hidden" name="plz" />
                        </td>
                    </tr>
                    <tr>
                        <td>Plz:</td><td><input list="list" id="registerPlzNew" type="text" autocomplete="off" /></td>
                        <td>Ort:</td><td><input id="ort" readonly="true" type="text" name="" class="deactivated" /></td>
                    <datalist id="list"></datalist>
                    </tr>
                    <tr>
                        <td></td>
                        <td><div class="errorMessage" id="registerPlzNewError"></div></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <input style="float: right;" type="submit" value="Erstellen" />
            </form>
        </div>
    </div>
</div>