<?php
require_once("lb/bdstart.php");
bdstart();

require_once("template/header.php");
require_once("lb/fu_categorize.php");
?>
<!-- Sidebar-->
	<div class="container">
	
	
	
	<header class=" col-sm-offset-3">
	</header>
		
	
	
	
	
	
	
	
	
		<div class="row">
			<div class="col-sm-3">
		<nav id="ml-menu" class="menu col-sm-3">
			<div class="menu__wrap">
<?php			
$level=2;
for($level=$level; $level<=$max_level; $level++)
{
	if($level==2)
	{
	   echo '<ul data-menu="main" class="menu__level">';
		  for($i=0;$i<$count_cat;$i++)
		  {
			 if( $ar_level[$i]==2) print_submenu($ar_left_key[$i],$ar_right_key[$i],$ar_name[$i]);
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
					  
				   <ul data-menu="submenu-<? echo $left_key?>" class="menu__level">
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
		  </div>
		 </nav> 
		</div>
	 </div>
</div><!-- -->
	
		
	<script src="template/js/classie.js"></script>
	<script src="template/js/dummydata.js"></script><!--/////// -->
	<script src="template/js/main.js"></script>
	
	<!--sidebar-->
	<script>
	(function() {
		var menuEl = document.getElementById('ml-menu'),
			mlmenu = new MLMenu(menuEl, {
				// breadcrumbsCtrl : true, // show breadcrumbs
				// initialBreadcrumb : 'all', // initial breadcrumb text
				backCtrl : false, // show back button
				// itemsDelayInterval : 60, // delay between each menu item sliding animation
				onItemClick: loadDummyData // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
			});

		// mobile menu toggle
		var openMenuCtrl = document.querySelector('.action--open'),
			closeMenuCtrl = document.querySelector('.action--close');

		openMenuCtrl.addEventListener('click', openMenu);
		closeMenuCtrl.addEventListener('click', closeMenu);

		function openMenu() {
			classie.add(menuEl, 'menu--open');
		}

		function closeMenu() {
			classie.remove(menuEl, 'menu--open');
		}

		// simulate grid content loading
		var gridWrapper = document.querySelector('.content');

		function loadDummyData(ev, itemName) {
			ev.preventDefault();

			closeMenu();
			gridWrapper.innerHTML = '';
			classie.add(gridWrapper, 'content--loading');
			setTimeout(function() {
				classie.remove(gridWrapper, 'content--loading');
				gridWrapper.innerHTML = '<ul class="products">' + dummyData[itemName] + '<ul>';
			}, 700);
		}
	})();
	</script>
	<!--/sidebar-->
		<!-- /Sidebar -->	
				
