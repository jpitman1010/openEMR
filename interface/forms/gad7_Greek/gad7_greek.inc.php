<?php

/**
 * gad-7.inc - common includes and constants for the gad-7 form
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
$str_default = xl('Επιλέξτε μια απάντηση');
$str_not = xl('Ποτέ');
$str_several = xl('Αρκετές ημέρες') ;
$str_more = xl('Πάνω από τις μισές ημέρες');
$str_nearly = xl('Σχεδόν καθημερινά');
$str_somewhat = xl('Somewhat difficult');
$str_very = xl('Πολύ δύσκολο');
$str_extremely = xl('Εξαιρετικά δύσκολο');

$str_nosave_exit = xl("Κλείσιμο χωρίς αποθήκευση");
$str_nosave_confirm = xl("Είστε βέβαιοι ότι θέλετε να σταματήσετε χωρίς να αποθηκεύσετε τις απαντήσεις σας;");
$str_generate_pdf = xl("Generate PDF");

$str_form_name = xl("General Anxiety Disorder 7 (GAD-7)");
$str_form_title = xl("GAD-7");
// question 8 strings
$str_q8 = xl('Πόσο δύσκολο το έχουν κάνει αυτά τα προβλήματα να κάνεις δουλειά, να φροντίζεις πράγματα στο σπίτι ή να τα πηγαίνεις καλά με άλλους ανθρώπους;');
$str_q8_2 = '(' . xl('Αυτή η ερώτηση είναι προαιρετική και δεν περιλαμβάνεται στην τελική βαθμολογία.') . ')  ';
// strings describing the issues
$str_nervous = xl('Νιώθετε νευρικότητα, άγχος ή αγανάκτηση');
$str_control_worry = xl('Δεν μπορείτε να σταματήσετε ή να ελέγξετε την ανησυχία');
$str_worry = xl('Ανησυχείτε πάρα πολύ για διαφορετικά πράγματα');
$str_relax = xl('Δυσκολία χαλάρωσης');
$str_restless = xl("Το να είσαι τόσο ανήσυχος που είναι δύσκολο να καθίσεις ακίνητος");
$str_annoyed = xl('Γίνεστε εύκολα ενοχλημένοι ή ευερέθιστοι');
$str_afraid = xl('Αίσθημα φόβου σαν να συμβεί κάτι απαίσιο');
$str_total = xl('Total GAD-7 score');
//
// meaning of score values
$str_values = [0 => xl('Ποτέ') . ' (0)',1 => xl('Αρκετές ημέρες') . ' (1)',2 => xl('Πάνω από τις μισές ημέρες') . ' (2)',3 =>xl('Σχεδόν καθημερινά') . ' (3)'];
