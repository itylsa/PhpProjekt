<div id="userEditViewWrapper" >
    <h1>Benutzer bearbeiten</h1>
    <form onsubmit="editUser('userEditViewForm');event.preventDefault()" style="padding-bottom: 30px;" novalidate id="userEditViewForm" method="POST">
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
                <td>Plz:</td>
                <td>
                    <input type="text" list="editPlzList" id="editPlz" autocomplete="off" onblur="updatePlaceList('edit')" />
                    <datalist id="editPlzList"></datalist>
                </td>
                <td>Ort:</td>
                <td>
                    <input type="text" list="editPlaceList" id="editPlace" autocomplete="off" onblur="updatePlzList('edit')" />
                    <datalist id="editPlaceList"></datalist>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><div class="errorMessage" id="editPlzError"></div></td>
                <td></td>
                <td><div class="errorMessage" id="editPlaceError"></div></td>
            </tr>
        </table>
        <input style="float: left;" type="button" onclick="showUserDeleteBox()" value="Account löschen" />
        <input style="float: right;" type="submit" value="Speichern" />
    </form>
    <div id="userDeleteBoxWrapper" style="display: none">
        <div id="userDeleteBox">
            Wirklich löschen?
        </div>
        <div>
            <table>
                <tr>
                    <td>
                        <input type="button" value="Ja" onclick="deleteUser()" />
                    </td>
                    <td>
                        <input type="button" value="Nein" onclick="closeUserDeleteBox(); showInfoBox('Benutzer wurde nicht gelöscht')" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>