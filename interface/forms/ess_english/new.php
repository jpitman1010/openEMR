<?php

/**
 * ESS form using forms api     new.php    create a new form
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ruth Moulton <moulton ruth@muswell.me.uk>
 * @copyright Copyright (c) 2021 ruth moulton <ruth@muswell.me.uk>
 *
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("ess_english.inc.php"); //common strings, require_once(globals.php), other includes  etc

use OpenEMR\Common\Csrf\CsrfUtils;    // security module
use OpenEMR\Core\Header;
?>
<html>
<head>
    <title><?php echo text($str_form_title); ?> </title>
    <?php Header::setupHeader(); ?>
</head>
<body class="body_top">

<script>
var no_qs = 8; // number of questions in the form
var ess_score = 0; // total score
var changes_made = false;
</script>

<SCRIPT
  src="<?php echo $rootdir;?>/forms/ess_english/ess_english_javasrc.js">
 </script>


<form method=post action="<?php echo $rootdir;?>/forms/ess_english/save.php?mode=new" name="my_form" onSubmit="return(check_all(true));" >
<input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
<br></br>
<span><font size=4><?php echo text($str_form_name); ?></font></span>
<br></br>
<input type="Submit" value="<?php echo xla('Save Form'); ?>" style="color: #483D8B" >
 &nbsp &nbsp
 <input type="button" value="<?php echo attr($str_nosave_exit);?>" onclick="top.restoreSession();check_all(false);return( nosave_exit());" style="color: #483D8B">
<br><br></br>
<span class="text"> <h6><?php echo xlt('How likely are you to doze off or fall asleep in the following situations, in contrast to feeling just 
tired? '); ?>
<br><br>
<h6><?php echo xlt('
This refers to your usual way of life in recent times. 
Even if you haven’t done some of these things recently try to work out how they would have affected 
you.'); ?>
<br><br>
<b><h6><?php echo xlt('
Use the following scale to choose the most appropriate number for each situation: 
  '); ?>
<br><br>
<h6><?php echo xlt('
0 = would never doze  '); ?>
<br><br>
<h6><?php echo xlt('
1 = slight chance of dozing  '); ?>
<br><br>
<h6><?php echo xlt('
2 = moderate chance of dozing  '); ?>
<br><br>
<h6><?php echo xlt('
3 = high chance of dozing  '); ?>
<br><br>
<h6><?php echo xlt('
It is important that you answer each question as best you can.'); ?>
</span>
<br>
<br>

<table><tr>
<td>
<span class="text" ><?php echo xlt('Sitting and reading.'); ?></span>
<select name="ESS_A_V1_0_1" onchange="update_score(0, my_form.ESS_A_V1_0_1.value);">
    <option selected value="undef"><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
<br>
</br>
</tr>
 </table>
<table>
<tr>
<td>
<span class="text" ><?php echo xlt('Watching TV'); ?></span>
<select name="ESS_A_V1_0_2" onchange="update_score(1, my_form.ESS_A_V1_0_2.value);" >
    <option selected value="undef"><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
<br></br>
</tr>
 </table>
 <table>
 <tr> <td>
<span class="text" ><?php echo xlt('Sitting inactive in a public place (e.g. a theatre or a meeting).'); ?></span>
<select name="ESS_A_V1_0_3" onchange="update_score(2, my_form.ESS_A_V1_0_3.value);" >
    <option selected value="undef" ><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
 <br></br>
</tr>
 </table>
<table>
<tr>
<td>
<span class="text" ><?php echo xlt('As a passenger in a car for an hour without a break.'); ?></span>
 <select name="ESS_A_V1_0_4" onchange="update_score(3, my_form.ESS_A_V1_0_4.value);">
 <option selected value="undef" ><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
    <br></br>
</tr>
 </table>
<table>
  <tr>
<td>
<span class="text"><?php echo xlt('Lying down to rest in the afternoon when circumstances permit.'); ?></span>
<select name="ESS_A_V1_0_5" onchange="update_score(4, my_form.ESS_A_V1_0_5.value);">
 <option selected value="undef" ><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
    <br></br>
</tr>
 </table>
<table>
 <tr>
<td>
<span class="text"><?php echo xlt('Sitting and talking to someone.'); ?></span>
<select name="ESS_A_V1_0_6" onchange="update_score(5, my_form.ESS_A_V1_0_6.value);">
 <option selected value="undef" ><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
 <br></br>
 </table>
 </tr>
<table>
  <tr>
<td>
<span class="text"><?php echo xlt('Sitting quietly after lunch without alcohol.'); ?></span>
<select name="ESS_A_V1_0_7" onchange="update_score(6, my_form.ESS_A_V1_0_7.value);">
 <option selected value="undef" ><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
 <br><br>
</tr>
 </table>
 <table>
 <tr>
<td>
<span class="text"><?php echo xlt('In a car, while stopped for a few minutes in the traffic.'); ?></span>
<select name="ESS_A_V1_0_8" onchange="update_score(7, my_form.ESS_A_V1_0_8.value);">
 <option selected value="undef" ><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
 <br></br>
 </table>
 <br></br>
 <SCRIPT>
function  check_all(prod_user) {
   // has each question been answered and save scores
   // if prod_user is true ask user to answer all the questions
    var  flag=false;
    var list='';
    for (i=0; i<(no_qs-1); i++) { // last questionis optional
          if ( !all_answered[i] ){
          list = list+Number(i+1) + ',';
          flag=true;
          }
          else {
            changes_made = true;
            }
    }
    if (flag && prod_user) {
          list[list.length-1] = ' '; /* get rid of trailing comma */
          alert(xl("Please answer all of the questions") + ": " + list + " " + xl("are unanswered"));
           return false;
     }
    return true;
  }
  // warn if about to exit without saving answers - check that's what the user really wants
function nosave_exit() {
var conf = true;
    if (changes_made){
        conf = confirm (<?php echo js_escape($str_nosave_confirm) ; ?>);
    }
    if (conf) {
        window.location.href="<?php echo $GLOBALS['form_exit_url']; ?>";
    }
    return ( conf );
}
</script>
<table frame=hsides><tr><td>
 <span id="show_ess_score"><b><?php echo xlt("Total ESS score = "); ?>:</b> </td>
 </table>
 <script>
update_score("undef",ess_score);
 </script>
 <br></br>
 <table>
 <tr><td>
 <input type="Submit" value="<?php echo xla('Save Form'); ?>" style="color: #483D8B">
 &nbsp &nbsp
 <input type="button" value="<?php echo attr($str_nosave_exit); ?>" onclick="top.restoreSession();check_all(false);return(nosave_exit());" style="color: #483D8B">
 <br><br>
 </table>
</form>
<?php
formFooter();
?>
