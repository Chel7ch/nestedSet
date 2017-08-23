<?php
require_once('lb/fu_onceWordModal.php');
?>	
<div class="col-sm-12">
	<div class="col-sm-8">
	<!-- word-->
	<?php main_window($row['english'],$row['transcription'],$row['Past_Simp'],$row['transcription2'],$row['Past_Part'],$row['transcription3'],$row['meaning4'],$row['transcription4'],$row['part_of_speech'],$row['russian'],$row['part_of_speech2'],$row['russian2'],$row['part_of_speech3'],$row['russian3'],$row['part_of_speech4'],$row['russian4']);?>	
	<!-- explanations-->
	<?php explanations($row['description']);?>
	<!-- /explanations-->
	</div>
	<div class="col-sm-4">
		<?php
		onceWordModal(syn,$row['english'],Синонимы,"panel-danger");
		onceWordModal(ant,$row['english'],Антонимы,"panel-danger");
		onceWordModal(idioms,$row['english'],Идиомы,"panel-success");
		onceWordModal(togeth,$row['english'],Вместе,"panel-warning");
		onceWordModal(look_like,$row['english'],Похожие,"panel-danger");
		?>			
	</div >
</div >	