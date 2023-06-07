<?php

/**
 * ess report.php
 * display a form's values in the encounter summary page
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ruth Moulton <moulton ruth@muswell.me.uk>
 * @copyright Copyright (c) 2021 ruth moulton <ruth@muswell.me.uk>
 *
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("ess_english.inc.php");

$ess_total = 0;
$pdf_as_string = '';
$data;
$exp = '';

$str_ess_answer_values = [0 => xl('Would never doze') . ' (0)',1 => xl('Slight chance of dozing') . ' (1)', 2 => xl('Moderate chance of dozing') . ' (2)', 3 => xl('High chance of dozing') . ' (3)', 'undef' => xl('not answered')];

function ess_report($pid, $encounter, $cols, $id)
{
    global $str_test, $ess_total, $pdf_as_string, $str_values,$str_ess_answer_values, $data, $exp, $file_name, $str_generate_pdf;

    $count = 0;
    $value = 0;
    $ess_total = 0; /* initialise back to zero */

    $str_issues = ["ESS_A_V1_0_1" => xl('Sitting and reading.'),"ESS_A_V1_0_2" => xl('Watching TV'),"ESS_A_V1_0_3" => xl('Sitting inactive in a public place (e.g. a theatre or a meeting).'),"ESS_A_V1_0_4" => xl('As a passenger in a car for an hour without a break.'),"ESS_A_V1_0_5" => xl('Lying down to rest in the afternoon when circumstances permit.'),"ESS_A_V1_0_6" => xl('Sitting and talking to someone.'),"ESS_A_V1_0_7" => xl('Sitting quietly after lunch without alcohol.'), "ESS_A_V1_0_8" => xl('In a car, while stopped for a few minutes in the traffic.'),"total" => xl('Total ess score')];

    $str_score_analysis = [0 => xl('Lower Normal Daytime Sleepiness'), 6 => xl('Higher Normal Daytime Sleepiness'), 11 => xl('Mild Excessive Daytime Sleepiness'), 13 => xl('Moderate Excessive Daytime Sleepiness'), 16 => xl('Severe Excessive Daytime Sleepiness')];

    $data = formFetch("ess_english", $id);

    if ($data) {
        print "<table><tr>";
        foreach ($data as $key => $value) {
// include scores_array and total for backward compatibility
            if ($key == "id" || $key == "pid" || $key == "user" || $key == "groupname" || $key == "authorized" || $key ==  "activity" || $key == "date" || $value == "" || $key == "scores_array" || $key == "total" || $value == "0000-00-00 00:00:00") {
                continue;
            }
            if ($key == "ESS_A_V1_0_8") {
                print "<td><span class=bold>" . text($str_issues[$key]) . ": </span><span class=text>" . text($str_ess_answer_values [$value]) . "</span></td>";
            } else {
                print "<td><span class=bold>" . text($str_issues[$key]) . ": </span><span class=text>" . text($str_values [$value]) . "</span></td>";
                if (is_numeric($value)) {
                    $ess_total += $value;
                }
            }
            $count++;
            if ($count == $cols) {
                $count = 0;
                print "</tr><tr>\n";
            }
        }
        // print the total
        switch (intdiv($ess_total, 5)) {
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

          print "<td><span class=bold>" . text($str_issues["total"]) . ": </span><span class=text>" . text($ess_total) . " - " . text($exp) . "</span></td>";
    }


    print "</tr></table>";
}
