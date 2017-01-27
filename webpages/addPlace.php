<div id="addPlaceWrapper">
    <h1>Ort hinzufügen</h1>
    <form id="addPlaceForm" method="POST">
        <table>
            <tr>
                <td>Plz: </td><td><input id="plz" type="text" name="plz" required="true" pattern="[0-9]{5}" title="Muss aus genau 5 Zahlen bestehen" /></td>
            <tr>
            <tr><td colspan="2"><div class="errorMessage" id="plzError"></div></td></tr>
            <tr>
                <td>Ort: </td><td><input id="place" type="text" name="ort" required="true" pattern="[a-zA-Z]{1,30}" title="Muss aus bis zu 30 Buchstaben bestehen" /><br></td>
            </tr>
            <tr><td colspan="2"><div class="errorMessage" id="placeError"></div></td></tr>
            <tr>
                <td></td><td colspan="2"><input type="button" onclick="addPlace('addPlaceForm')" value="Ort anlegen" /></td>
            </tr>
        </table>
    </form>
</div>