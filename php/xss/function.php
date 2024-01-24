<?php
    function registar($username,$email,$passwordHashed){            //登録用
        global $pdo;
        $sql = "use XssSample";
        $result = $pdo->query($sql);
        
        $stmt = $pdo ->prepare('INSERT INTO account(username,email,password)VALUES(:username,:email,:password)');
        $stmt->bindParam(":username",$username,PDO::PARAM_STR);
        $stmt->bindParam(":email",$email,PDO::PARAM_STR);
        $stmt->bindParam(":password",$passwordHashed,PDO::PARAM_STR);
        $stmt->execute();
    }

    function userinfos($email){
        global $pdo;
        $sql = "use XssSample";
        $result = $pdo->query($sql);

        $sql = "SELECT * FROM account WHERE email = '{$email}'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    function emailcheck($email){                                    //メアドがあるか、ないかの確認
        global $pdo;
        $sql = "use XssSample";
        $result = $pdo->query($sql);

        $sql = "SELECT * FROM account WHERE email = '{$email}'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($res["email"])){
            return FALSE;
        }else{
            return TRUE;
        };
    }

    function passwordCheck($password,$hashed){                      //パスワードが一致するかどうかの確認
        if(password_verify($password, $hashed)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function loginCheck($email,$password){                          //emailcheckとpasswordCheckの複合、ログインするときに使う
        global $pdo;
        $sql = "use XssSample";
        $result = $pdo->query($sql);

        $sql = "SELECT * FROM account WHERE email = '{$email}'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($res["email"])){
            return FALSE;
        }else{
            if(passwordCheck($password,$res["password"])){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }

    function setSend_submit(){
        if(isset($_POST["send_submit"])){
            global $pdo;
            $sql = "use XssSample";
            $result = $pdo->query($sql);
            $send_user = $_POST["send_user"];
            $send_email = $_POST["send_email"];
            $TEXT = $_POST["text"];
            $Date = Date("Y-m-d H:i:s");
            $stmt = $pdo ->prepare('INSERT INTO sns(username,email,TEXT,Date)VALUES(:username,:email,:TEXT,:Date)');
            $stmt->bindParam(":username",$send_user,PDO::PARAM_STR);
            $stmt->bindParam(":email",$send_email,PDO::PARAM_STR);
            $stmt->bindParam(":TEXT",$TEXT,PDO::PARAM_STR);
            $stmt->bindParam(":Date",$Date,PDO::PARAM_STR);
            $stmt->execute();

            header('Location: ./');
        }
    }
    
    function showdata(){
        global $pdo;
        $sql = "use XssSample";
        $result = $pdo->query($sql);
        $sql = "SELECT * FROM sns  order by Date Desc Limit 5";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll();
        $lists = $res;

        foreach($lists as $list){
            echo' 
                <table>
                        <thead>
                            <tr>
                                <th colspan="2">username : '.$list["username"].'</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>'.$list["TEXT"].'</td>
                            <td>'.$list["Date"].'</td>
                        </tbody>
                </table>';
        }
    }
    function logoutMenu(){                                           //ログアウトメニューの表示と実行
        if(isset($_POST["logout"])){
            session_destroy();                              //セッションを切断して念の為セッション自体を消す、自身にリダイレクトする
            unset($_SESSION);
            header('Location: ./');
            exit();
        }else{
            echo "<form action='' method='post'>";
            echo "<input type='submit' name='logout' value='ログアウト'>";
            echo "</form>";
        }
    }
    function formsender($user_name,$user_email){
            echo "<form action='' method='post'>";
                echo "<input type='text' name='text' placeholder='投稿'>";
                echo "<input type='hidden' name = 'send_user' value= '", $user_name ,"'>";
                echo "<input type='hidden' name = 'send_email' value= '",$user_email ,"'>";
                echo "<input type='submit' name = 'send_submit' value='投稿する'>";
            echo "</form>";
    }
?>