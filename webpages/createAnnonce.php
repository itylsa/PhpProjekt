<div id="createAnnonceWrapper">
    <h1>Annonce erstellen</h1>
    <form onsubmit="createAnnonce('createAnnonceForm');event.preventDefault()" novalidate id="createAnnonceForm" method="POST">
        <table>
            <tr>
                <td>Titel:</td>
                <td><input type="text" id="createTitle" min="4" max="50" size="50" /></td>
            </tr>
            <tr>
                <td></td>
                <td><div class="errorMessage" id="createTitleError"></div></td>
            </tr>
            <tr>
                <td>Text:</td>
                <td><textarea id="createText" style="resize: none" rows="13" cols="38" draggable="false"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><div class="errorMessage" id="createTextError"></div></td>
            </tr>
            <tr>
                <td>Rubrik:</td>
                <td><select id="createCategory" style="width: 327px"></select></td>
            </tr>
            <tr>
                <td></td>
                <td><div class="errorMessage" id="createCategoryError"></div></td>
            </tr>
            <tr>
                <td>Bilder:</td>
                <td><input type="file" id="createFile" onchange="getFiles()" style="width: 327px" multiple="true" /></td>
            </tr>
            <tr>
                <td></td>
                <td style="left: 0px; position: absolute;"><div id="filePreview" style="width: 100%;"></div></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Überprüfen" /></td>
            </tr>
        </table>
    </form>
</div>