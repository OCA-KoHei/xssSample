<?php
    require_once("function.php");
    require_once("sql/pdo.php");

    if(isset($_POST["submit"]) and $_POST["submit"] == "登録"){
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $CheckPw = htmlspecialchars($_POST["checkPw"]);

        if($password != $CheckPw){
            $msg = "Passwordと確認用のPasswordが一致しませんでした";
        }else{
                if(emailcheck($email)){
                $msg = "このemailAddressは既に存在しています";
            }else{
                ini_set('display_errors', "On");
                session_start();
                $key = "AesNoKagiDesu123";
                $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
                $Session_ID = openssl_encrypt(strval($email), 'AES-128-ECB', $key);//一意であるemailをセッションIDとして保存
                $_SESSION["Session_ID"] = $Session_ID;
                registar($username,$email,$passwordHashed);
                echo "ご登録ありがとうございました。";
                echo '<a href="index.php">メインページに戻る</a>';
                exit();
            }
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
        <input type="text" name = "username" placeholder="username" required="required">
        <input type="email" name = "email" placeholder="example@example" required="required">
        <input type="password" name = "password" placeholder="Password" required="required">
        <input type="password" name = "checkPw" placeholder="確認用Password" required="required">
        <input type="submit" name="submit" value = "登録">
    </form>
    <?php if(isset($msg))echo $msg,"</br>";?>
</body>
</html>