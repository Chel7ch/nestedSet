<?php
require_once("lb/bdstart.php");
bdstart();

require_once("template/header.php");
require_once('template/sidebar.php');
//require_once('lb/fu_categorize.php');
?>
<!--  -->
<div class="col-sm-9 margin30">
<?php
//вывод списка категорий
 $query = "SELECT * FROM categores ORDER BY left_key";
	$result_cat = mysql_query($query);
	if(!$result_cat) die ('Ошибка базы данных'.mysql_error());
	while ($row = mysql_fetch_array($result_cat,MYSQL_ASSOC)):?>
			<?php $offset= $row['level']*2-2;?>
			
			<form class="form-horizontal" >		
			<div class="form-group">
				<div class="col-sm-3 col-sm-offset-<?php echo $offset ?>">
				<!-- Кнопка, вызова модального окна -->
				  <button type="button" class="btn btn-primary btn-block " name="id<?php echo $row['id']?> "
			  data-toggle="modal" data-target="#modal<?php echo $row['id']?>" ><?php echo $row['name']." id".$row['id']." left".$row['left_key']." right".$row['right_key']?></button>
				<!-- /Кнопка -->
				</div>	
			</div>	
			</form>
						
		<!-- модальное окно -->
			<div id="modal<?php echo $row['id']?>" class="modal fade">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Добавление категории</h4>
				  </div>
				  <div class="modal-body">
				  
				  <!-- вывод табов -->
				<ul class="nav nav-tabs">
				  <li class="active"><a href="#Add<?php echo $row['id']?>" data-toggle="tab">Add</a></li>
				  <li><a href="#Delete<?php echo $row['id']?>" data-toggle="tab">Delete</a></li>
				  <li><a href="#Edit<?php echo $row['id']?>" data-toggle="tab">Edit</a></li>
				</ul>

	<!-- Tab panes -->
	<div class="tab-content">
	    <!--Add-->
				  <div class="tab-pane fade in active" id="Add<?php echo $row['id']?>">
				  <br>
					<form class="form-horizontal" enctype="multipart/form-data" action="admin/ob_categorization.php" method="post">
						<!--form_Add-->
						<div class="form-group">
							<div class="">
						   <input type="" class="btn btn-primary col-sm-offset-1 col-sm-4 " value="<?php echo $row['name']?>"><!-- !!!! -->
						   </div>
							<div class=" col-sm-4">
								  <input type=" text" name="name" class="form-control" id="fatherName" placeholder="+ Уровень <?php echo $row['level']+1?>">
							</div>
							<div class="col-sm-2">
							  <input type="hidden" name="right_key" value="<?php echo $row['right_key']?>">
							  <input type="hidden" name="level" value="<?php echo $row['level']?>">
							  <input type="submit"  class="btn btn-danger btn-block" value="+">
							</div>
						 </div>
						</form>	<!--/form_Add-->
				</div><!--/Add-->
		<!--Delete-->
		<?php
		if($row['left_key']<=1)//блокировка del 1 пункта
	{
		$disabled="disabled";
		$notice="Этот пункт вы не можете удалить";
	}
	else{
		$disabled="";
		$notice="";
	}
	?>
			  <div class="tab-pane fade" id="Delete<?php echo $row['id']?>">
					 <br>
					<form class="form-horizontal" enctype="multipart/form-data" action="admin/ob_categorization.php" method="post">
						<!--form_Del-->
						<div class="form-group ">
							  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $notice ?><br>
						 </div>
						<div class="form-group">
						   <input type="submit" class="btn btn-danger col-sm-offset-2 col-sm-6 <?php echo $disabled ?>" value="<?php echo $row['name']?>"><!-- !!!! -->
						   	   <input type="hidden" name="del_right_key" value="<?php echo $row['right_key']?>">
						   	  <input type="hidden" name="del_left_key" value="<?php echo $row['left_key']?>">
							  <br>
						 </div>
						</form>	<!--/form_Del-->
				</div>
		<!--Edit-->
			  <div class="tab-pane fade" id="Edit<?php echo $row['id']?>">
			 <br>
				<form class="form-horizontal" enctype="multipart/form-data" action="admin/ob_categorization.php" method="post">
					<!--form_Edit-->
					<div class="form-group">
					   <input type="submit" class="btn btn-info col-sm-offset-3 col-sm-4 " value="ВВЕРХ <?php echo $row['right_key']?>">
						  <input type="hidden" name="edit_left_key" value="<?php echo $row['left_key']?>">
				    </div>
					<div class="form-group">
					   <input type="submit" class="btn  btn-primary col-sm-offset-2 col-sm-6 disabled " value="<?php echo $row['name']?>"><!-- !!!! -->
						  
				    </div>
					<div class="form-group">
					   <input type="submit" class="btn btn-info col-sm-offset-3 col-sm-4 " value="ВНИЗ<?php echo $row['right_key']?>"><!-- !!!! -->
						  <input type="hidden" name="edit_right_key" value="<?php echo $row['right_key']?>">
						  <input type="hidden" name="edit_left_key" value="<?php echo $row['left_key']?>">
						  <input type="hidden" name="edit_level" value="<?php echo $row['level']?>">
						  <input type="hidden" name="edit_id" value="<?php echo $row['id']?>">
				    </div>
				</form>	<!--/form_Edit-->
						
			  </div>
				</form>	
		   </div><!-- /вывод табов -->
					
				  </div>
				  <div class="вmodal-footer">
				  <br>
				  <br>
			      </div>
				</div>
			  </div>
			</div>	<!-- /модальное окно -->
	<?endwhile;?>
	</div>
<?php 
//require_once('template/footer.php');
?>
