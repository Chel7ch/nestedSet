 <?php
require_once('../lb/fu_categorize.php');

//занесение слов вкладки Category в бд

for($i=0; $i++<=$count_cat*2;)
{ 
				$cat="cat".$i;	
				$cat_name= htmlspecialchars(addslashes(trim($_POST["$cat"])));
				$english_cat= htmlspecialchars(addslashes(trim($_POST['english'])));
					
	if( isset($english) and isset($cat_name)and $cat_name!="")
	{
				$query = "INSERT INTO cat ( eng_word ,cat_name )
								VALUES ('$english_cat','$cat_name')";
			$result = mysql_query($query);	
            if(!$result) { die ('Ошибка базы данных' . mysql_error());}
	} 
	
}
?>
