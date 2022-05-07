<?php
$user = "isaac";
$password = "isaac";
$database = "test";
$table = "todo_list";

try {
    $db = new PDO("mysql:host=192.168.56.3;dbname=$database", $user, $password);
    echo " <h1 style=color:red> ". date('l') ."</h1> ";
    echo "time: ".date("h:i:sa") . "<br>";
    echo "date: ".date("Y-m-d");
    echo "<h2>TODO</h2><ol>"; 
    foreach($db->query("SELECT content FROM $table") as $row) {
      echo "<li>" . $row['content'] . "</li>";
    }

    echo "</ol>";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>