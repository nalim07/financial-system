<!DOCTYPE html>
<html>

<head>
    <title>Financial System</title>

    <!-- Mulai Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- js -->
    <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1 class="display-4">Financial System</h1>
            <?php
            // Inisialisasi saldo awal
            $balance = 0;

            // Mengambil semua transaksi dari file CSV
            if (($file = fopen("transactions.csv", "r")) !== FALSE) {
                while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                    // Menambah atau mengurangi saldo berdasarkan jenis transaksi
                    if ($data[2] == 'income') {
                        $balance += $data[1];
                    } else if ($data[2] == 'expense') {
                        $balance -= $data[1];
                    }
                }
                fclose($file);
            }
            echo "<h2>Balance: Rp" . number_format($balance) . "</h2>";
            ?>
            <form action="add_transaction.php" method="POST">
                <label for="date_time">Date & Time:</label>
                <input type="text" id="date_time" name="date_time" required readonly><br><br>

                <label for="type">Type:</label>
                <select id="type" name="type" required>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select><br><br>

                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" required step="0.01"><br><br>

                <input type="submit" value="Add Transaction">
            </form>
            <br>

            <h2>Transactions</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date & Time</th>
                            <th>Type</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Menampilkan semua transaksi dari file CSV
                        if (($file = fopen("transactions.csv", "r")) !== FALSE) {
                            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($data[0]) . "</td>";
                                echo "<td>" . htmlspecialchars($data[2]) . "</td>";
                                echo "<td>" . htmlspecialchars(number_format($data[1])) . "</td>";
                                echo "</tr>";
                            }
                            fclose($file);
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xxxx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-yyyy" crossorigin="anonymous"></script>
</body>

</html>