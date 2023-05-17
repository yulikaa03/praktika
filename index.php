<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <title>Результат</title>
</head>
<body>
<?php
$host = 'localhost';  
$user = 'root2';    
$pass = '555'; 
$db_name = 'sim';   

$link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

if(isset($_POST['submit'])){
  if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['fileImg']) 
  && !empty($_POST['Radios']) && (!empty($_POST['Check1']) || !empty($_POST['Check2']) 
  || !empty($_POST['Check3'])) && !empty($_POST['CheckSelect']) && !empty($_POST['message'])){

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $fileImg = $_POST['fileImg'];
    $Radios = $_POST['Radios'];

    if (!empty($_POST['Check1'])){
      $Check1 = $_POST['Check1'];
      $Check2 = 'Нет';
      $Check3 = 'Нет';
    }
    else if (!empty($_POST['Check2'])){
      $Check1 = 'Нет';
      $Check2 = $_POST['Check2'];
      $Check3 = 'Нет';
    }
    else if (!empty($_POST['Check3'])){
      $Check1 = 'Нет';
      $Check2 = 'Нет';
      $Check3 = $_POST['Check3'];
    }

    $CheckSelect = $_POST['CheckSelect'];
    $message = $_POST['message'];

    $query = "insert into users(name,surname,email,fileImg,Radios,Check1,Check2,Check3,CheckSelect,message) 
    values('$name','$surname','$email','$fileImg','$Radios','$Check1','$Check2','$Check3','$CheckSelect','$message')";

    $run = mysqli_query($link, $query);

    if($run){
      echo "Form submitted seccessfully <br>";
    }
    else{
      echo "Form not submitted";
    }

  }
  else{
    echo "all fields required";
  }
}
?>
<table class="table">
  <thead>
    <tr>
      
      <th scope="col">ID</th>
      <th scope="col">Имя</th>
      <th scope="col">Фамилия</th>
      <th scope="col">Mail</th>
      <th scope="col">Фото</th>
      <th scope="col">Радио кнопка</th>
      <th scope="col">Checkbox 1</th>
      <th scope="col">Checkbox 2</th>
      <th scope="col">Checkbox 3</th>
      <th scope="col">Кол-во</th>
      <th scope="col">Комментарий</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $sql = mysqli_query($link, 'SELECT `id`, `name`, `surname`, `email`, `fileImg`, `Radios`, `Check1`, `Check2`, `Check3`, `CheckSelect`, `message` FROM `users`');
      $result = mysqli_fetch_array($sql);
    ?>
    <?php foreach ($sql as $result): ?>
    <tr>
        <th scope="row"><?php echo $result['id'] ?></th>
        <td><?php echo $result['name'] ?></td>
        <td><?php echo $result['surname'] ?></td>
        <td><?php echo $result['email'] ?></td>
        <td><?php echo $result['fileImg'] ?></td>
        <td><?php echo $result['Radios'] ?></td>
        <td><?php echo $result['Check1'] ?></td>
        <td><?php echo $result['Check2'] ?></td>
        <td><?php echo $result['Check3'] ?></td>
        <td><?php echo $result['CheckSelect'] ?></td>
        <td><?php echo $result['message'] ?></td>
    </tr>
    <?php endforeach; ?>  
  </tbody>
</table>

<form action= "index.php" method= "GET"> 
  <input type="submit" value="Отправить результат на почту" class="btn btn-danger "/>
</form>
<section id="copy-right">
    <div class="copy-right-sec">
      <div class="navigation">
        <a href="index.html">Вернуться назад</a>
      </div>
    </div>
</section>
</body>
</html>
