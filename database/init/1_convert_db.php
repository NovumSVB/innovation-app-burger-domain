<?php
$conn = mysqli_connect("localhost", "root", 'Bttl66!!77!!', "dev_novum_burger");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alter_database_charset_sql = "ALTER DATABASE ".$database." CHARACTER SET utf8 COLLATE utf8_unicode_ci";
echo $alter_database_charset_sql . PHP_EOL;
mysqli_query($conn, $alter_database_charset_sql);

$show_tables_result = mysqli_query($conn, "SHOW TABLES");
$tables  = mysqli_fetch_all($show_tables_result);

foreach ($tables as $index => $table) {
    $alter_table_sql = "ALTER TABLE ".$table[0]." CONVERT TO CHARACTER SET utf8  COLLATE utf8_unicode_ci";
    echo $alter_table_sql . PHP_EOL;
    $alter_table_result = mysqli_query($conn, $alter_table_sql);
    echo "<pre>";
    var_dump($alter_table_result);
    echo "</pre>";
}
