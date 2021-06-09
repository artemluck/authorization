<?php 
?>

<html lang="ru">
<head>
<title>Лабораторная работа 2</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="styles/style.css" rel="stylesheet" type="text/css" />

</head>
  <body>
 
  <div id="wrapper">
    <header> 
	
	<nav>
		
		<ul class="topmenu">
		
		<li><a href="input.php">Добавление информации о человеке</a></li>
		
	  </nav>

	 
    </header>

<!--Основной контент (статья)-->
    <article>
	<?include('base.php'); //подключаем базу данных?>
		<? 
		if ($_POST['send']==1)
		{
		$name=$_POST['fio']; //получаем из формы данные про человека
		$sex=$_POST['sex']; //мы использовали метод POST, поэтому данные в массиве POST

		

			$uploaddir = 'img/'; //указываем директорию куда будем загружать файл
			$uploadfile = $uploaddir . basename($_FILES['file']['name']); //имя файла с диреткорией
			$uploadfilename = basename($_FILES['file']['name']); //просто имя файла
			move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile); //перемещаем файл из временной директории на сервере в нужную нам
			$im = imagecreatefromjpeg($uploadfile); //создаем через библиотеку GD холст с нашей фотографией, чтобы потом ее уменьшить
			
			$width = 50; //указываем ширину
			
			list($im_size['width'], $im_size['height']) = getimagesize($uploadfile); //получаем размер нашей картинки
			$thumb_size['width'] = $width; //назначаем ширину 50
			$thumb_size['height'] = floor($im_size['height'] * ($thumb_size['width'] / $im_size['width']));//высоту высчитываем автоматически
			$thumb = imagecreatetruecolor($thumb_size['width'], $thumb_size['height']);//создаем изображение с этим размером


			// создание миниатюры
			imagecopyresampled($thumb, $im, 0, 0, 0, 0, $thumb_size['width'], $thumb_size['height'], $im_size['width'], $im_size['height']);
			
			imagejpeg($thumb, $uploaddir.'small_'.$uploadfilename);//сохраняем наше изображение
    
			// освобождение памяти
			imagedestroy($im);
			imagedestroy($thumb);

		
		$SQL = "INSERT INTO `people`(`name`, `sex`, `image`) VALUES  
		('".$name."','".$sex."','".$uploadfilename."')";//добавляем в базу данных информацию о нашем человеке

		$result = mysqli_query($link,$SQL) or die ("Query failed-->".$SQL);
		echo "Информация добавлена!";
		}
		?>
		<table>
			<tr>
			<th>№</th><th>Фото</th><th>ФИО</th><th>Пол</th>
			</tr>
			<?
				$i=1;
				$sql="SELECT * FROM `people`"; //выводим все записи из БД

				$result = mysqli_query($link,$sql) or die ("Query failed");//выполняем запрос
					if (mysqli_num_rows($result)) //если есть, то выводим
						{
							while ($rows=mysqli_fetch_assoc($result)){ //пока есть записи из запроса
								echo "<tr><td>".$i."</td><td><img src='img/small_".$rows['image']."'></td><td>".$rows['name']."</td><td>".$rows['sex']."</td></tr>"; //выводим запись
								$i++; //счетчик увеличиваем на 1
							}	
						}
			?>
		</table>
    </article>
	
	
	
  <div class="clear"></div>
    <footer>
    

    </footer>
  </div> 
  <?php mysqli_close($link)//закрываем соединение с базой данных  ?> 
</body>
</html>

    

	

	 
