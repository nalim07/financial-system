<!DOCTYPE html>
<html>

<head>
    <title>Financial System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- js -->
    <script src="js/script.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-4 text-center">Financial System</h1>
        <?php
        // Inisialisasi saldo awal
        $balance = 0;

        // Mengambil semua transaksi dari file CSV
        if (($file = fopen("transactions.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                // Menambah atau mengurangi saldo berdasarkan jenis transaksi
                if ($data[0] == 'income') {
                    $balance += $data[1];
                } else if ($data[0] == 'expense') {
                    $balance -= $data[1];
                }
            }
            fclose($file);
        }
        echo "<h2 class='mb-4'>Balance: Rp " . number_format($balance) . "</h2>";
        ?>
        <form action="add_transaction.php" method="POST" class="mb-5">
            <input type="hidden" id="date_time" name="date_time" required readonly>

            <div class="form-group">
                <label for="type">Type:</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" class="form-control" required step="1000">
            </div>

            <button type="submit" class="btn btn-dark">Add Transaction</button>
        </form>

        <h2 class="mb-4">Transaction History</h2>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date & Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan semua transaksi dari file CSV
                if (($file = fopen("transactions.csv", "r")) !== FALSE) {
                    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($data[0]) . "</td>";
                        echo "<td>" . htmlspecialchars(number_format($data[1])) . "</td>";
                        echo "<td>" . htmlspecialchars($data[2]) . "</td>";
                        echo "<td style='text-align: center;' >";
                        echo "<a href='edit_transaction.php?date_time=" . urlencode($data[2]) . "&type=" . urlencode($data[0]) . "&amount=" . urlencode($data[1]) . "'><i class='fas fa-edit'></i></a> ";
                        echo "<a href='delete_transaction.php?date_time=" . urlencode($data[2]) . "' onclick=\"return confirm('Are you sure you want to delete this transaction?');\"><i class='fas fa-trash'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    fclose($file);
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>