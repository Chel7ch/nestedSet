<?php
require_once("lb/bdstart.php");
bdstart();
//require_once("lb/mysql.php");
require_once("template/header.php");
//require_once('template/sidebar.php');
require_once('lb/fu_index.php');
require_once('lb/fu_onceWordModal.php');
?>

<!-- main -->
<div class="container">
	<div class="row">
		<div class="col-sm-offset-3 col-sm-9">

<?php 
$result = mysql_query('SELECT * FROM words WHERE lesson_num < 600 ORDER BY english');
		if(!$result) die ('Ошибка базы данных'.mysql_error());
		while ($row = mysql_fetch_array($result))
		{ 
	    $string = $row['english'];
	    $string = $string[0];//первый символ слова
			if (!isset($_GET['alf']) or $_GET['alf']=="")//вывод всех слов
			{
				echo'<a href="#myModal'.$row['number'].'" data-toggle="modal"><b class="en_word">'.$row['english']."</b></a>"."&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;".$row['russian']."____".$row['lesson_num']."<br>";
				//echo"<a href='onceWordModal1.php?english=".$row['english']."'><b class='en_word'>".$row['english']."</b></a>"."&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;".$row['russian']."____".$row['lesson_num']."<br>";
			include('template/modal.php');	
			}			
			//$sign=iconv("ASCII", "UTF-8",$string[0]);	
		if (isset($_GET['alf']) and strtolower($string)==strtolower($_GET['alf']))//вывод списка слов по алфавиту
		    {
				echo'<a href="#myModal'.$row['number'].'" data-toggle="modal"><b class="en_word">'.$row['english']."</b></a>"."&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;".$row['russian']."____".$row['lesson_num']."<br>";
								
			//modal_word($row['number'],$row['english'],$row['transcription'],$row['Past_Simp'],$row['transcription2'],$row['Past_Part'],$row['transcription3'],$row['part_of_speech'],$row['russian'],$row['part_of_speech2'],$row['russian2'],$row['part_of_speech3'],$row['russian3'],$row['part_of_speech4'],$row['russian4'],$row['description']);	
			include('template/modal.php');
			}	
		}
?>		
		</div>
	</div>
</div>










	<!-- /main -->
<?php
require_once('template/footer.php');
?>