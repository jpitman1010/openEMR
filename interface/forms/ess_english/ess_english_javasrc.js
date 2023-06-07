// Epworth Sleepiness Scale (ESS) form - English
// @package   OpenEMR
// @link      http://www.open-emr.org
// @author    ruth moulton
// @author    Ruth Moulton <moulton ruth@muswell.me.uk>
// @copyright Copyright (c) 2021 ruth moulton <ruth@muswell.me.uk>
//
// java script routines, must be before any html lines that might trigger events.
// Keep the score  and manage question 8 - which is only visible when score > 0

var no_qs = 8; // number of questions in the form

 // php code isn't executed from an included js file, so put these in the calling file.
 // 'cause the server side doesn't parse this file and execute the php before sending to client

var all_scores = [0,0,0,0,0,0,0,0];
var changes_made = false; 
var question = null;  //the element that holds the 8th question
var all_answered = [false, false, false, false, false, false, false, false];
var place = null; // where stuff should go on the form
var the_total_text = null; //where the total itself is displayed
var total_digits = null;  //element to hold the displayed digits
var view_start = true; // edit is starting up, we need to read in the previous scores from DB
var str_score_analysis = [" " + xl("Lower Normal Daytime Sleepiness"), " " + xl("Higher Normal Daytime Sleepiness"), " " + xl("Mild Excessive Daytime Sleepiness"), " " + xl("Moderate Excessive Daytime Sleepiness"), " " + xl("Severe Excessive Daytime Sleepiness")];


// function update_score - display new total score - check if question 8 should be displayed
// @param int index  question being answered, is 'undef' if we simply want to display the score, e.g. on startup
// @param int new_score is 'undef' if it's from clicking 'please select an answer' in a new form - treat as zero.
// @return true|false
function update_score(index, new_score) {  //index is the number of the question, score it's score
    var score = new_score;
    var explanation ='';
    var total_string = '';
     
    if (index == 'undef'){
        // display score  - called from view on startup - 'new_score' is previous total
        ess_score = score;
    }

    if (index != "undef"){
    // replace score for each question - could just save it and add them all up again in a loop of course
       if (score != 'undef'){
            all_answered[index]=true;
       }
       else {
           score = 0; /* for the purposes of calculating total - if question reset to 'please input..' */
           all_answered[index]=false;
       }
       if (score != 'undef' ){ // undef is default value, i.e. no answer chosen - for new forms
            ess_score = ess_score - Number(all_scores[index]);
            all_scores[index] = Number (score);
            ess_score = ess_score + Number(all_scores[index]) ;
        }
    }
    // decide which explanatory string to dispay for the new score
    if (ess_score < 6 ) explanation = str_score_analysis[0];
    else if (ess_score <11) explanation = str_score_analysis[1];
    else if (ess_score <13) explanation = str_score_analysis[2];
    else if (ess_score <16) explanation = str_score_analysis[3];
    else explanation = str_score_analysis[4];
    
    
    // create string to be display - the score plus the explanation
    total_string = ess_score+" - "+explanation;
    if (total_digits) {//   replace previous total with new one
        total_digits.innerText = total_string;
    }
    else{ //or create a visible total
        total_digits = document.createElement("b");
        the_total_text = document.createTextNode(total_string);
        total_digits.appendChild(the_total_text);
        exp = document.createElement("span");
        exptext = document.createTextNode(explanation);
        exp.appendChild(exptext);
        place = document.getElementById("show_ess_score");
        place.parentNode.appendChild( total_digits, place);
    }
    //when the total is larger than zero if necessary create and display the 8th questions as well
    // - else delete it from the display
    return true;
}