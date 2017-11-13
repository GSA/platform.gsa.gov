<?php
/*
 * @wordpress-plugin
 * Plugin Name:       eCPIC Password Aid
 * Plugin URI:        http://www.ctacorp.com
 * Description:       This plugin is currently specific to the eCPIC website. This will add a Password Generator and automated Suggestion utility to the Reset Password screen.
 * Version:           1.0
 * Author:            Phillihp Harmon
 * Author URI:        http://www.phillihp.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
function ecpic_custom_login_head() { ?>
<style>
  /*#login{max-width:1038px;min-width:780px;}*/
	#nav,#backtoblog{text-align: center;}
	#pw-header{text-align: center;margin:10px 0;}
	#pw-generator,
	#pw-suggestions,
	#resetpassform{display:inline-block;vertical-align: top;margin:0;text-align: left;}
	#resetpassform{width:320px;}
	.reset-show{display:block;}
	#pw-generator.reset-hide{display:none !important;}
	.login #pass-strength-result{width:308px;}
	#resetpw-container{text-align: center;background:#fff;border:1px solid #ccc;}
	@media(max-width:450px){
		#login{width: 100%;min-width:320px;max-width:450px;}
		#pw-generator,
		#pw-suggestions,
		#resetpassform{display:block !important;}
	}
