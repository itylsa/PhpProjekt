<div id="forgotPasswordWrapper">
    <h1>Neues Passwort</h1>
    <form onsubmit="forgotPassword('forgotPasswordForm')" id="forgotPasswordForm" method="POST">
        <table border="0">
            <tbody>
                <tr>
                    <td> Email:</td>
                    <td><input type="email" id="forgotPasswordEmail" required name="email" /></td>
                </tr>
                <tr><td colspan="2"><div class="errorMessage" id="forgotPasswordEmailError"></div></td></tr>
                <tr>
                    <td>Neues Passwort: </td>
                    <td><input type="password" id="forgotPasswordPwd" min="4" required name="password" /></td>
                </tr>
                <tr><td colspan="2"><div class="errorMessage" id="forgotPasswordPwdError"></div></td></tr>
                <tr>
                    <td><input type="button" value="Zurück" onclick="showPage('loginWrapper')" /></td>
                    <td><input type="submit" value="Passwort ändern" style="float: none" /></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>