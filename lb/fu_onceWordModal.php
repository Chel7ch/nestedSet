<?php
function onceWordModal($name_table,$word,$name,$color)
{
	$query="SELECT * FROM $name_table WHERE eng_w_other = '$word'";
	$result = mysql_query($query);
		if(!$result) die ('Ошибка базы данных'.mysql_error());
		$row = mysql_fetch_array($result);
		if($row[eng_other]!="")
		{	
?>
		<div class="left15 panel <?php echo $color ?>">
			<div class="panel-heading">
			  <h3 class="panel-title"><?php echo $name ?></h3>
			</div>
			<div class="panel-body">
			<span class="bold_left"><?php echo $row[eng_other]."</span>&nbsp;&nbsp;-&nbsp;&nbsp;"?><span class="owerflow"><?php echo $row[russ_other]?></span><br>
		<?php   
			while ($row = mysql_fetch_array($result))
		{ ?>
			<span class="bold_left"><?php echo $row[eng_other]."</span>&nbsp;&nbsp;-&nbsp;&nbsp;"?><span class="owerflow"><?php echo $row[russ_other]?></span><br>
		<?php 
		}
		?>
			</div>
		</div>
<?php			
		}
}	
// ----------------------
function explanations($explanations)
{
      if($explanations!=""):?>
		<div class="panel panel-info">
			<div class="panel-heading">
			  <h3 class="panel-title">Explanations/Разъяснения</h3>
			</div>
			<div class="panel-body"> 
			   <?php echo $explanations ?>
			</div>
		</div>
		<?php endif;
}		
// ----------------------
function main_window($english,$transcription,$past_simp,$transcription2,$past_part,$transcription3,$meaning4,$transcription4,$part_of_speech,$russian,$part_of_speech2,$russian2,$part_of_speech3,$russian3,$part_of_speech4,$russian4)
{
?>	
  <div class="panel panel-primary ">
		<div class="panel-heading">
		  <h3 class="panel-title">Слово</h3>
		</div>
		<div class="panel-body">
		<?php
		$query="SELECT * FROM words WHERE english = '$english'";
		$result = mysql_query($query);
				if(!$result) die ('Ошибка базы данных'.mysql_error());
			 $row = mysql_fetch_array($result);
		?>
		   <div class="main_word">
			    <?php echo $row[english]."&nbsp;".$row[transcription]?></br>
				<?php if($past_simp !="") echo $past_simp."&nbsp;".$transcription2."<br>" ?>
				<?php if($past_part !="") echo $past_part."&nbsp;".$transcription3."<br>" ?>			   
				<?php if($meaning4 !="") echo $meaning4."&nbsp;".$transcription4."<br>" ?>			   
			</div>					 
			<div class="main_desc">	 
				<?php echo $row[part_of_speech]."&nbsp;".$row[russian]?><br>					
				<?php if($russian2 !="") echo $part_of_speech2."&nbsp;".$russian2."<br>" ?>
				<?php if($russian3 !="") echo $part_of_speech3."&nbsp;".$russian3."<br>" ?>
				<?php if($russian4 !="") echo $part_of_speech4."&nbsp;".$russian4 ?>				
			</div>
		</div>
	</div>
<?php		
}	
?>	