<html lang="ru">
<head>
<title>Лабораторная работа 2</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="styles/style.css" rel="stylesheet" type="text/css" />
	<script>
	  function check()
			{
				var inp = document.getElementsByName('sex');
				for (var i = 0; i < inp.length; i++) {
					if (inp[i].type == "radio" && inp[i].checked) {
						return true;
					}
				}
				return false;
			}
			
	  function formValidation() {
	     var prm1=document.getElementById("fio").value;
		 var prm2=document.getElementById("file").value;
		 
		  if (prm1.length==0) {
				alert("Не заполнено поле Имя!");
				return false;
			}
		  
		  
		  else if (!check()) {
				alert("Не выбран пол!");
				return false;
			}	
			
		  else if (prm2.length==0) {
				alert("Не выбран файл!");
				return false;
			}
	
		}
	</script>
</head>
  <body>
 
  <div id="wrapper">
    <header> 
	
	

	 
    </header>

<!--Основной контент (статья)-->
    <article>
		<?include('base.php'); //подключаем базу данных?>
		<form action="result.php" method="post" onsubmit="return formValidation()" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<fieldset>
			<legend>Регистрация</legend>
			
			<input type="hidden" name="send" value="1">
			<label>Имя:</label>
			<input type="text" name="fio" id="fio">
			<label>Пол:</label><input type="radio" name="sex" value="м"> м <input type="radio" name="sex" value="ж"> ж
			<label>Картинка:</label>
			<input type="file" name="file" id="file" accept="image/jpeg">
			<br><br>
			<button type="submit" class="button">Отправить запрос</button>
			</fieldset>
		</form>
    </article>
	
	
	
  <div class="clear"></div>
    <footer>
    

    </footer>
  </div> 
  <?php mysqli_close($link)//закрываем соединение с базой данных  ?> 
</body>
</html>

    

	

	 
