<div id="loginWrapper">
    <div id="loginInnerWrapper">
        <h1>Loginseite</h1>
        <div id="loginHeaderWrapper">
            <h2 id="loginHead" onclick="showLogin()">Einloggen</h2>
            <h2 id="registerHead" onclick="showRegister()">Registrieren</h2>
        </div>
        <div id="loginFormWrapper">
            <form id="loginForm" method="POST">
                <table>
                    <tr>
                        <td>Email:</td><td><input id="loginEmail" type="email" name="loginEmail" required /></td>
                    </tr>
                    <tr><td colspan="2"><div class="errorMessage" id="loginEmailError"></div></td></tr>
                    <tr>
                        <td>Passwort:</td><td><input id="loginPassword" type="password" name="loginPassword" min="4" required="" /><br></td>
                    </tr>
                    <tr><td colspan="2"><div class="errorMessage" id="loginPasswordError"></div></td></tr>
                    <tr>
                        <td colspan="1"><input type="button" value="Login" onclick="login('loginForm')" /></td>
                        <td colspan="2"><input type="button" value="Passwort vergessen" onclick="showPage('forgotPasswordWrapper')" /></td>
                    </tr>
                </table>
            </form>
            <form id="registerForm" method="POST">
                <table>
                    <tr>
                        <td>Email:</td><td colspan="3"><input id="registerEmail" type="email" name="email" size="50" required /></td>
                    </tr>
                    <tr><td colspan="4"><div class="errorMessage" id="registerEmailError"></div></td></tr>
                    <tr>
                        <td>Kennwort:</td><td colspan="3"><input id="registerPassword" type="password" name="password" size="50" min="4" required  /></td>
                    </tr>
                    <tr><td colspan="4"><div class="errorMessage" id="registerPasswordError"></div></td></tr>
                    <tr>
                        <td>Vorname:</td><td colspan="3"><input id="registerFirstName" type="text" name="vorname" pattern="[a-zA-Z]{1,20}" title="Buchstaben, 1-20" size="50" required /></td>
                    </tr>
                    <tr><td colspan="4"><div class="errorMessage" id="registerFirstNameError"></div></td></tr>
                    <tr>
                        <td>Nachname:</td><td colspan="3"><input id="registerLastName" type="text" name="nachname" pattern="[a-zA-Z]{1,20}" title="Buchstaben, 1-20" size="50" /></td>
                    </tr>
                    <tr><td colspan="4"><div class="errorMessage" id="registerLastNameError"></div></td></tr>
                    <tr>
                        <td>Straße:</td><td><input id="registerStreet" type="text" name="strasse" pattern="[a-zA-Z]{1,40}" title="Buchstaben, 1-40" /></td>
                        <td>Nr:</td><td><input id="registerNr" type="text" name="hausnummer" pattern="[0-9]{1,4}" title="Zahlen, 1-4" /></td>
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
                </table>
                <input style="float: right;" type="button" onclick="register('registerForm')" value="Erstellen" />
            </form>
        </div>
    </div>
</div>