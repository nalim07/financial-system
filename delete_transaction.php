<?php
if (isset($_GET['date_time'])) {
    $date_time = $_GET['date_time'];

    $rows = [];
    if (($file = fopen("transactions.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            if ($data[2] != $date_time) {
                $rows[] = $data;
            }
        }
        fclose($file);
    }

    $file = fopen("transactions.csv", "w");
    foreach ($rows as $row) {
        fputcsv($file, $row);
    }
    fclose($file);

    header("Location: index.php");
    exit();
}
