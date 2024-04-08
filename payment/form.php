<?php


// Connect to your database
$servername = "localhost";
$username = "root";
$password = "norah#@$&";
$database = "Jamii1_hospital";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.25rem rgba(0, 38, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Insert Payment
            </div>
            <div class="card-body">
                <form action="insertData.php" method="post">
                    <div class="mb-3">
                        <label for="payment_date" class="form-label">Payment Date:</label>
                        <input type="date" class="form-control" name="payment_date" id="payment_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount:</label>
                        <input type="text" class="form-control" placeholder="Enter amount" name="amount" id="amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method:</label>
                        <select class="form-select" name="payment_method" id="payment_method" required>
                            <option value="Cash">Cash</option>
                            <option value="M-pesa">M-pesa</option>
                            <option value="Credit card">Credit Card</option>
                            <option value="Master card">Master card</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bill_id" class="form-label">Patient's Total Bill:</label>
                        <select class="form-select" id="bill_id" name="bill_id" required>
                            <?php
                            // Fetch Billings
                            $sql = "SELECT bill_id, total_amount FROM Billings";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $billingsResult = $stmt->get_result();

                            // Display options
                            if ($billingsResult->num_rows > 0) {
                                while ($row = $billingsResult->fetch_assoc()) {
                                    echo "<option value='" . $row['bill_id'] . "'>" . $row['total_amount'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="patient_id" class="form-label">Patient Name:</label>
                        <select class="form-select" id="patient_id" name="patient_id" required>
                            <?php
                            // Fetch patients
                            $sql = "SELECT patient_id, patient_name FROM Patients";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $patientsResult = $stmt->get_result();

                            // Display options
                            if ($patientsResult->num_rows > 0) {
                                while ($row = $patientsResult->fetch_assoc()) {
                                    echo "<option value='" . $row['patient_id'] . "'>" . $row['patient_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Payment</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>