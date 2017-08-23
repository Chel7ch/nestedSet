<?php
// функции  категорий

// преобразование выборки из БД в массив
function get_cat() 
{
	$query = "SELECT * FROM  categores ORDER by left_key ";
	$result_cat = mysql_query($query);
	if(!$result_cat) die ('Ошибка базы данных'.mysql_error());
	
	$arr_cat = array();
	$ar_level = array();
	$ar_name = array();
	$ar_left_key = array();
	$ar_right_key = array();
	while ($row = mysql_fetch_array($result_cat,MYSQL_ASSOC))
	{
			$arr_cat[$row['left_key']][] = $row;
			$ar_name[] = $row['name'];
			$ar_level[] = $row['level'];
			$ar_left_key[] = $row['left_key'];
			$ar_right_key[] = $row['right_key'];
	}	
	$max_level=max ($ar_level);
	$count_cat=count($ar_left_key);
	
	return array ($arr_cat,$ar_name,$ar_level,$ar_left_key,$ar_right_key,$max_level,$count_cat);
}	
list($arr_cat,$ar_name,$ar_level,$ar_left_key,$ar_right_key,$max_level,$count_cat)= get_cat() ;


//  echo sidebar для тупикового узла и для не тупикового 
function print_submenu($left_k,$right_k,$name)
{
  if( $left_k+1 == $right_k):?> 
  <li class="menu__item"><a class="menu__link" href="index.php?cat=<?php echo $name?>"><?php echo $name."__".$left_k;?></a></li>
<? else:?>
  <li class="menu__item"><a class="menu__link" data-submenu="submenu-<?php echo $left_k ?>" href="http://index.php?cat=<?php echo $name?>"><?php echo $name."__".$left_k;?></a></li>
<? endif;	
}
//href="index.php?cat=<?php echo $name"
//  вывод вкладки Category  input_words
function print_cat($left_k,$right_k,$name,$level,$count)
{
 for($i=1; $i<=$count-1; $i++):?>
	<?php $offset= $level[$i]-2;?>
		<div class="form-group col-sm-12">
			<button type="button" class="btn btn-primary col-sm-2 btn-sm col-sm-offset-<?php echo $offset;?> "><?php echo $name[$i]." left".$left_k[$i]." right".$right_k[$i]?></button>
			<div class=" col-sm-3">
				<input type="checkbox" id="cat<?php echo $left_k[$i];?>"  value="<?php echo $name[$i];?>"> <label for="<?php echo $left_k[$i];?>">Выбрать</label>
			</div>
		</div>	
<?php endfor;?>

<?php
 }					

?>