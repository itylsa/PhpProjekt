<div id="userEditViewWrapper" >
    <form id="userEditViewForm" method="POST">
        <table>
            <tr>
                <td>Email:</td><td colspan="3"><input id="editEmail" type="email" name="email" size="50" required /></td>
            </tr>
            <tr><td colspan="4"><div class="errorMessage" id="editEmailError"></div></td></tr>
            <tr>
                <td>Kennwort:</td><td colspan="3"><input id="editPassword" type="password" name="password" size="50" min="4" required  /></td>
            </tr>
            <tr><td colspan="4"><div class="errorMessage" id="editPasswordError"></div></td></tr>
            <tr>
                <td>Vorname:</td><td colspan="3"><input id="editFirstName" type="text" name="vorname" pattern="[a-zA-Z]{1,20}" title="Buchstaben, 1-20" size="50" required /></td>
            </tr>
            <tr><td colspan="4"><div class="errorMessage" id="editFirstNameError"></div></td></tr>
            <tr>
                <td>Nachname:</td><td colspan="3"><input id="editLastName" type="text" name="nachname" pattern="[a-zA-Z]{1,20}" title="Buchstaben, 1-20" size="50" /></td>
            </tr>
            <tr><td colspan="4"><div class="errorMessage" id="editLastNameError"></div></td></tr>
            <tr>
                <td>Straße:</td><td><input id="editStreet" type="text" name="strasse" pattern="[a-zA-Z]{1,40}" title="Buchstaben, 1-40" /></td>
                <td>Nr:</td><td><input id="editNr" type="text" name="hausnummer" pattern="[0-9]{1,4}" title="Zahlen, 1-4" /></td>
            </tr>
            <tr>
                <td></td>
                <td><div class="errorMessage" id="editStreetError"></div></td>
                <td></td>
                <td><div class="errorMessage" id="editNrError"></div></td>
            </tr>
            <tr>
                <td>Ort:</td><td><input id="editPlace" readonly="true" type="text" name="ort" class="deactivated" /></td>
                <td>Plz:</td>
                <td>
                    <select id="editPlz" onchange="selectPlz(this)">
                        <option value=""></option>
                    </select>
                    <input id="plzHidden" type="hidden" name="plz" />
                </td>
            </tr>
        </table>
        <input style="float: right;" type="button" onclick="editUser('userEditViewForm')" value="Erstellen" />
    </form>
</div>