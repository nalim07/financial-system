<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_time = $_POST['date_time'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    
    $file = fopen('transactions.csv', 'a');
    fputcsv($file, array($type, $amount, $date_time));
    fclose($file);
    
    header("Location: index.php");
    exit();
}
?>
