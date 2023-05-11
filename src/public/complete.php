<?php 
  $name = $_POST["name"];
  $email = $_POST["email"];
  $number = $_POST["number"];

  $errors  = [];
  if (empty($name) || empty($email) || empty($number)){
    $errors[] = '「予約者名」「Email」「電話番号」のどれかが記入されていません！';
  }

  $dbUserName = 'root';
  $dbPassword = 'password';
  $pdo = new PDO(
    'mysql:host=mysql; dbname=bookingform; charset=utf8',
    $dbUserName,
    $dbPassword
  );

  $stmt = $pdo->prepare("INSERT INTO booking(
    name, email, phone_number
  ) VALUES (
    :name, :email, :phone_number
  )");

  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':phone_number', $number, PDO::PARAM_STR);
  $res = $stmt->execute();
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
 
<body>
  <div>
    <?php if(!empty($errors)): ?>
      <?php foreach($errors as $error): ?>
        <p><?php echo $error . "\n"; ?></p>
      <?php endforeach; ?>
      <a href="index.php">予約画面へ</a>
    <?php endif; ?>  

    <?php if(empty($errors)): ?>
      <h2>予約完了＾＾</h2>
      <a href="index.php">予約画面へ</a><br><br>
    <?php endif; ?>   

  </div> 
</body>
    
</html>