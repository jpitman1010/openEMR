<?php

/**
 * gad-7 report.php
 * display a form's values in the encounter summary page
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ruth Moulton <moulton ruth@muswell.me.uk>
 * @copyright Copyright (c) 2021 ruth moulton <ruth@muswell.me.uk>
 *
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("gad7_greek.inc.php");

$gad7_total = 0;
$pdf_as_string = '';
$data;
$exp = '';

$str_difficulty_values = [0 => xl('Ποτέ') . ' (0)',1 => xl('Αρκετές ημέρες') . ' (1)', 2 => xl('Πάνω από τις μισές ημέρες') . ' (2)', 3 => xl('Σχεδόν καθημερινά') . ' (3)', 'undef' => xl('Δεν απαντήθηκε')];

function gad7_report($pid, $encounter, $cols, $id)
{
    global $str_test, $str_nervous,$gad7_total, $pdf_as_string, $str_values,$str_difficulty_values, $data, $exp, $file_name, $str_generate_pdf;

    $count = 0;
    $value = 0;
    $gad7_total = 0; /* initialise back to zero */

    $str_issues = ["nervous_score" => xl('Αίσθημα νευρικότητας'),"control_worry_score" => xl('Δεν ελέγχει την ανησυχία'),"worry_score" => xl('Ανησυχητικό'),"relax_score" => xl('Δυσκολία χαλάρωσης'),"restless_score" => xl('Το να είσαι ανήσυχος'),"irritable_score" => xl('Το να είσαι ευερέθιστος'),"fear_score" => xl('Αίσθημα φόβου'), "difficulty" => xl('Δυσκολία εργασίας κλπ.'),"total" => xl('GAD-7 Συνολικό σκορ')];

    $str_score_analysis = [0 => xl('Χωρίς αγχώδη διαταραχή'), 5 => xl('Ήπια αγχώδης διαταραχή'), 15 => xl('Σοβαρή αγχώδης διαταραχή')];

    $data = formFetch("form_gad7", $id);

    if ($data) {
        print "<table><tr>";
        foreach ($data as $key => $value) {
// include scores_array and total for backward compatibility
            if ($key == "id" || $key == "pid" || $key == "user" || $key == "groupname" || $key == "authorized" || $key ==  "activity" || $key == "date" || $value == "" || $key == "scores_array" || $key == "total" || $value == "0000-00-00 00:00:00") {
                continue;
            }
            if ($key == "difficulty") {
                print "<td><span class=bold>" . text($str_issues[$key]) . ": </span><span class=text>" . text($str_difficulty_values [$value]) . "</span></td>";
            } else {
                print "<td><span class=bold>" . text($str_issues[$key]) . ": </span><span class=text>" . text($str_values [$value]) . "</span></td>";
                if (is_numeric($value)) {
                    $gad7_total += $value;
                }
            }
            $count++;
            if ($count == $cols) {
                $count = 0;
                print "</tr><tr>\n";
            }
        }
        // print the total
        switch (intdiv($gad7_total, 5)) {
            case 0:
                $exp = $str_score_analysis[0];
                break;
            case 1:
            case 2:
                $exp = $str_score_analysis[5];
                break;
            default:
                $exp = $str_score_analysis[15];
        }

          print "<td><span class=bold>" . text($str_issues["total"]) . ": </span><span class=text>" . text($gad7_total) . " - " . text($exp) . "</span></td>";
    }


    print "</tr></table>";
}
