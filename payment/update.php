
<!DOCTYPE html>
<html>
<head>
    <title>Update payments </title>
</head>
<body>
    <h2>Update payments History</h2>
    <?php
    // Include the update logic file
    // include 'update_logic.php';

    // Connect to your database (assuming you're using MySQL)
    $servername = "localhost";
    $username = "root";
    $password = "norah#@$&"; 
    $database = "Jamii1_hospital";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the Payments table based on the payment_id
    if (isset($_GET['payment_id'])) {
        $id = $_GET['payment_id'];

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT s.payment_id, s.payment_date, s.amount, s.payment_method, p.patient_name, b.total_amount
                                 FROM Payments s
                                 JOIN Patients p ON p.patient_id = s.patient_id
                                 JOIN Billings b ON s.payment_id = b.bill_id
                                 WHERE s.payment_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="update_process.php">
                <input type="hidden" name="payment_id" value="<?php echo $row['payment_id']; ?>">

                Payment Date:
                <input type="text" placeholder="enter payment date" name="payment_date" value="<?php echo $row['payment_date']; ?>" required>
                Amount Paid:
                <input type="text" placeholder="enter amount paid" name="amount" value="<?php echo $row['amount']; ?>" required>
                Payment Method:
                <input type="text" placeholder="Enter payment method" name="payment_method" value="<?php echo $row['payment_method']; ?>" required>
                Patient Name:
                <select id="patient_id" name="patient_id" required>
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

                    // Fetch patients
                    $sql = "SELECT patient_id, patient_name FROM Patients";
                    $result = $conn->query($sql);

                    // Display options
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['patient_id'] . "'>" . $row['patient_name'] . "</option>";
                        }
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </select><br>

                Total Bill:
                <select id="bill_id" name="bill_id" required>
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

                    // Fetch billings
                    $sql = "SELECT bill_id, total_amount FROM Billings"; // Corrected table name
                    $result = $conn->query($sql);

                    // Display options
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['bill_id'] . "'>" . $row['total_amount'] . "</option>";
                        }
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </select><br>

                <input type="submit" name="update" value="Update Payment">
            </form>
            <?php
        } else {
            echo "Record not found.";
        }
    } else {
        echo "Payment ID not provided.";
    }

    // $conn->close();
    ?>
</body>
</html>