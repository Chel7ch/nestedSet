<?php
require_once("../lb/bdstart.php");
bdstart();
require_once('../lb/fu_word_input.php');
//обработчик вводимого слова и запись его в БД
//If main
if (empty($_POST['english']) or empty($_POST['transcription']) or empty($_POST['russian']))
	{
		exit("Некоторые поля на вкладке Main не были заполнены, исправьте."."<html><head><meta http-equiv='Refresh' content='1; URL=../words_input.php'></head><body>");
	}
//If crossing
if ((!empty($_POST['eng_other1']) and empty($_POST['cross1'])) or (!empty($_POST['eng_other2']) and empty($_POST['cross2'])) or (!empty($_POST['eng_other3']) and empty($_POST['cross3'])) or (!empty($_POST['eng_other4']) and empty($_POST['cross4'])) or (!empty($_POST['eng_other5']) and empty($_POST['cross5'])))
	{
		exit("Некоторые поля на вкладке Crossing не были заполнены, исправьте."."<html><head><meta http-equiv='Refresh' content='1; URL=../words_input.php'></head><body>");
	}
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php 

require_once("img_loud_ob.php");// обработка загруженной картинки, обрезка	

//убираем пробелы,  экранируем спецсимволы
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

$result2 = mysql_query("INSERT INTO words (english,transcription,Past_Simp,transcription2,Past_Part,transcription3,meaning4,transcription4,mark_except,part_of_speech,russian,part_of_speech2,russian2,part_of_speech3,russian3,part_of_speech4,russian4,description,img_words,lesson_num,date) 
						VALUES ('$english','$transcription','$Past_Simp','$transcription2','$Past_Part','$transcription3','$meaning4','$transcription4','$mark_except','$part_of_speech','$russian','$part_of_speech2','$russian2','$part_of_speech3','$russian3','$part_of_speech4','$russian4','$description','$img_words','$lesson_num',NOW())");
		
require_once("ob_category.php");// обработка вкладки category	
require_once("ob_crossing.php");// обработка вкладки crossing	
	   
// Проверяем ошибки						
		if(!$result2) { die ('Ошибка базы данных' . mysql_error()); }
		else {
			echo "слово $eng_w_other добавлено". '<br/>';
			exit("переход через 1 сек "."<html><head><meta http-equiv='Refresh' content='1; URL=../words_input.php'></head></html>");
		}		

?>

</body>
</html>