<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f2f2f2;
        font-family: Arial, sans-serif;
    }

    .box {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        text-align: center;
    }

    input {
        padding: 8px;
        width: 200px;
        margin-bottom: 10px;
    }

    button {
        padding: 8px 20px;
        cursor: pointer;
    }

    
</style>
    <title>Document</title>
</head>
<body>
<div class="box">
    <form action="/fitur/tesbanding.php" method="post"> 
        <button type="submit" name="coba">coba </button><br> 
    </form>
</div>
</body>
</html>