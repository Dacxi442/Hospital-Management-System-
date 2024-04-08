
<!DOCTYPE html>
<html>
<head>
    <title>Update Bed Record</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Bed Records</h2>
        <?php
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

        // Fetch data from the bed table based on the bed_id
        if (isset($_GET['bed_id'])) {
            $id = $_GET['bed_id'];
            $sql = "SELECT b.bed_id, b.bed_number, b.status, w.ward_name FROM Beds b INNER JOIN Wards w ON b.ward_id = w.ward_id WHERE b.bed_id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form method="post" action="update_process.php">
                    <input type="hidden" name="bed_id" value="<?php echo $row['bed_id']; ?>">
                    <label for="bed_number">Bed Number:</label>
                    <input type="text" name="bed_number" id="bed_number" value="<?php echo $row['bed_number']; ?>">
                    <label for="status">Status:</label>
                    <input type="text" name="status" id="status" value="<?php echo $row['status']; ?>">
                    <label for="ward_id">Ward Name:</label>
                    <select id="ward_id" name="ward_id" required>
                        <?php
                        // Fetch wards
                        $sql_wards = "SELECT ward_id, ward_name FROM Wards";
                        $result_wards = $conn->query($sql_wards);

                        // Display options
                        if ($result_wards->num_rows > 0) {
                            while ($row_ward = $result_wards->fetch_assoc()) {
                                $selected = ($row_ward['ward_id'] == $row['ward_id']) ? 'selected' : '';
                                echo "<option value='" . $row_ward['ward_id'] . "' $selected>" . $row_ward['ward_name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" name="update" value="Update Bed">
                </form>
                <?php
            } else {
                echo "Record not found.";
            }
        } else {
            echo "Bed ID not provided.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>