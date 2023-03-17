<?php
$confirm = readline("Update Database?(Y/N) ");

if ($confirm == 'Y' || $confirm == 'y') {
  $mysqli = new mysqli("localhost", "root", "", "db_den");
  // Drop Tables
  if ($result = $mysqli->query("SELECT concat('DROP TABLE IF EXISTS `', table_name, '`;') as `sql` FROM information_schema.tables WHERE table_schema = 'db_den';")) {
    while ($row = $result->fetch_row()) {
      $mysqli->query("$row[0]");
    }
    $result->free_result();
  }
  // Import Latest
  $sql = file_get_contents('db_den.sql');
  $result = $mysqli->multi_query($sql);

  echo 'Database Updated!';
} else {
  echo 'Sync Aborted!';
}
