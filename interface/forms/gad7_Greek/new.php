<?php

/**
 * gad-7 form using forms api     new.php    create a new form
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ruth Moulton <moulton ruth@muswell.me.uk>
 * @copyright Copyright (c) 2021 ruth moulton <ruth@muswell.me.uk>
 *
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("gad7_greek.inc.php"); //common strings, require_once(globals.php), other includes  etc

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
var gad7_score = 0; // total score
var changes_made = false;
</script>

<SCRIPT
  src="<?php echo $rootdir;?>/forms/gad7_Greek/gad7_greek_javasrc.js">
 </script>

 <script>
// stuff that uses embedded php must go here, not in the include javascript file -
// it must be executed on server side before page is sent to client. included
// javascript is only executed on the client
function create_q8(question, menue){
 // create the 8th question - the second part is italicised. Only displayed if score > 0
    var text = document.createTextNode(jsAttr(<?php echo js_escape($str_q8); ?>));
    question.appendChild(text);
    var new_line = document.createElement("br"); // second part is in italics
    var ital = document.createElement("i"); /* second part is in italics */
    var question_2 = document.createTextNode(jsAttr(<?php echo js_escape($str_q8_2); ?>));
    ital.appendChild(question_2);
    question.name = "eighth";
    question.appendChild(new_line);
    question.appendChild(ital);
// populate the   the menue
     menue.options[0] = new Option ( <?php echo js_escape($str_default);  ?>, "undef");
     menue.options[1] = new Option ( <?php echo js_escape($str_not); ?>, "0");
     menue.options[2] = new Option ( <?php echo js_escape($str_somewhat); ?>, "1");
     menue.options[3] = new Option ( <?php echo js_escape($str_very); ?>, "2");
     menue.options[4] = new Option ( <?php echo js_escape($str_extremely);?>, "3");
}
</script>
<form method=post action="<?php echo $rootdir;?>/forms/gad7_Greek/save.php?mode=new" name="my_form" onSubmit="return(check_all(true));" >
<input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
<br></br>
<span><font size=4><?php echo text($str_form_name); ?></font></span>
<br></br>
<input type="Submit" value="<?php echo xla('Save Form'); ?>" style="color: #483D8B" >
 &nbsp &nbsp
 <input type="button" value="<?php echo attr($str_nosave_exit);?>" onclick="top.restoreSession();check_all(false);return( nosave_exit());" style="color: #483D8B">
<br><br></br>
<span class="text"> <h2><?php echo xlt('Τις τελευταίες δύο εβδομάδες πόσο συχνά σας έχουν επηρεάσει τα ακόλουθα συμπτώματα;'); ?></h2> </span>
<br>
<table><tr>
<td>
<span class="text" ><?php echo xlt('Αίσθηση νευρικότητας και άγχους, ή υπερέντασης'); ?></span>
<select name="nervous_score" onchange="update_score(0, my_form.nervous_score.value);">
    <option selected value="undef"><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_several); ?></option>
    <option value="2"><?php echo text($str_more); ?></option>
    <option value="3"><?php echo text($str_nearly); ?></option>
    </select>
<br>
</br>
</tr>
 </table>
<table>
<tr>
<td>
<span class="text" ><?php echo xlt('Αδυναμία να σταματήσω ή να ελέγξω την ανησυχία μου'); ?></span>
<select name="control_worry_score" onchange="update_score(1, my_form.control_worry_score.value);" >
    <option selected value="undef"><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_several); ?></option>
    <option value="2"><?php echo text($str_more); ?></option>
    <option value="3"><?php echo text($str_nearly); ?></option>
    </select>
<br></br>
</tr>
 </table>
 <table>
 <tr> <td>
<span class=text ><?php echo xlt('Είχα μεγάλη ανησυχία για διάφορα πράγματα'); ?></span>
<select name="worry_score" onchange="update_score(2, my_form.worry_score.value);" >
    <option selected value="undef" ><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_several); ?></option>
    <option value="2"><?php echo text($str_more); ?></option>
    <option value="3"><?php echo text($str_nearly); ?></option>
    </select>
 <br></br>
</tr>
 </table>
<table>
<tr>
<td>
<span class="text" ><?php echo xlt('Αδυναμία να χαλαρώσω'); ?></span>
 <select name="relax_score" onchange="update_score(3, my_form.relax_score.value);">
 <option selected value="undef" ><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_several); ?></option>
    <option value="2"><?php echo text($str_more); ?></option>
    <option value="3"><?php echo text($str_nearly); ?></option>
    </select>
    <br></br>
</tr>
 </table>
<table>
  <tr>
<td>
<span class="text"><?php echo xlt('Έντονη υπερδραστηριότητα που αδυνατούσα να κάτσω ήρεμα'); ?></span>
<select name="restless_score" onchange="update_score(4, my_form.restless_score.value);">
 <option selected value="undef" ><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_several); ?></option>
    <option value="2"><?php echo text($str_more); ?></option>
    <option value="3"><?php echo text($str_nearly); ?></option>
    </select>
    <br></br>
</tr>
 </table>
<table>
 <tr>
<td>
<span class="text"><?php echo xlt('Ήμουν ευερέθιστος ή ευέξαπτος'); ?></span>
<select name="irritable_score" onchange="update_score(5, my_form.irritable_score.value);">
 <option selected value="undef" ><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_several); ?></option>
    <option value="2"><?php echo text($str_more); ?></option>
    <option value="3"><?php echo text($str_nearly); ?></option>
    </select>
 <br></br>
 </table>
 </tr>
<table>
  <tr>
<td>
<span class="text"><?php echo xlt('Είχα φόβο ότι κάτι κακό θα συμβεί'); ?></span>
<select name="fear_score" onchange="update_score(6, my_form.fear_score.value);">
 <option selected value="undef" ><?php echo text($str_default); ?></option>
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_several); ?></option>
    <option value="2"><?php echo text($str_more); ?></option>
    <option value="3"><?php echo text($str_nearly); ?></option>
    </select>
 <br><br>
</tr>
 </table>
<table  frame = above>
<tr><td>
 <span id="q8_place" class="text"><br></span>
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
          alert(xl("Παρακαλώ απαντήστε σε όλες τις ερωτήσεις") + ": " + list + " " + xl("είναι αναπάντητα"));
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
 <span id="show_gad7_score"><b><?php echo xlt("Total GAD-7 score"); ?>:</b> </td>
 </table>
 <script>
update_score("undef",gad7_score);
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
