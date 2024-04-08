
<!DOCTYPE html>
<html>
<head>
    <title>Update Staff Record</title>
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
        <h2>Update Staff Record</h2>
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

        // Fetch data from the Staff table based on the staff_id
        if (isset($_GET['staff_id'])) {
            $id = $_GET['staff_id'];
            $sql = "SELECT s.staff_id, s.name, s.role, s.contact, s.specialization, d.dept_name FROM Staff s INNER JOIN Departments d ON s.dept_id = d.dept_id WHERE s.staff_id = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form method="post" action="update_process.php">
                    <input type="hidden" name="staff_id" value="<?php echo $row['staff_id']; ?>">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <input type="text" class="form-control" id="role" name="role" value="<?php echo $row['role']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact:</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $row['contact']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="specialization">Specialization:</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" value="<?php echo $row['specialization']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="dept_id">Department:</label>
                        <select class="form-control" id="dept_id" name="dept_id" required>
                            <?php
                            // Fetch departments
                            $sql = "SELECT dept_id, dept_name FROM Departments";
                            $result = $conn->query($sql);
                            // Display options
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['dept_id'] . "'>" . $row['dept_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="update" class="btn">Update Staff</button>
                </form>
                <?php
            } else {
                echo "Record not found.";
            }
        } else {
            echo "Staff ID not provided.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>