</style>
<script>
jQuery(function() {
	
	if(jQuery("#pass1").length > 0) {
	  	jQuery("#login").css({"max-width":"1038px","min-width":"780px"});
		jQuery(".reset-pass").hide();
		//jQuery("#nav").before(jQuery("</div>"));
		//jQuery("#resetpassform").before(jQuery(""));
		jQuery("#resetpassform").before(jQuery("<div id='resetpw-container'></div>"));
		jQuery("#resetpassform").before(jQuery("<div id='pw-header'>Change your password<br/><a href=\"#\" class=\"toggle-generator\">(or click here to use a generator)</a></div>"));
		jQuery("#resetpassform").before(jQuery("<div id='pw-suggestions' style='padding: 10px; width: 300px; height: 385px; margin-left: 10px; background-color: white;'></div>"));
		jQuery("#pw-suggestions").append(jQuery("<h4 style='color: #777; border-bottom: 1px solid gray; margin-bottom: 5px;'>Suggestions</h4>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugLength'>Use at least 7 characters</div>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugUpperca'>Use a mixture of upper and lower case characters</div>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugNumbers'>Use numbers</div>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugSpecial'>Use special characters such as ! &quot; ? $ % ^ &amp; )</div>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugDictionary'>Avoid common words and names</div>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugSpatial'>Avoid keyboard sequences</div>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugRepeat'>Avoid repeating characters</div>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugSequence'>Avoid incremental sequences, such as &quot;abcde&quot;</div>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugDigits'>Avoid long digits such as phone numbers or ID's</div>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugYear'>Avoid using years, such as birth or anniversary years</div>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugDate'>Avoid using dates</div>"));
		jQuery("#pw-suggestions").append(jQuery("<div class='indiv suggest' id='sugBruteforce'>Avoid using common Brute Force patterns, such as &quot;aaaab&quot;</div>"));

		jQuery("#resetpassform").before(jQuery("<div id='pw-generator' class='reset-hide' style='padding: 10px; width: 300px; height: 385px; margin-right: 10px; background-color: white;'></div>"));

		jQuery("#pw-generator").append(jQuery("<h4 style='color: #777; border-bottom: 1px solid gray; margin-bottom: 5px;'>Password Generator</h4>"));
		jQuery("#pw-generator").append(jQuery("<div class='indiv'><div style='margin-bottom:5px;'>1. Define length of password</div><input size='3' id='inpLength' value='12' /> <label for='inpLength'>characters (at least 7)</label></div>"));
		jQuery("#pw-generator").append(jQuery("<div style='color:gray;padding:10px 4px;'>2. Choose your password</div>"));
		jQuery("#pw-generator").append(jQuery("<div id='passwords'></div>"));
		
		//jQuery("#pw-generator").append(jQuery("<div class='indiv'><input type='checkbox' checked id='chkUppercase' /> <label for='chkUppercase'>Uppercase</label></div>"));
		//jQuery("#pw-generator").append(jQuery("<div class='indiv'><input type='checkbox' checked id='chkNumbers' /> <label for='chkNumbers'>Numbers</label></div>"));
		//jQuery("#pw-generator").append(jQuery("<div class='indiv'><input type='checkbox' checked id='chkSpecial' /> <label for='chkSpecial'>Special Characters</label></div>"));
		jQuery("#pw-generator").append(jQuery("<div id='indiv'><input type='button' id='btnRefresh' value='Refresh Generator' /></div>"));
		jQuery("#resetpw-container").append(jQuery("#pw-header"));
		
		jQuery("#resetpw-container").append(jQuery("#pw-generator"));
		jQuery("#resetpw-container").append(jQuery("#resetpassform"));
		jQuery("#resetpw-container").append(jQuery("#pw-suggestions"));

		var special = /[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/;
		var numbers = /[0-9]/;
		var upperca = /[A-Z]/;
		jQuery("#pass1").bind("keyup change", function() {
			var text = this;
			jQuery(".suggest").each(function() {
				if(jQuery(text).val().length > 0) //added base requirement for any green
					sugTurnOn(jQuery(this).attr("id"));
				else
					sugTurnOff(jQuery(this).attr("id"));
			});

			// Custom Conditions
			if(jQuery(this).val().length > 7) sugTurnOn("sugLength"); else sugTurnOff("sugLength");
			if(special.test(jQuery(this).val())) sugTurnOn("sugSpecial"); else sugTurnOff("sugSpecial");
			if(numbers.test(jQuery(this).val())) sugTurnOn("sugNumbers"); else sugTurnOff("sugNumbers");
			if(upperca.test(jQuery(this).val())) sugTurnOn("sugUpperca"); else sugTurnOff("sugUpperca");
			
			res = zxcvbn(jQuery(this).val()).match_sequence;
			for(i = 0; i < res.length; i++) {
				sugType = "sug" + capitalizeFirstLetter(res[i].pattern);
				if(jQuery("#"+sugType).length > 0)
					sugTurnOff(sugType);
			}
		});
		jQuery("#btnRefresh").click(function() {
			generatePasswords();
		});
		jQuery(".toggle-generator").click(function(){
			if (jQuery('#pw-generator').is(":hidden")) {
				jQuery('#pw-generator').removeClass('reset-hide');
				jQuery('#pw-generator').addClass('reset-show');
				jQuery('#login').css('width','1038px');
				jQuery('a.toggle-generator').html('(or click here to manually enter your password)');
			}
			else
			{
				jQuery('#pw-generator').removeClass('reset-show');
				jQuery('#pw-generator').addClass('reset-hide');
				jQuery('#login').css('width','780px');
				jQuery('a.toggle-generator').html('(or click here to use a generator)');
			}
			return false;
		});
		generatePasswords();
	}
	if(jQuery("#pass1").length == 0 && window.location.href.indexOf("?action=resetpass") > -1) {
		jQuery("#backtoblog").before(jQuery("<p>Congratulations! Your password has been successfully reset. Please click the link below to login with your new password.</p>"));
	}
	if(jQuery("#resetpassform").length > 0) {
	  jQuery("#resetpassform").attr('action', "<?php echo site_url(); ?>/wp-login.php?action=resetpass");
	}
});

function applyIndiv() {
	jQuery(".indiv").each(function() {
		jQuery(this).css('padding', "4px");
		jQuery(this).css('color', "gray");
	});
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function sugTurnOn(elem) {
	jQuery("#"+elem).css('color', "green");
}

function sugTurnOff(elem) {
	jQuery("#"+elem).css('color', "gray");
}

function generatePasswords() {
	pwLength = parseInt(jQuery("#inpLength").val());
	if(pwLength < 7)
	{
		alert('Strong passwords must be at least 7 characters');
		jQuery("#inpLength").val(7);
		return;
	}
	jQuery("#passwords").empty();
	for(i = 0; i < 4; i++) {
		jQuery("#passwords").append(jQuery("<div class='indiv'><input value='" + password_generator(pwLength) + "' /> <input type='button' value='Select' class='sugSelect' /></div>"));
	}
	function b(){var b,c=jQuery("#pass1").val(),d=jQuery("#pass2").val();if(jQuery("#pass-strength-result").removeClass("short bad good strong"),!c)return void jQuery("#pass-strength-result").html(pwsL10n.empty);switch(b=wp.passwordStrength.meter(c,wp.passwordStrength.userInputBlacklist(),d)){case 2:jQuery("#pass-strength-result").addClass("bad").html(pwsL10n.bad);break;case 3:jQuery("#pass-strength-result").addClass("good").html(pwsL10n.good);break;case 4:jQuery("#pass-strength-result").addClass("strong").html(pwsL10n.strong);break;case 5:jQuery("#pass-strength-result").addClass("short").html(pwsL10n.mismatch);break;default:jQuery("#pass-strength-result").addClass("short").html(pwsL10n["short"])}}
	jQuery(".sugSelect").click(function() {
		jQuery("#pass1, #pass2").val(jQuery(this).prev().val());
		b();
		jQuery(".suggest").each(function() {
			if(jQuery("#pass1").val().length > 0) //added base requirement for any green
				sugTurnOn(jQuery(this).attr("id"));
			else
				sugTurnOff(jQuery(this).attr("id"));
		});
		// Custom Conditions
		var special = /[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/;
		var numbers = /[0-9]/;
		var upperca = /[A-Z]/;

		if(jQuery("#pass1").val().length > 7) sugTurnOn("sugLength"); else sugTurnOff("sugLength");
		if(special.test(jQuery("#pass1").val())) sugTurnOn("sugSpecial"); else sugTurnOff("sugSpecial");
		if(numbers.test(jQuery("#pass1").val())) sugTurnOn("sugNumbers"); else sugTurnOff("sugNumbers");
		if(upperca.test(jQuery("#pass1").val())) sugTurnOn("sugUpperca"); else sugTurnOff("sugUpperca");
		
		res = zxcvbn(jQuery("#pass1").val()).match_sequence;
		for(i = 0; i < res.length; i++) {
			sugType = "sug" + capitalizeFirstLetter(res[i].pattern);
			if(jQuery("#"+sugType).length > 0)
				sugTurnOff(sugType);
		}
	});
	applyIndiv();
}

function password_generator( len ) {
	var lng = (len)?(len):(12);
	var string = "abcdefghijklmnopqrstuvwxyz"; //to upper 
	var numeric = '0123456789';
	var punctuation = '!@#$%^&*()_+~`|}{[]\:;?><,./-=';
	var password = "";
	var character = "";
	var crunch = true;
	while( password.length<lng ) {
		entity1 = Math.ceil(string.length * Math.random()*Math.random());
		entity2 = Math.ceil(numeric.length * Math.random()*Math.random());
		entity3 = Math.ceil(punctuation.length * Math.random()*Math.random());
		hold = string.charAt( entity1 );
		hold = (entity1%2==0)?(
			//jQuery("#chkUppercase").is(":checked") ? hold.toUpperCase() : hold
			hold.toUpperCase()
			):(hold);
		character += hold;
		//if(jQuery("#chkNumbers").is(":checked"))
			character += numeric.charAt( entity2 );
		//if(jQuery("#chkSpecial").is(":checked"))
			character += punctuation.charAt( entity3 );
		
		password = character;
	}
	return password;
}
</script>
<?php }
//error_log(get_current_blog_id());
if(get_current_blog_id() == '71' && $GLOBALS['pagenow'] == 'wp-login.php'){
	add_action('login_head', 'ecpic_custom_login_head');
}
