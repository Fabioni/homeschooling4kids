<?php
function abfrage_shortcode_func_radio($richtig = "", $group){
	$id = uniqid("radio");
	return <<<EOD
<input id="$id" class="fabian-check-me" type="radio" name="name_$group" data-result='$richtig'><label for="$id"></label>
EOD;
}

function abfrage_shortcode_func_select($richtig = "", $vorschläge = array(), $content=""){

	$options = "";
	foreach ($vorschläge as $v){
		$options .= "<option value='$v'>$v</option>";
	}

	return <<<EOD
<select data-result='$richtig' value='$content' class="fabian-check-me style_unterstrich">
	<option value=""></option>
 	$options
</select>
EOD;
}

function abfrage_shortcode_func_checkbox($richtig = false){
	$id = uniqid("checkbox");
	return <<<EOD
<input id="$id" class="fabian-check-me" type="checkbox" data-result='$richtig'><label for="$id"></label>
EOD;

}

function abfrage_shortcode_func_numbertext($type="text", $richtig, $content = "", $max="", $min="", $länge ="")
{
	if ($type == "text") {
		return <<<EOD
<input type="$type" data-result="$richtig" class="fabian-check-me" size="$länge" value="$content">
EOD;
	} else {
		return <<<EOD
<input type="$type" data-result="$richtig" class="fabian-check-me" size="$länge" value="$content" max="$max" min="$min">
EOD;
	}
}


function abfrage_shortcode_func( $atts, $content ) {
	$type = "checkbox";

	if (isset($atts["vorschlaege"])){
		$type = "select";
	} elseif (isset($atts["richtig"])){
		if (is_numeric($atts["richtig"])){
			$type = "number";
		} else {
			$type = "text";
		}
	} elseif (isset($atts["gruppe"])){
		$type = "radio";
	}

	$a = shortcode_atts( array(
		'vorschlaege' => "",
		'laenge' => "",
		'richtig' => "",
		'gruppe' => "",
		'max' => "999",
		'min' => "-999"
	), $atts );

	$richtig = $a["richtig"];

	switch ($type){
		case "checkbox":
			return abfrage_shortcode_func_checkbox(is_array($atts) && in_array("richtig", $atts));
			break;
		case "radio":
			return abfrage_shortcode_func_radio(in_array("richtig", $atts), $a["gruppe"]);
			break;
		case "select":
			$vorschläge = explode(', ', $a["vorschlaege"]);
			return abfrage_shortcode_func_select($richtig, $vorschläge, $content);
			break;
		case "text":
			return abfrage_shortcode_func_numbertext("text", $a["richtig"], $content, "", "", $a["laenge"]);
			break;
		case "number":
			return abfrage_shortcode_func_numbertext("number", $a["richtig"], "", $a["max"], $a["min"]);
			break;
		default:
			return "FEHLER";
	}



	/*$id = uniqid("abfrage_input");
	return print_r($atts, true) . <<<EOD
<input list='$id' data-result='$richtig' width="$a[laenge]" type='text' value='$content' class="fabian-check-me style_unterstrich">
<datalist id="$id">
	$options
</datalist>
EOD;
*/
}
add_shortcode( 'abfrage', 'abfrage_shortcode_func' );

function abfrage_prüfen_shortcode_func( $atts, $content ) {
	$parent = false;
	if (is_array($atts) && in_array("parent", $atts)){
		$parent = true;
	}
	$a = shortcode_atts( array(
		"style" => "",
		"parent" => $parent
	), $atts );
	$style = $a["style"];
	$parent = $a["parent"];
	if ($content == "") $content = "Prüfen";

	$id = uniqid("check_button");

	$selector = "jQuery(this)";
	if ($parent != false){
		if ($parent === true) {
			$selector = "jQuery('#$id')";
		} else {
			$selector = "(jQuery(this).closest('$parent').size() > 0 ? jQuery(this).closest('$parent') : jQuery(this))";
		}
	}


	return <<<EOD
<button id="$id" style="$style" class="aligncenter fabian_check_me_submit">$content</button>
<script>
jQuery(function() {
  jQuery("#$id").click(function() {
    var fehler = 0;
    jQuery('.fabian-check-me').each(function(index){{$selector}.removeClass('checked_richtig').removeClass("checked_falsch")});
	jQuery('.fabian-check-me').each(function(index){if (jQuery(this).data('result') == jQuery(this).val() || jQuery(this).data('result') == jQuery(this).is(':checked')) {if (! {$selector}.hasClass('checked_falsch')) {$selector}.addClass('checked_richtig');} else {{$selector}.addClass('checked_falsch').removeClass('checked_richtig'); fehler+=1}});
	jQuery('.fabian-check-me').change(function(){{$selector}.removeClass('checked_falsch').removeClass('checked_richtig')});

	toastr.options = {
		"newestOnTop": true,
		"progressBar": true,
		"preventDuplicates": true,
		"extendedTimeOut": "1000"
	}

	if (fehler > 0)	{
	  toastr["warning"]("Versuche es noch einmal", fehler + " Fehler");
	} else {
	  toastr["success"]("Alles ist richtig", "Wunderbar");
	}
  })
})
</script>
EOD;


}
add_shortcode( 'abfrage_prüfen', 'abfrage_prüfen_shortcode_func' );
