<?php 
    try{
        $pdo = new PDO(
            'mysql:host=localhost;','root','P@ssw0rd',
            [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
    }catch(PDOException $e){
        echo $e->getMessage();
        exit();
    }
function search($record){
    global $pdo;
    $sql = "SELECT * FROM account WHERE email = '{$record}'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res;
}
?>