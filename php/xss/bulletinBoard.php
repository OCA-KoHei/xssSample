<?php
    function main(){
        require_once("function.php");
        $key = "AesNoKagiDesu123";
        $userinfo = userinfos(openssl_decrypt($_SESSION["Session_ID"],'AES-128-ECB', $key));

        $user_name = $userinfo["username"];
        $user_email = $userinfo["email"];

        echo "こんにちは {$user_name}さん <br>";
        if($user_email == "admin@admin"){
            echo "あなたは管理者です";
        }else{
            echo "あなたは一般ユーザーです";
        }
        logoutMenu();
        formsender($user_name,$user_email);
        setSend_submit();
        echo "<br>";
        showdata();
    }
?>