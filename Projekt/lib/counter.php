<?php
    if (file_exists(".config/connect.php")) require_once(".config/connect.php");

    if($rezultat = @$link->query(sprintf("SELECT 'id' FROM `users`")))
        {
            $ilu_userow = $rezultat->num_rows;
        }
        $link->close();

?>