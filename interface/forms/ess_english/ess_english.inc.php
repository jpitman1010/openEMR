<?php

/**
 * version 1.0.0  July 2020
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
 require_once("$srcdir/patient.inc.php");


// menu strings
$str_default = xl('Please select an answer');
$str_not = xl('Would Never Doze');
$str_slight = xl('Slight Chance of Dozing');
$str_mod = xl('Moderate Chance of Dozing');
$str_high = xl('High Chance of Dozing');


$str_nosave_exit = xl("Close without saving");
$str_nosave_confirm = xl("Are you sure you'd like to quit without saving your answers?");
$str_generate_pdf = xl("Generate PDF");

$str_form_name = xl("Epworth Sleepiness Scale (ESS) - English");
$str_form_title = xl("ess_english");

// strings describing the issues
$str_ESS_A_V1_0_1 = xl('Sitting and reading.');
$str_ESS_A_V1_0_2 = xl('Watching TV');
$str_ESS_A_V1_0_3 = xl('Sitting inactive in a public place (e.g. a theatre or a meeting).');
$str_ESS_A_V1_0_4 = xl('As a passenger in a car for an hour without a break.');
$str_ESS_A_V1_0_5 = xl("Lying down to rest in the afternoon when circumstances permit.");
$str_ESS_A_V1_0_6 = xl('Sitting and talking to someone.');
$str_ESS_A_V1_0_7 = xl('Sitting quietly after lunch without alcohol.');
$str_ESS_A_V1_0_8 = xl('In a car, while stopped for a few minutes in the traffic.');
$str_total = xl('Total ESS score');

// meaning of score values
$str_values = [0 => xl('Would Never Doze') . ' (0)',1 => xl('Slight Chance of Dozing') . ' (1)',2 => xl('Moderate Chance of Dozing') . ' (2)',3 => xl('High Chance of Dozing') . ' (3)'];
