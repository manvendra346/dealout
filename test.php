<?php

  include "connection.php";

  $table = 'hello';

  $conn->query("CREATE TABLE `".$table."` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL , `code` TEXT NOT NULL , `expenses` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`id`))") or die ($conn->error);

  echo "success";

?>