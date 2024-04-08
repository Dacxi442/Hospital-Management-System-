

<!DOCTYPE html>
<html>
<head>
    <title>Add Bed</title>
    <style>
        /* Global Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 20px;
    background: grey;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: 0 auto;
}

h2 {
    color: #333;
    text-align: center;
    margin-bottom: 30px;
}

/* Form Styles */
.form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
}

/* Button Styles */
.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #0069d9;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Bed</h2>
        <form action="insertData.php" method="post" class="form">
            <div class="form-group">
                <label for="bed_number">Bed number:</label>
                <input type="text" placeholder="Enter bed number" name="bed_number" id="bed_number" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="vacant">Vacant</option>
                    <option value="occupied">Occupied</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ward_id">Ward name:</label>
                <select id="ward_id" name="ward_id" required>
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

                    // Fetch from wards
                    $sql = "SELECT ward_id, ward_name FROM wards";
                    $result = $conn->query($sql);

                    // Check if the query was successful
                    if (!$result) {
                        die("Error executing query: " . $conn->error);
                    }

                    // Display options
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['ward_id'] . "'>" . $row['ward_name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No wards found</option>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </select>
            </div>
            <button type="submit" class="btn">Add Bed</button>
        </form>
    </div>
</body>
</html>