<?php
require('constants.php');
require_once(ABS_PATH.INC_PATH.'functions.php');
if(isset($num, $frage, $type, $type_long)) :
	$type_long = ($type == "f" ? "freundesfragen" : "eigeneFragen");
return <<<TR
<tr>
	<td>
		<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="$type-frage-$num">
			<input type="checkbox" data-category="$type_long" id="$type-frage-$num" class="mdl-checkbox__input" name="$type-frage-$num">
		</label>
	</td>
	<td class="frage">$frage</td>
</tr>
TR;
else : error('clientError', 400, 'Bad Request');
endif;
?>
