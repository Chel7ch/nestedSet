<?php
require_once("lb/bdstart.php");
bdstart();
//require_once("lb/mysql.php");
require_once("template/header.php");
//require_once('template/sidebar.php');
require_once('lb/fu_index.php');
require_once('lb/fu_onceWordModal.php');
?>

<!-- main -->
<div class="container">
	<div class="row">
		<div class="col-sm-offset-3 col-sm-9">

<?php 
$qu="select t1.* from words t1 where exists (select * from words t2 where t2.number <> t1.number and t2.english = t1.english )";
$result = mysql_query($qu);
$row = mysql_fetch_array($result);
while ($row = mysql_fetch_assoc($result) ) 
{ echo $row['english']."<br>"; }	
?>		
		</div>
	</div>
</div>










	<!-- /main -->
<?php
require_once('template/footer.php');
?>