<html>
<head>
<title>QNAP Hello World</title>
</head>
<body>
<div style='font-size:30px'>
<a href='index.php'>Home</a> |
<a href='helloWorld.php'>HelloWorld</a> |
<a href='upload.php'>Upload</a> |
<a href='system.php'>System</a></br>
In this example, the program "helloWorld" is executed.</br>
<?php
    echo 'Result of helloWorld: </br>';
    system('/share/CACHEDEV1_DATA/.qpkg/QNAP_HelloWorld/helloWorld');
?>
</br>
</div>
</body>
</html>

