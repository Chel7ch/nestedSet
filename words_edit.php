<?php
require_once("lb/bdstart.php");
bdstart();

require_once("template/header.php");
//require_once('template/sidebar.php');
require_once('lb/fu_word_input.php');
require_once('lb/fu_categorize.php');
?>
<!-- main -->
<div class="col-sm-offset-3 col-sm-9 margin30">
	<ul class="nav nav-tabs">
	    <li><a href="#Category" data-toggle="tab">Category</a></li>
		<li class="active"><a href="#Main" data-toggle="tab">Main</a></li>
		<li><a href="#Delete" data-toggle="tab">Delete</a></li>
		
	</ul>
<!-- Tab panes -->
	<div class="tab-content">
	    <!--Category-->
		<div class="tab-pane fade" id="Category">
		  <div class="col-sm-12 margin20">
		  <form class="form-horizontal" enctype="multipart/form-data" action="admin/ob_word_edit.php" method="post">
			<?php print_cat($ar_left_key,$ar_right_key,$ar_name,$ar_level,$count_cat)?>
		  </div>	
		</div>	
		<!--Main-->
		<div class="tab-pane fade in active" id="Main">
		<br>
			<div class="form-group col-sm-12 ">
				<?php engl_word("Слово","english","Транскрипция","transcription",$_POST['english'],$_POST['transcription'])?> 
				<?php rus_word("Перевод","russian","part_of_speech","col-sm-offset-0",$_POST['part_of_speech'],$_POST['russian'])?>
			</div>
			<div class="form-group col-sm-12">
				<?php rus_word("Перевод","russian2","part_of_speech2","col-sm-offset-5",$_POST['part_of_speech2'],$_POST['russian2'])?>
			</div>
			<div class="form-group col-sm-12">
				<?php rus_word("Перевод","russian3","part_of_speech3","col-sm-offset-5",$_POST['part_of_speech3'],$_POST['russian3'])?>
			</div>
			<div class="form-group col-sm-12 ">
				<?php rus_word_rus("Перевод","russian4","part_of_speech4","col-sm-offset-5","margin0",$_POST['part_of_speech4'],$_POST['russian4'])?>
			</div>
		<!--Irregular-->
			<div class="form-group col-sm-12">
				<?php engl_word("Past Simple","Past_Simp","Транскрипция","transcription2",$_POST['Past_Simp'],$_POST['transcription2'])?>
				<?php  mark_except($_POST['mark_except'])?>
			</div> 
			<div class="form-group col-sm-12">
				<?php engl_word("Past Participle","Past_Part","Транскрипция","transcription3",$_POST['Past_Part'],$_POST['transcription3'])?>
			</div>
			<div class="form-group col-sm-12">
				<?php engl_word("4 meaning of the word","meaning4","Транскрипция","transcription4",$_POST['meaning4'],$_POST['transcription4']) ?>
			</div>
		<!--Additionally-->
			<div class="form-group col-sm-12">
				<div class="col-sm-12 margin15">
				<?php ckeditor($_POST['description'])?></div>						
			</div>
		<!--Crossing-->
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
		
			<div class="form-group col-sm-12">
				<div class="col-sm-offset-8 col-sm-2 margin15 right">
				<label>УРОК №</label>
				</div>
				<div class="col-sm-2 margin15">
					<select name="lesson_num" class="form-control">
					<option value="531" selected>5.3.1.</option>
					<option value="532" >5.3.2.</option>
					</select>
				</div>
			</div>
		<!--Button edit-->
			<div class="form-group col-xs-12">
				<div class="col-sm-offset-1 col-xs-2 margin15">
				 <input type="hidden" name="english_old" value="<?php echo $_POST['english_old'] ?>">
				  <a href="index.php"  class="btn btn-primary btn-block margin-top20" >Закрыть</a>
				</div>
				<div class="col-sm-offset-3 col-xs-3 margin15">
				  <input type="submit" name="Past" class="btn  btn-block margin-top20" value="Coхранить изменения">
				</div>
				<div class="col-sm-offset-0 col-xs-3 margin15">
				<input name="Past7" type="hidden" value="Past300">
				<input type="submit" name="Past" class="btn btn_red btn-block margin-top20" value="Coхранить и вернуться">
				<input type='hidden' name='english_edit' value= '1'>
				</div>
			 </div>
	    </form>
		</div>
		<!--Delete-->
		<div class="tab-pane fade" id="Delete">	
		<form class="form-horizontal" enctype="multipart/form-data" action="admin/ob_word_edit.php" method="post">
			<div class="form-group col-sm-12 left_pad">
				<?php echo $_POST['english']."&nbsp;&nbsp;—&nbsp;&nbsp;".$_POST['russian'] ?>
			</div>
		<!--Button Del-->
			<div class="form-group">
				<div class="col-sm-offset-6 col-xs-2 right_pad">
					<input type="submit" class="btn btn_red btn-block margin-top20" value="Удалить">
					<input type='hidden' name='english_del' value= <?php echo $_POST['english']?>>
				</div>
			</div>
	    </form>
		</div>
    </div>
   <div class="bottom_pad"></div>
</div> 


<pre><?php print_r($_POST); ?></pre>
<?php
require_once('template/footer.php');
?>
