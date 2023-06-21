<?php

/**
 * ess form using form api     view.php
 * open a previously completed ESS form for further editing
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ruth Moulton <moulton ruth@muswell.me.uk>
 * @copyright Copyright (c) 2021 ruth moulton <ruth@muswell.me.uk>
 *
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("ess_Greek.inc.php");  // common strings, require_once(globals.php), other includes etc

use OpenEMR\Common\Csrf\CsrfUtils;    // security module
use OpenEMR\Core\Header;

$form_folder = "ess_Greek";
?>
<html>
 <head>
    <title><?php echo text($str_form_title); ?> </title>
    <?php Header::setupHeader(); ?>
</head>
<body class="body_top">
<?php // read in the values from the filled in form held in db
$obj = formFetch("ess_Greek", $_GET["id"]); ?>
<script>
// get scores from previous saving of the form
var ess_score = 0;

</script>
<SCRIPT
  src="<?php echo $rootdir;?>/forms/ess_Greek/ess_Greek_javasrc.js">
 </script>

<SCRIPT>
// stuff that uses embedded php must go here, not in the include javascript file - it must be executed on server side before page is sent to client. included javascript is only executed on the client
var changes_made = false;

// check user really wants to exit without saving new answers
function nosave_exit() {
var conf = true;

/* if there have been no changes, just exit other wise get user to confirm exit without saving changes */
if (changes_made) {
    conf = confirm ( <?php echo js_escape($str_nosave_confirm); ?> );
    }
if (conf) {
    window.location.href="<?php echo $GLOBALS['form_exit_url']; ?>";
    }
return ( conf );
}
</script>

<form method=post action="<?php echo $rootdir;?>/forms/ess_Greek/save.php?mode=update&id=<?php echo attr_url($_GET["id"]); ?>" name="my_form" >
<input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
<br></br>
<span   ><font size=4><?php echo text($str_form_name); ?></font></span>
<br></br>
<input type="Submit" value="<?php echo xla('Save Form'); ?>" style="color: #483D8B" >
&nbsp &nbsp
<input type="button" value="<?php echo attr($str_nosave_exit);?>" onclick="top.restoreSession();return( nosave_exit());" style="color: #483D8B">
 <br><br>
<table>
<tr> <td>
<span class="text"><?php echo  text($str_ESS_A_V1_0_1); ?></span>
<select name="ESS_A_V1_0_1" onchange="update_score(0, my_form.ESS_A_V1_0_1.value);changes_made=true">
     <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
<script>
     // set the default to the previous value - so it is displayed in the menue box
     var i = <?php echo text($obj['ESS_A_V1_0_1']); ?> ; //the value from last time
    document.my_form.ESS_A_V1_0_1.options[<?php echo text($obj['ESS_A_V1_0_1']); ?>].defaultSelected=true;
    ess_score += i;
    all_scores[0] = i;
</script>
 <br></br>
</tr>
 </table>
  <table>
  <tr> <td>
<span class="text" ><?php echo text($str_ESS_A_V1_0_2); ?></span>
<select name="ESS_A_V1_0_2" onchange="update_score(1, my_form.ESS_A_V1_0_2.value);changes_made=true" >
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
 </select>
<script>
     // set the default to the previous value - so it is displayed in the menue box
     var i = <?php echo text($obj['ESS_A_V1_0_2']); ?>; //the value from last time
   document.my_form.ESS_A_V1_0_2.options[i].defaultSelected=true;
    ess_score += i;
    all_scores[1] = i;
</script>
 <br></br>
</tr>
 </table>
  <table>
  <tr>
  <td>
<span class="text" ><?php echo text($str_ESS_A_V1_0_3); ?></span>
<select name="ESS_A_V1_0_3" onchange="update_score(2, my_form.ESS_A_V1_0_3.value);changes_made=true" >
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
       <script>
     // set the previous value to the default - so it is displayed in the menue box
      var i = <?php echo text($obj['ESS_A_V1_0_3']); ?> ; //the value from last time
    document.my_form.ESS_A_V1_0_3.options[i].defaultSelected=true;
    ess_score += i;
    all_scores[2] = i;
    </script>
     <br></br>
