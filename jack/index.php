<?php
    ini_set('display_errors', "On");
    if(isset($_GET["SESSIONID"])){
        $filename = 'sessionlist_txt';
        $SESSIONID = strval(htmlspecialchars($_GET["SESSIONID"]));
        $data = $SESSIONID."\n";
        file_put_contents($filename, $data, FILE_APPEND);
    }
    echo $SESSIONID;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>window.close()</script>
</body>
</html>