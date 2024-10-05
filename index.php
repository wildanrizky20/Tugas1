<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Total Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f9f9f9, #e8f0ff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Roboto', sans-serif;
        }

        .calculator-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease;
        }

        .calculator-card:hover {
            transform: scale(1.02);
        }

        h2 {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 0.75rem;
            font-size: 1rem;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .result-card {
            margin-top: 2rem;
            padding: 1.5rem;
            background-color: #f0f8ff;
            border-left: 5px solid #007bff;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="calculator-card">
        <h2>Kalkulator Total Pembelian</h2>
        <form method="POST" action="" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="total" class="form-label">Total Pembelian (Rp)</label>
                <input type="number" class="form-control" id="total" name="total" placeholder="Masukkan total pembelian"
                    required min="0">
                <div class="invalid-feedback">Harap masukkan jumlah total pembelian yang valid.</div>
            </div>
            <div class="mb-3">
                <label for="member" class="form-label">Apakah Pembeli Member?</label>
                <select class="form-select" id="member" name="member" required>
                    <option value="" disabled selected>Pilih status member</option>
                    <option value="yes">Ya</option>
                    <option value="no">Tidak</option>
                </select>
                <div class="invalid-feedback">Harap pilih status member.</div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Hitung Total</button>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $total = isset($_POST['total']) ? (float)$_POST['total'] : 0;
            $is_member = $_POST['member'] == 'yes';

            if ($total <= 0) {
                echo "<div class='mt-4 alert alert-danger'>Harap masukkan total pembelian yang valid.</div>";
            } else {
                $diskon = 0;

                if ($is_member) {
                    $diskon += 10;

                    if ($total > 1000000) {
                        $diskon += 15;
                    } elseif ($total >= 500000) {
                        $diskon += 10;
                    }
                } else {
                    if ($total >= 1000000) {
                        $diskon += 10;
                    } elseif ($total >= 500000) {
                        $diskon += 5;
                    }
                }

                $total_diskon = ($diskon / 100) * $total;
                $total_akhir = $total - $total_diskon;

                echo "<div class='result-card'>";
                echo "<h4>Hasil Perhitungan:</h4>";
                echo "<p><strong>Total Pembelian:</strong> Rp " . number_format($total, 0, ',', '.') . "</p>";
                echo "<p><strong>Diskon:</strong> $diskon%</p>";
                echo "<p><strong>Total Diskon:</strong> Rp " . number_format($total_diskon, 0, ',', '.') . "</p>";
                echo "<p><strong>Total Akhir:</strong> Rp " . number_format($total_akhir, 0, ',', '.') . "</p>";
                echo "</div>";
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>

</html>