</tr>
 </table>
 <table>
 <tr><td>
<span class="text" ><?php echo text($str_ESS_A_V1_0_4); ?></span>
<select name="ESS_A_V1_0_4" onchange="update_score(3, my_form.ESS_A_V1_0_4.value);changes_made=true">
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
 </select>
<script>
     // set the previous value to the default - so it is displayed in the menue box
      var i = <?php echo text($obj['ESS_A_V1_0_4']); ?> ; //the value from last time
    document.my_form.ESS_A_V1_0_4.options[i].defaultSelected=true;
    ess_score += i;
    all_scores[3] = i;
    </script>
    <br></br>
</tr>
 </table>
  <table>
  <tr><td>
<span class="text" ><?php echo text($str_ESS_A_V1_0_5); ?></span>
<select name="ESS_A_V1_0_5" onchange="update_score(4, my_form.ESS_A_V1_0_5.value);changes_made=true">
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
<script>
     // set the previous value to the default - so it is displayed in the menue box
     var i = <?php echo text($obj['ESS_A_V1_0_5']); ?> ; //the value from last time
    document.my_form.ESS_A_V1_0_5.options[i].defaultSelected=true;
    ess_score += i;
    all_scores[4] = i;
    </script>
    <br></br>
</tr>
 </table>
 <table>
 <tr><td>
<span class="text" ><?php echo text($str_ESS_A_V1_0_6); ?></span>
<select name="ESS_A_V1_0_6" onchange="update_score(5, my_form.ESS_A_V1_0_6.value);changes_made=true">
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
<script>
     // set the previous value to the default - so it is displayed in the menue box
       var i = <?php echo text($obj['ESS_A_V1_0_6']); ?> ; //the value from last time
    document.my_form.ESS_A_V1_0_6.options[i].defaultSelected=true;
    ess_score += i;
    all_scores[5] = i;
</script>
    <br></br>
    </tr>
 </table>
  <table>
  <tr><td>
<span class="text" ><?php echo text($str_ESS_A_V1_0_7); ?></span>
<select name="ESS_A_V1_0_7" onchange="update_score(6, my_form.ESS_A_V1_0_7.value);changes_made=true">
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
<script>
     // set the previous value to the default - so it is displayed in the menue box
     var i = <?php echo text($obj['ESS_A_V1_0_7']);?> ; //the value from last time
    document.my_form.ESS_A_V1_0_7.options[i].defaultSelected=true;
    ess_score += i;
    all_scores[6] = i;
</script>
  <br></br>
</tr>
 </table>
 <table>
  <tr><td>
<span class="text" ><?php echo text($str_ESS_A_V1_0_8); ?></span>
<select name="ESS_A_V1_0_8" onchange="update_score(7, my_form.ESS_A_V1_0_8.value);changes_made=true">
    <option value="0"><?php echo text($str_not); ?></option>
    <option value="1"><?php echo text($str_slight); ?></option>
    <option value="2"><?php echo text($str_mod); ?></option>
    <option value="3"><?php echo text($str_high); ?></option>
    </select>
<script>
     // set the previous value to the default - so it is displayed in the menue box
     var i = <?php echo text($obj['ESS_A_V1_0_8']);?> ; //the value from last time
    document.my_form.ESS_A_V1_0_8.options[i].defaultSelected=true;
    ess_score += i;
    all_scores[7] = i;
</script>
  <br></br>
</tr>
 </table>
  
 <table frame=hsides>
<tr><td>
 <span id="show_ess_score"><b><?php echo xlt("Total ESS score"); ?>:</b> </td>
<!-- use this to save the individual scores in the database -->
<!-- input type="hidden" name="scores_array" -->
  <br></br>
  </tr>
  </table>

 <br>
<input type="Submit" value="<?php echo xla('Save Form'); ?>" style="color: #483D8B"   >
&nbsp &nbsp
<input type="button" value="<?php echo attr($str_nosave_exit);?>" onclick="top.restoreSession();return( nosave_exit());" style="color: #483D8B">
 <br><br><br>
</form>

<?php
formFooter();
?>
