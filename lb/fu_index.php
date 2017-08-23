<?php
// футкции страницы Index
// функция вывода перевода(русских слов)
function slova_pechat($rus_means,$x=20)
{
if ($rus_means<>"")
	{ 
		for ($i=0; $i<$x; $i++)
				{ 
				echo"&nbsp";
				} 
		echo"<span>".$rus_means."</span>"."<br>";
	}
}
?>

