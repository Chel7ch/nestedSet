<?php// пока не используется 
// функции вывода слов

// преобразование выборки из БД в массивы
function get_words() 
{
	$query = "SELECT * FROM words JOIN togeth ON words.english=togeth.eng_w_other WHERE english = 'curl'";
	$result = mysql_query($query);
	if(!$result) die ('Ошибка базы данных'.mysql_error());
	
	$arr_cat = array();
	$ar_level = array();
	$ar_name = array();
	$ar_left_key = array();
	$ar_right_key = array();
	while ($row = mysql_fetch_array($result,MYSQL_ASSOC))
	{
			$arr_cat[$row['left_key']][] = $row;
			$ar_name[] = $row['name'];
			$ar_level[] = $row['level'];
			$ar_left_key[] = $row['left_key'];
			$ar_right_key[] = $row['right_key'];
	}	
	$count_cat=count($ar_left_key);
	
	return array ($arr_cat,$ar_name,$ar_level,$ar_left_key,$ar_right_key,$max_level,$count_cat);
}	
list($arr_cat,$ar_name,$ar_level,$ar_left_key,$ar_right_key,$max_level,$count_cat)= get_cat() ;

?>