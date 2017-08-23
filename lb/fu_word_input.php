<?php
//функции вкладки word input 

function mark_except($select="")
{ ?>
<div class=" col-sm-2 col-md-2">
	<select name="mark_except" class="form-control">
		<option value="<?php echo$select?>" selected><?php echo$select?></option>
		<option value="ir_verb">Ir.verb</option>
		<option value="plural">plural</option>
		<option value="numeral">numeral</option>
		<option value="pronoun">pronoun</option>
		<option value="sup_lat.">superlative</option>
		<option value="compar.">comparative</option>
	</select>
</div>
<?php
}
//-------------------
function cross()
{
?>	
<option value="" selected>n/attribute</option>
<option value="syn">synonym</option>
<option value="ant">antonym</option>
<option value="idioms">idioms</option>
<option value="togeth">together</option>
<option value="look_like">look like</option>
<?php
}
//-------------------
function engl_word($word,$word_name,$trans,$trans_name,$word_value="",$trans_value="")
{
?>	
<div class="col-sm-3">
<input type="text" name="<?php echo $word_name?>" class="form-control" id="fatherName" placeholder="<?php echo$word?>"  value="<?php echo$word_value?>">
</div>
<div class="col-sm-2">
<input type="text" name="<?php echo$trans_name?>" class="form-control" id="fatherName" placeholder="<?php echo$trans?>" value="<?php echo$trans_value?>">
</div>
<?php
}
//-------------------
function parts_of_speech($part_value)
{ 
if(!isset($part_value) or $part_value=="")
$part="Part of speech";
else $part=$part_value;
?>
<option value="<?php echo$part_value?>" selected><?php echo$part?></option>
<option value="noun">noun</option>
<option value="verb">verb</option>
<option value="adj.">adjective</option>
<option value="adv.">adverb</option>
<option value="conj.">conjunction</option>
<option value="prep.">preposition</option>
<option value="pron.">pronoun</option>
<option value="interj.">interjection</option>
<option value="num.">numeral</option>
<?php
}
//-------------------
function rus_word($word_r,$word_name_r,$part_of_speech,$offset="col-sm-offset-0",$part_value="",$word_r_value="")
{
?>	
<div class="<?php echo$offset?> col-sm-2 ">
<select name="<?php echo $part_of_speech?>" class="form-control">
<?php parts_of_speech($part_value)?>
</select>
</div>
<div class="col-sm-3">
<input type="text" name="<?php echo$word_name_r?>" class="form-control" id="fatherName" placeholder="<?php echo$word_r?>" value="<?php echo$word_r_value?>">
</div>
<?php
}
//-------------------
function parts_of_speech_rus($part_value)
{
if(!isset($part_value) or $part_value=="")
$part="ч.речи";
else $part=$part_value;	
?>
<option value="<?php echo$part_value?>" selected><?php echo$part?></option>
<option value="noun">сущ.</option>
<option value="verb">глаг.</option>
<option value="adj.">прил.</option>
<option value="adv.">нареч.</option>
<option value="conj.">союз</option>
<option value="prep.">предл.</option>
<option value="pron.">мест.</option>
<option value="interj.">междометие</option>
<option value="num.">числит.</option>
<?php
}
//-------------------
function rus_word_rus($word_r,$word_name_r,$part_of_speech,$offset="col-sm-offset-0",$margin="",$part_value="",$word_r_value="")
{
?>	
<div class="<?php echo$offset?> col-sm-2 <?php echo$margin?>">
	<select name="<?php echo$part_of_speech?>" class="form-control">
		<?php parts_of_speech_rus($part_value)?>
	</select>
</div>
<div class="col-sm-3 <?php echo$margin?>">
	<input type="text" name="<?php echo$word_name_r?>" class="form-control" id="fatherName" placeholder="<?php echo$word_r?>" value="<?php echo$word_r_value?>">
</div>
<?php
}
//-------------------
function ckeditor($description="")
{
?>	
<textarea name="description" class="form-control" id="editor1" ><?php echo "$description"?></textarea>
<script type="text/javascript">
 CKEDITOR.replace( 'editor1',{placeholder : 'Пояснение'} );
</script>

<?php
}
//-------------------
function input_safeguard($input="")
{
$input = htmlspecialchars(addslashes(trim($input)));
return $input;
}
?>