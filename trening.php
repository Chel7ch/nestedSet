<?php
require_once("lb/bdstart.php");
bdstart();
//require_once("lb/mysql.php");
require_once("template/header.php");
//require_once('template/sidebar.php');
require_once('lb/fu_index.php');
?>

<!-- main -->
<div class="container">
	<div class="row">
		<div class="col-sm-offset-3 col-sm-9">


<!-- На HTML 5, атрибут type указывать не обязательно 
  <script>
    alert("Привет мир!");
    document.write("Привет мир!");
  </script>-->  
</head>
<body>
  <h1>Привет JavaScript!</h1>
 <script>
var myWindow = window.open("http://itchief.ru", "_myWindow", "top=100, left=100, width=400, height=500, scrollbars=1,status=yes, resizable=no")
    myWindow.document.write("<p>Некоторый текст</p>");
 </script> 

   
     
    <button onClick="myWindowOpen()">Oткрыть oкно</button>
    <button onClick="myWindowClose()">Закрыть окно</button>




	</div>
	</div>
</div>










