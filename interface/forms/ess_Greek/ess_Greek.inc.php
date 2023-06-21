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
$str_default = xl('Επιλέξτε μια απάντηση.');
$str_not = xl('Ποτέ');
$str_slight = xl('Μικρή Πιθανότητα');
$str_mod = xl('Μέτρια Πιθανότητα');
$str_high = xl('Μεγάλη Πιθανότητα');


$str_nosave_exit = xl("Κλείσιμο χωρίς αποθήκευση;");
$str_nosave_confirm = xl("Είστε βέβαιοι ότι θέλετε να σταματήσετε χωρίς να αποθηκεύσετε τις απαντήσεις σας;");
$str_generate_pdf = xl("Παράγω PDF");

$str_form_name = xl("Epworth Sleepiness Scale (ESS) - Greek");
$str_form_title = xl("ess_Greek");

// strings describing the issues
$str_ESS_A_V1_0_1 = xl('Όταν κάθομαι και διαβάζω.');
$str_ESS_A_V1_0_2 = xl('Όταν βλέπω τηλεόραση.');
$str_ESS_A_V1_0_3 = xl('Όταν κάθομαι παθητικά σε δημόσιο 
χώρο (π.χ. στο θέατρο ή σε ομιλία.');
$str_ESS_A_V1_0_4 = xl('Όταν είμαι επιβάτης σε κινούμενο 
όχημα για παραπάνω από μια ώρα.');
$str_ESS_A_V1_0_5 = xl('Όταν ξαπλώνω να ξεκουραστώ το 
απόγευμα αν έχω χρόνο');
$str_ESS_A_V1_0_6 = xl('Όταν κάθομαι ενώ μιλάω σε κάποιον.');
$str_ESS_A_V1_0_7 = xl('Όταν κάθομαι ήρεμα μετά από ένα 
γεύμα χωρίς αλκοόλ.');
$str_ESS_A_V1_0_8 = xl('Όταν βρίσκομαι σε όχημα που δεν 
κινείται για μερικά λεπτά στην κίνηση.');
$str_total = xl('ESS Συνολικό σκορ');

// meaning of score values
$str_values = [0 => xl('Ποτέ') . ' (0)',1 => xl('Μικρή Πιθανότητα') . ' (1)',2 => xl('Μέτρια Πιθανότητα') . ' (2)',3 => xl('Μεγάλη Πιθανότητα') . ' (3)'];
