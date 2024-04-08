

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Bills</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h4 {
            color: #007bff;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"], select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"], .button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover, .button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h4>Insert Bills Here</h4>

    <form id="billForm" action="insertData.php" method="post" onsubmit="return validateForm()">
        <div>
            <label for="totalAmount">Total Amount:</label>
            <input type="text" id="totalAmount" placeholder="Enter Total Bill" name="total_amount" required>
            <div id="totalAmountError" class="error-message"></div>
        </div>
        <div>
            <label for="patientId">Patient Name:</label>
            <select id="patientId" name="patient_id" required>
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
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['patient_id']."'>".$row['patient_name']."</option>";
                    }
                }

                // Close connection
                $conn->close();
                ?>
            </select>
        </div>
        <input type="submit" value="Add Bill" class="button">
        <button type="reset" class="button">Reset</button>
    </form>

    <script>
        function validateForm() {
            var totalAmount = document.getElementById("totalAmount").value;
            var isValid = true;

            // Reset error messages
            document.getElementById("totalAmountError").innerHTML = "";

            // Total Amount validation
            if (totalAmount.trim() === "") {
                document.getElementById("totalAmountError").innerHTML = "Total Amount is required";
                isValid = false;
            } else if (isNaN(totalAmount)) {
                document.getElementById("totalAmountError").innerHTML = "Total Amount must be a number";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>
