<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $original_date_time = $_POST['original_date_time'];
    $new_date_time = $_POST['date_time'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];

    $rows = [];
    if (($file = fopen("transactions.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            if ($data[2] == $original_date_time) {
                $data[0] = $type;
                $data[1] = $amount;
                $data[2] = $new_date_time;
            }
            $rows[] = $data;
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
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Transaction</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-4 text-center">Edit Transaction</h1>
        <?php
        $date_time = $_GET['date_time'];
        $type = $_GET['type'];
        $amount = $_GET['amount'];
        ?>
        <form action="edit_transaction.php" method="POST">
            <input type="hidden" name="original_date_time" value="<?php echo htmlspecialchars($date_time); ?>">

            <div class="form-group">
                <label for="date_time">Date & Time:</label>
                <input type="text" id="date_time" name="date_time" class="form-control" value="<?php echo htmlspecialchars($date_time); ?>" required readonly>
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="income" <?php if ($type == 'income') echo 'selected'; ?>>Income</option>
                    <option value="expense" <?php if ($type == 'expense') echo 'selected'; ?>>Expense</option>
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" class="form-control" value="<?php echo htmlspecialchars($amount); ?>" required step="1000">
            </div>

            <button type="submit" class="btn btn-primary">Update Transaction</button>
        </form>
    </div>
</body>

</html>