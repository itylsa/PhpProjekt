<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of messagePage
 *
 * @author heiko.goehler
 */
class messagePage {

    public function showErrorMessage($m) {
        $mb = "<div class='errorMessage'>";
        $mb = $mb . "<h2>" . $m . "</h2>";
        $mb = $mb . "</div>";
        return $mb;
    }

    public function showInfoMessage($m) {
        $mb = "<div class='infoMessage'>";
        $mb = $mb . "<h2>" . $m . "</h2>";
        $mb = $mb . "</div>";
        return $mb;
    }

}
