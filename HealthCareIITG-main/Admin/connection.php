<!DOCTYPE html>
<html>

<head>
       <title>Connection</title>
</head>

<body>
       <?php

       $db = mysqli_connect('localhost', 'root', '', 'healthcare');
       if (!$db) {
              echo "Connection Failed";
       }
       error_reporting(0);

       ?>
</body>

</html>