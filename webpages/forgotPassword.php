<div id="forgotPasswordWrapper">
    <h1>Neues Passwort</h1>
    <form action="" id="forgotPasswordForm" method="POST">
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
                    <td></td>
                    <td><input type="button" value="Passwort ändern" onclick="forgotPassword('forgotPasswordForm')" /></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>