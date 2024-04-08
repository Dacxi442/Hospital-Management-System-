
<!DOCTYPE html>
<html>
<head>
    <title>Update Department Record</title>
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
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
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
        <h2>Update Department Record</h2>
        <?php
        // Database connection details
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

        // Get the id parameter from the query string
        $id = $_GET["dept_id"];

        // SQL query to fetch the record based on the id
        $sql = "SELECT * FROM Departments WHERE dept_id = $id";

        // Execute the query
        $result = $conn->query($sql);

        // Check if the record exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve form data
                $Department_name = $_POST["Department_name"];
                $Description_name = $_POST["Description_name"];
                $Department_type = $_POST["Department_type"];

                // Prepare SQL statement
                $sql = "UPDATE Departments SET dept_name = ?, description = ?, department_type = ? WHERE dept_id = ?";

                // Prepare statement
                $stmt = $conn->prepare($sql);

                // Bind parameters
                $stmt->bind_param("sssi", $Department_name, $Description_name, $Department_type, $id);

                // Execute statement
                if ($stmt->execute()) {
                    ob_end_clean(); // Clear the output buffer
                    header("Location: table.php?success=true");
                    exit(); 
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                // Close statement
                $stmt->close();
            }
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?dept_id=" . $id; ?>">
                <div class="form-group">
                    <label for="name">Department Name:</label>
                    <input type="text" class="form-control" id="name" name="Department_name" value="<?php echo $row["dept_name"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Description:</label>
                    <input type="text" class="form-control" id="name" name="Description_name" value="<?php echo $row["description"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Department Type:</label>
                    <input type="text" class="form-control" id="name" name="Department_type" value="<?php echo $row["department_type"]; ?>" required>
                </div>
                <button type="submit" name="submit" class="btn">Update</button>
            </form>
            <?php
        } else {
            echo "No record found.";
        }

        // Close the connection
        $conn->close();
        ?>
    </div>
</body>
</html>