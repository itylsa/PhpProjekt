<div id="loginWrapper">
    <div id="loginInnerWrapper">
        <h1>Loginseite</h1>
        <div id="loginHeaderWrapper">
            <h2 id="loginHead" onclick="showLogin()">Einloggen</h2>
            <h2 id="registerHead" onclick="showRegister()">Registrieren</h2>
        </div>
        <form id="loginForm" method="POST">
            <table>
                <tr>
                    <td>Email:</td><td><input id="loginEmail" type="email" name="loginEmail" required /><br></td>
                </tr>
                <tr>
                    <td>Passwort:</td><td><input id="loginPassword" type="password" name="loginPassword" required /><br></td>
                </tr>
                <tr>
                    <td colspan="1"><input type="button" value="Login" onclick="login()" /></td>
                    <td colspan="2"><input type="button" value="Passwort vergessen" onclick="window.location.href = 'forgotPassword.php'" /></td>
                </tr>
            </table>
        </form>
        <form id="registerForm" method="POST">
            <table>
                <tr>
                    <td>Email:</td><td colspan="3"><input id="registerEmail" type="email" name="email" size="50" required /></td>
                </tr>
                <tr>
                    <td>Kennwort:</td><td colspan="3"><input id="registerPassword" type="password" name="password" size="50" required  /></td>
                </tr>
                <tr>
                    <td>Vorname:</td><td colspan="3"><input id="registerFirstName" type="text" name="vorname" pattern="[a-zA-Z]{1,20}" title="Buchstaben, 1-20" size="50" required /></td>
                </tr>
                <tr>
                    <td>Nachname:</td><td colspan="3"><input id="registerLastName" type="text" name="nachname" pattern="[a-zA-Z]{1,20}" title="Buchstaben, 1-20" size="50" required /></td>
                </tr>
                <tr>
                    <td>Straße:</td><td><input id="registerStreet" type="text" name="strasse" pattern="[a-zA-Z]{1,40}" title="Buchstaben, 1-40" required /></td>
                    <td>Nr:</td><td><input id="registerNr" type="text" name="hausnummer" pattern="[0-9]{1,4}" title="Zahlen, 1-4" required /></td>
                </tr>
                <tr>
                    <td>Ort:</td><td><input id="registerPlace" readonly="true" type="text" name="ort" class="deactivated" required /></td>
                    <td>Plz:</td>
                    <td>
                        <select id="registerPlz" onchange="selectPlz(this)">
                            <option value=""></option>
                        </select>
                        <input id="plzHidden" type="hidden" name="plz" />
                    </td>
                </tr>
            </table>
            <input style="float: right;" type="button" onclick="register()" value="Erstellen" />
        </form>
    </div>
</div>