<?php require_once('lb/fu_word_input.php');?>
<!--модальное окно -->
<div id="myModal<?php echo $row['number'] ?>" class="modal fade">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	 <div class="modal-body">
	  <div class="row ">
	  <?php include("admin/ob_onceWordModal.php");?>
	    <div class="batton_modal">
		<?php //отправка данных
			 $array_word = array('english_old'=>$row['english'],'english'=>$row['english'],'transcription'=>$row['transcription'],
			 'Past_Simp'=>$row['Past_Simp'],'transcription2'=>$row['transcription2'],'Past_Part'=>$row['Past_Part'],
			 'transcription3'=>$row['transcription3'],'meaning4'=>$row['meaning4'],'transcription4'=>$row['transcription4'],
			 'mark_except'=>$row['mark_except'],'part_of_speech'=>$row['part_of_speech'],
			 'russian'=>$row['russian'],'part_of_speech2'=>$row['part_of_speech2'],'russian2'=>$row['russian2'],
			 'part_of_speech3'=>$row['part_of_speech3'],'russian3'=>$row['russian3'],'part_of_speech4'=>$row['part_of_speech4'],
			 'russian4'=>$row['russian4'], 'description'=>$row['description']);
		?>
		<form action="words_edit.php" method="post" name="form">
			<?php foreach($array_word as $key => $val)
			{
			  echo "<input type='hidden' name='$key' value='$val'>";
			} 
			?>
			 <input type="submit" class="btn btn_red" value="Редактировать">
	    </form>
        </div>
	  </div>
	 </div>
	</div>
  </div>
</div>
  
	
	
	

