<?php

//занесение слов вкладки crossing в бд

for($i=0; $i++<=4;)
{ 
				$eng_w_other= htmlspecialchars(addslashes(trim($_POST['english'])));
			    $cross= "cross".$i;
				$table= htmlspecialchars(addslashes(trim($_POST["$cross"])));
				$eng_other= "eng_other".$i;
				$eng_other= htmlspecialchars(addslashes(trim($_POST["$eng_other"])));
				$trans_other= "trans_other".$i;
				$trans_other= htmlspecialchars(addslashes(trim($_POST["$trans_other"])));
				$part_other = "part_other".$i;
				$part_other = htmlspecialchars(addslashes(trim($_POST["$part_other"])));
				$russ_other ="russ_other".$i;
				$russ_other =htmlspecialchars(addslashes(trim($_POST["$russ_other"])));
				
	if( isset($eng_other) and $eng_other!="" and isset($_POST["$cross"]) and $_POST["$cross"]!="" )
	{
				$query = "INSERT INTO $table (eng_w_other,eng_other,trans_other,part_other,russ_other)
								VALUES ('$eng_w_other','$eng_other','$trans_other','$part_other','$russ_other')";
			$result = mysql_query($query);	
            if(!$result) { die ('Ошибка базы данных' . mysql_error());}
	} 
	
}
?>
