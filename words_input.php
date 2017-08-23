<?php
require_once("lb/bdstart.php");
bdstart();

require_once("template/header.php");
require_once('template/sidebar.php');
require_once('lb/fu_word_input.php');
require_once('lb/fu_categorize.php');
?>
<!-- main -->
<div class="col-sm-offset-3 col-sm-9 margin30">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#Main" data-toggle="tab">Main</a></li>
		<li><a href="#Irregular" data-toggle="tab">Irregular</a></li>
		<li><a href="#Additionally" data-toggle="tab">Additionally</a></li>
		<li><a href="#Crossing" data-toggle="tab">Crossing</a></li>
		<li><a href="#Category" data-toggle="tab">Category</a></li>
	</ul>
<!-- Tab panes -->
	<div class="tab-content">
		<!--Main-->
		<div class="tab-pane fade in active" id="Main">
		<br>
		<form class="form-horizontal" enctype="multipart/form-data" action="admin/ob_words_input.php" method="post">
			<div class="form-group col-sm-12">
				<?php engl_word("Слово","english","Транскрипция","transcription") ?> 
				<?php rus_word("Перевод","russian","part_of_speech")?>
			</div>
			<div class="form-group col-sm-12">
				<?php rus_word("Перевод","russian2","part_of_speech2","col-sm-offset-5")?>
			</div>
		</div>
		<!--Irregular-->
		<div class="tab-pane fade" id="Irregular">
			<div class="form-group col-sm-12">
				<?php engl_word("Past_Simple","Past_Simp","Транскрипция","transcription2") ?>
				<?php  mark_except()?>
			</div> 
			<div class="form-group col-sm-12">
				<?php engl_word("Past Participle","Past_Part","Транскрипция","transcription3") ?>
			</div>
			<div class="form-group col-sm-12">
				<?php engl_word("4 meaning of the word","meaning4","Транскрипция","transcription4") ?>
			</div>
		</div>
		<!--Additionally-->
		<div class="tab-pane fade" id="Additionally">
			<div class="form-group col-sm-12">
				<?php rus_word("Перевод","russian3","part_of_speech3","col-sm-offset-6")?>
			</div>
			<div class="form-group col-sm-12">
				<?php rus_word_rus("Перевод","russian4","part_of_speech4","col-sm-offset-6","margin0")?>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
				<?php ckeditor()?>
				</div>						
			</div>
			<div class="form-group col-sm-12">
				<div class="col-sm-offset-8 col-sm-2 margin15 right">
				<label>УРОК №</label>
				</div>
				<div class="col-sm-2 margin15">
					<select name="lesson_num" class="form-control">
					<option value="522" selected>5.4.4.</option>
					<option value="544" >5.4.4.</option>
					</select>
				</div>
			</div>
		</div>
		<!--Crossing-->
		<div class="tab-pane fade" id="Crossing">
		<?php for($i=1;$i<6;$i++):
		$eng_other="eng_other".$i;
		$trans_other="trans_other".$i;
		$russ_other="russ_other".$i;
		$part_other="part_other".$i;
		$cross="cross".$i;?>
			<div class="form-group col-sm-12">
				<?php engl_word("Слово","$eng_other","Транскрипция","$trans_other") ?>
				<?php rus_word("Перевод","$russ_other","$part_other")?>
				<div class="col-sm-2 ">
					<select name="<?php echo $cross?>" class="form-control">
					<?php cross()?>
					</select>
				</div>	
			</div>
		<?php endfor; ?>
		</div> 
		<!--Category-->
		<div class="tab-pane fade" id="Category">
			<?php print_cat($ar_left_key,$ar_right_key,$ar_name,$ar_level,$count_cat)?>
		</div>	
		<!--Button ot input-->
		<div class="form-group">
			<div class="col-sm-offset-2 col-xs-9 margin15">
				<input type="submit" class="btn btn-primary btn-block margin-top20" value="Ввести">
			</div>
		</div>
	    </form>	
    </div>
   <div class="bottom_pad"></div>
</div>   
<?php
require_once('template/footer.php');
?>
