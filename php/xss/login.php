<?php

    require_once("function.php");                                       //各種モジュールの読み込み
    require_once("sql/pdo.php");

    if(isset($_POST["submit"]) and $_POST["submit"] == "ログイン"){
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        if(loginCheck($email,$password)){
            session_start();
            $key = "AesNoKagiDesu123";
            $Session_ID = openssl_encrypt(strval($email), 'AES-128-ECB', $key);//一意であるemailをセッションIDとして保存
            $_SESSION["Session_ID"] = $Session_ID;
            
            echo "loginに成功しました";
            echo '<a href="index.php">メインページに戻る</a>';
            exit();
        }else{
            $msg = "Loginに失敗しました。<br>記入した情報に間違いがないか確認して下さい";
        }
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <form action="" method="post">
        <input type="email" name = "email" placeholder="EmailAddress" required="required">
        <input type="password" name = "password" placeholder="Password" required="required">
        <input type="submit" name="submit" value = "ログイン">
    </form>
    <?php if(isset($msg))echo $msg,"</br>";?>                           <!–$msgがあれば表示->
    <a href="registar.php">登録する</a>
</body>
</html>