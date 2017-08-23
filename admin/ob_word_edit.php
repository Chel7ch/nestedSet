<?php
require_once("../lb/bdstart.php");
bdstart();
require_once('../lb/fu_word_input.php');
//обработчик редактируемого слова и перезапись его в БД ;
// удаление слова из БД;
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<pre><?php // print_r($_POST); ?></pre>
<?php 
// edit
if (isset($_POST['english_edit']) and $_POST['english_edit']=1)
{	

	//убираем пробелы,  экранируем спецсимволы
	$english_old =  input_safeguard($_POST['english_old']);
	$english =  input_safeguard($_POST['english']);
	$transcription =  input_safeguard($_POST['transcription']);
	$Past_Simp =  input_safeguard($_POST['Past_Simp']);
	$transcription2 =  input_safeguard($_POST['transcription2']);
	$Past_Part =  input_safeguard($_POST['Past_Part']);
	$transcription3 =  input_safeguard($_POST['transcription3']);
	$meaning4 =  input_safeguard($_POST['meaning4']);
	$transcription4 =  input_safeguard($_POST['transcription4']);
	$mark_except =  input_safeguard($_POST['mark_except']);
	$part_of_speech =  input_safeguard($_POST['part_of_speech']);
	$russian =  input_safeguard($_POST['russian']);
	$part_of_speech2 =  input_safeguard($_POST['part_of_speech2']);
	$russian2 =  input_safeguard($_POST['russian2']);
	$part_of_speech3 =  input_safeguard($_POST['part_of_speech3']);
	$russian3 =  input_safeguard($_POST['russian3']);
	$part_of_speech4 =  input_safeguard($_POST['part_of_speech4']);
	$russian4 =  input_safeguard($_POST['russian4']);
	//$description =  input_safeguard($_POST['description']);
	$lesson_num =  input_safeguard($_POST['lesson_num']);
	$description = $_POST['description'];// !!!не защищено hss
	
	$query="UPDATE words SET english='$english',transcription='$transcription',Past_Simp='$Past_Simp',transcription2='$transcription2',
	Past_Part='$Past_Part',transcription3='$transcription3',meaning4='$meaning4',transcription4='$transcription4',mark_except='$mark_except',part_of_speech='$part_of_speech',
	russian='$russian',part_of_speech2='$part_of_speech2',russian2='$russian2',part_of_speech3='$part_of_speech3',
	russian3='$russian3',part_of_speech4='$part_of_speech4',russian4='$russian4',description='$description' WHERE english='$english_old'";
	$result2 = mysql_query($query);

	/*	if(transcription!=$transcription) THEN	
	require_once("ob_category.php");// обработка вкладки category	
	require_once("ob_crossing.php");// обработка вкладки crossing	
	*/	   
	// Проверяем ошибки						
			if(!$result2) { die ('Ошибка базы данных' . mysql_error()); }
			else {
				echo "слово &nbsp;&nbsp;&nbsp;".$english."&nbsp;&nbsp;&nbsp;отредактировано". '<br/>';
				echo "слово". $row['Past']. '<br/>';
				exit("переход через 1 сек "."<html><head><meta http-equiv='Refresh' content='1; URL=../words_edit.php'></head></html>");
			}
}
//  /edit		
// delete
if (isset($_POST['english_del']))
{	
	$query="DELETE FROM words WHERE english='$_POST[english_del]'";
	$result = mysql_query($query);
			if(!$result) { die ('Ошибка базы данных' . mysql_error()); }
			else {
				echo "слово &nbsp;&nbsp;&nbsp;".$_POST['english_del']."&nbsp;&nbsp;&nbsp;удалено". '<br/>';
				exit("переход через 1 сек "."<html><head><meta http-equiv='Refresh' content='1; URL=../index.php'></head></html>");
			}	
}
//  /delete
?>

</body>
</html>