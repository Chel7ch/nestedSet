
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
	<meta name="keywords" content="" />
    <meta name="author" content="">
	<link rel="shortcut icon" href="favicon.ico">
    <title>Input</title>
    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/css/mystyle.css" rel="stylesheet">
	<script src="template/js/jquery.js"></script><!---->
	<script src="template/js/bootstrap.min.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
	<!-- Multi-Level menu -->
	<!-- demo styles -->
	<link rel="stylesheet" type="text/css" href="template/css/ademo.css" />
	<!-- menu styles -->
	<link rel="stylesheet" type="text/css" href="template/css/component.css" />
	<script src="template/js/modernizr-custom.js"></script><!-- /Multi-Level menu -->
</head>
<body>    
	<!-- Navbar -->
       <nav role="navigation" class="navbar navbar-fixed-top navbar-inverse ">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header ">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand"></a>
      </div>
      <!-- Collection of nav links, forms, and other content for toggling -->
      <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php?alf=">All</a></li>
<?php //построение меню
		for( $I=64; $I++<90;)
		{
			$str = chr($I);// преобразование числа в Utf символ
			echo "<li><a href='index.php?alf=".$str."'>".$str."</a></li>";
		}
?>
        </ul>
		
        <form role="search" class="navbar-form navbar-right">
          <div class="form-group">
            <input type="text" placeholder="Найти" class="form-control">
          </div>
        </form>
		<ul class="nav navbar-nav navbar-right">
		<li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Настройки<b class="caret"></b></a>
            <ul role="menu" class="dropdown-menu">
              <li><a href="words_input.php">Ввод слова</a></li>
              <li><a href="categor_input.php">Список категорий</a></li>
              <li class="divider"></li>
              <li><a href="words_edit.php">Другие</a></li>
              <li><a href="trening.php">js</a></li>
            </ul>
          </li>
		  </ul>
      </div>
    </nav>
	<!-- /Navbar -->
	
