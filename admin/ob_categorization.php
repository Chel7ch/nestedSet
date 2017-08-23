<?php
require_once("../lb/bdstart.php");
bdstart();
// обработчик создания , удаления, редактирования категорий (пунктов меню)

if(isset($_POST['name']) AND isset($_POST['right_key']))//add  in categorization в бд
{
$name = $_POST['name'];
$right_key= $_POST['right_key'];
$level= $_POST['level'];

    $query = "UPDATE categores SET left_key = left_key + 2, right_key = right_key + 2 WHERE left_key > $right_key";
	$result_cat = mysql_query($query);
	if(!$result_cat) die ('Ошибка базы данных'.mysql_error());
	$query1 = "UPDATE categores SET right_key = right_key + 2 WHERE right_key >= $right_key AND left_key < $right_key";
	$result_cat1 = mysql_query($query1);
	if(!$result_cat1) die ('Ошибка базы данных'.mysql_error());
	
    $query2 = "INSERT INTO categores (name,left_key,right_key,level) VALUES('$name','$right_key',$right_key + 1,$level + 1)";
	$result_cat2 = mysql_query($query2);
	if(!$result_cat2) die ('Ошибка базы данных'.mysql_error());
	
			echo 'Категория  добавлена'.'<br/>';
			exit("переход через 2 сек "."<html><head><meta http-equiv='Refresh' content='0; URL=../categor_input.php'></head></html>");
	// end add  in categorization в бд	
}	
if(isset($_POST['del_right_key']) AND isset($_POST['del_left_key']))//del  categorization в бд
{
	
$del_right_key = $_POST['del_right_key'];
$del_left_key = $_POST['del_left_key'];
intval ($del_right_key);
intval ($del_left_key);
$d_right_key = $del_right_key - $del_left_key + 1;
$d_left_key = $del_right_key - $del_left_key + 1;

	 $query = "DELETE FROM categores WHERE left_key >= $del_left_key AND right_key <= $del_right_key";
	$result_cat = mysql_query($query);
	if(!$result_cat) die ('Ошибка базы данных'.mysql_error());
	
    $query = "UPDATE categores SET right_key = right_key - $d_right_key  WHERE right_key > $del_right_key AND left_key < $del_left_key ";
	$result_cat = mysql_query($query);
	if(!$result_cat) die ('Ошибка базы данных2'.mysql_error());
	/**/
	$query = "UPDATE categores SET left_key = left_key-$d_left_key , right_key = right_key-$d_right_key WHERE left_key > $del_right_key ";
	$result_cat = mysql_query($query);
	if(!$result_cat) die ('Ошибка базы данных33'.mysql_error());
			echo 'Категория  удалена'.'<br/>';
			exit("переход через 2 сек "."<html><head><meta http-equiv='Refresh' content='0; URL=../categor_input.php'></head></html>");
	// end del  in categorization в бд	
}	

if(isset($_POST['edit_right_key']) AND isset($_POST['edit_left_key']))//edit  categorization в бд
{
$edit_right_key = $_POST['edit_right_key'];
$edit_left_key = $_POST['edit_left_key'];
/*intval ($del_right_key);
intval ($del_left_key);
$d_right_key = $del_right_key - $del_left_key + 1;
$d_left_key = $del_right_key - $del_left_key + 1;*/

	 $query = "UPDATE my_tree SET right_key = right_key + $skew_tree WHERE right_key < $left_key AND right_key > $right_key_near";
	$result_cat = mysql_query($query);
	if(!$result_cat) die ('Ошибка базы данных'.mysql_error());
	
    $query = "UPDATE my_tree SET left_key = left_key + $skew_tree WHERE left_key < $left_key AND left_key > $right_key_near";
	$result_cat = mysql_query($query);
	if(!$result_cat) die ('Ошибка базы данных2'.mysql_error());
	
	$query = "UPDATE my_tree SET left_key = left_key + $skew_edit, right_key = right_key + $skew_edit, level = level + $skew_level WHERE id IN ($id_edit) ";
	$result_cat = mysql_query($query);
	if(!$result_cat) die ('Ошибка базы данных33'.mysql_error());
			echo 'Категория  удалена'.'<br/>';
			exit("переход через 2 сек "."<html><head><meta http-equiv='Refresh' content='0; URL=../categor_input.php'></head></html>");
	// end edit  in categorization в бд	
}
?>
