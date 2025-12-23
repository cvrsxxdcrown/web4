<?php
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_SESSION['captcha'])) {
        $message = "Картинки отключены. Включите отображение изображений.";
    } else {
        $userAnswer = trim($_POST['answer'] ?? "");

        if ($userAnswer === "") {
            $message = "Введите строку с картинки.";
        } elseif (strcasecmp($userAnswer, $_SESSION['captcha']) === 0) {
            $message = "✅ Строка введена верно!";
        } else {
            $message = "❌ Неверная строка.";
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Регистрация</title>
</head>
<body>
  <h1>Регистрация</h1>

  <form action="" method="post">
    <div>
      <img src="noise-picture.php" alt="captcha"
           onerror="this.style.display='none';
                    document.getElementById('captchaError').style.display='block';">
    </div>

    <div id="captchaError" style="display:none; color:red;">
      Картинка заблокирована. Разблокируйте отображение изображений.
    </div>

    <div>
      <label>Введите строку</label>
      <input type="text" name="answer" size="6">
    </div>

    <input type="submit" value="Подтвердить">
  </form>

  <div>
    <?php echo $message; ?>
  </div>
</body>
</html>
