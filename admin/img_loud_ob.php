<?php
// обработка картинок перед сохранением (размер и проч)  при вводе
//Большая картинка
if (empty($_FILES['fupload']['name']))
	{	
	$img_words = "template/images/img_words/net-img.jpg"; 
	}
else 
{
//загружаем изображение пользователя
$path_to_directory = '../template/images/img_words/';
$path_to_directory_sh = 'template/images/img_words/';
//проверка формата img
if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['fupload']['name']))
	 {		 	 	
		$filename = $_FILES['fupload']['name'];
		$source = $_FILES['fupload']['tmp_name'];	
		$target = $path_to_directory . $filename;
		move_uploaded_file($source, $target);

		if(preg_match('/[.](GIF)|(gif)$/', $filename)) {
		$im = imagecreatefromgif($path_to_directory.$filename) ;
		}
		if(preg_match('/[.](PNG)|(png)$/', $filename)) {
		$im = imagecreatefrompng($path_to_directory.$filename) ;
		}	
		if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $filename)) {
			$im = imagecreatefromjpeg($path_to_directory.$filename);
	}
// dest - результирующее изображение 
// w - ширина изображения 
// ratio - коэффициент пропорциональности 
$w = 250;  // квадратная - размер.

$w_src = imagesx($im); 
$h_src = imagesy($im);

         // создаём пустую квадратную картинку 
         $dest = imagecreatetruecolor($w,$w); 
         // вырезаем квадратную серединку по x, если фото горизонтальное 
         if ($w_src>$h_src) 
         imagecopyresampled($dest, $im, 0, 0,
                          round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                          0, $w, $w, min($w_src,$h_src), min($w_src,$h_src)); 

                  // если фото вертикальное 
         if ($w_src<$h_src) 
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w,
                          min($w_src,$h_src), min($w_src,$h_src)); 

         // квадратная картинка масштабируется без вырезок 
         if ($w_src==$h_src) 
         imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src);		 

$date=time(); //вычисляем время в настоящий момент.
imagejpeg($dest, $path_to_directory.$date.".jpg");

$img_words = $path_to_directory_sh.$date.".jpg";//заносим в переменную путь до аватара.

$delfull = $path_to_directory.$filename; 
unlink ($delfull);//удаляем оригинал загруженного изображения.
}
else 
         {//в случае несоответствия формата, выдаем  сообщение
         exit ("Картинка должна быть в формате <strong>JPG,GIF или PNG</strong>");
	     }
//конец процесса загрузки и присвоения переменной $img_words адреса загруженной img
}

?>

