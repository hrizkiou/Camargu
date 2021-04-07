<?php
require_once 'database.php';

$pdo = new Database(false);
if (file_exists('camagru.sql')){
    $sql = file_get_contents('camagru.sql');
    if($pdo->conn->exec($sql)){
        // rename("setup.sql", "setup_tmp.sql");
        // unlink("test1.sql");
        echo '<script>alert("Success!")</script>';
        echo '<script>setTimeout(function() {
            location.href = "/camagru/index"
          }, 500);</script>';
    }
}
else {
    echo '<script>alert("Error!")</script>';
    echo '<script>setTimeout(function() {
        location.href = "/camagru/index"
      }, 500);</script>';
}