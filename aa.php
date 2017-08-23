<?php
require_once("lb/bdstart.php");
bdstart();

require_once("template/header.php");
require_once("lb/fu_categorize.php");

$level=2;
for($level=$level; $level<=$max_level; $level++)
{
	if($level==2)
	{
	   echo '<ul data-menu="main" class="menu__level-q">';
		  for($i=0;$i<$count_cat;$i++)
		  {
			 if( $ar_level[$i]==2)
				{
				print_submenu($ar_left_key[$i],$ar_right_key[$i],$ar_name[$i]);
				}
		  }		
		  echo"</ul>";	
	}
	
	else
	{   		
		//вывод списка категорий
		for($i=0;$i<$count_cat;$i++):
				 if( $ar_level[$i]==$level-1 and $ar_left_key[$i]+1!=$ar_right_key[$i]):			 
				 $left_key=$ar_left_key[$i];
			      $right_key=$ar_right_key[$i];?>
					  
				   <ul data-menu="submenu-<? echo $left_key?>" class="menu__level-q">
				        <?php for($ii=0;$ii<$count_cat;$ii++)
						{ 
							if($ar_left_key[$ii]>=$left_key and $ar_right_key[$ii]<= $right_key and $ar_level[$ii]== $level)
								print_submenu($ar_left_key[$ii],$ar_right_key[$ii],$ar_name[$ii]);
						}		
				   echo"</ul>"?>
				<?php endif;?>	
		<?php endfor;?>				
<?php }
}	
?>	



