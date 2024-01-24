<?php
## 出来るだけ可読性の良いコードと、説明を記載したんですけど、わかりにくかったらごめんなさい

    session_start();                                        //sessionの開始

    if(isset($_SESSION["Session_ID"])){                     //session_IDがある場合

        require_once("function.php");                       //require_onceはモジュールの読み込みという認識でok
        require_once("sql/pdo.php");


        $key = "AesNoKagiDesu123";                          //復号、暗号の時の鍵
        $email = openssl_decrypt($_SESSION["Session_ID"],'AES-128-ECB', $key);//Session_IDの復号(中にはメアドが入ってます)
        if(emailcheck($email)== FALSE){                     //session_IDに格納されているメールアドレスが不正な場合
            session_destroy();                              //セッションを切断して念の為セッション自体を消す、自身にリダイレクトする
            unset($_SESSION);
            header('Location: ');
            exit();
        }else{                                              //session_IDに格納されているメールアドレスが正しい場合
            require_once("bulletinBoard.php");              //掲示板てきなページの表示（攻撃者はここに格納型XSSのコードを挿入する）
            main();
            #echo "SESSION : [".$_COOKIE['PHPSESSID']."]";                     //Chromeの拡張機能、EditThisCookieでこの値に書き換えることでセッションハイジャックが成立
        }
    }else{                                                  //session_IDがない場合   
        session_destroy();                                  //セッションを切断して念の為セッション自体を消す、ログインページの表示
        unset($_SESSION);
        require_once("login.php");
    }
?>