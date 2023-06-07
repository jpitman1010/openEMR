<?php

/**
 * ESS save.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ruth Moulton <moulton ruth@muswell.me.uk>
 * @copyright Copyright (c) 2021 ruth moulton <ruth@muswell.me.uk>
 *
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

 require_once("../../globals.php");
 require_once("$srcdir/api.inc.php");
 require_once("$srcdir/forms.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;


if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
    CsrfUtils::csrfNotVerified();
}

if ($encounter == "") {
    $encounter = date("Ymd");
}

if ($_GET["mode"] == "new") {
    $newid = formSubmit("ess_english", $_POST, $_GET["id"], $userauthorized);
    addForm($encounter, "ess_english", $newid, "ess_english", $pid, $userauthorized);
} elseif ($_GET["mode"] == "update") {
    sqlStatement(
        "update ess_english set pid = ?,
            groupname = ?,
            user = ?,
            authorized = ?,
            activity = 1,
            ESS_A_V1_0_1 = ?,
            ESS_A_V1_0_2 = ?,
            ESS_A_V1_0_3 = ?,
            ESS_A_V1_0_4 = ?,
            ESS_A_V1_0_5 = ?,
            ESS_A_V1_0_6 = ?,
            ESS_A_V1_0_7 = ?,
            ESS_A_V1_0_8 = ?,
            ess_score=?
            where id=? ",
        [
            $_SESSION["pid"],
            $_SESSION["authProvider"],
            $_SESSION["authUser"],
            $userauthorized,
            $_POST["ESS_A_V1_0_1"],
            $_POST["ESS_A_V1_0_2"],
            $_POST["ESS_A_V1_0_3"],
            $_POST["ESS_A_V1_0_4"],
            $_POST["ESS_A_V1_0_5"],
            $_POST["ESS_A_V1_0_6"],
            $_POST["ESS_A_V1_0_7"],
            $_POST["ESS_A_V1_0_8"],
            $_POST["ess_score"],
            $_GET["id"]
        ]
    );
}

$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
