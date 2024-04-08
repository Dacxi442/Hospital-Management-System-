<!DOCTYPE html>
<html>
<head>
    <title>Update Doctors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        select {
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="%23000" fill-rule="evenodd" clip-rule="evenodd" d="M6.293 7.293a1 1 0 0 1 1.414-1.414l3.758 3.758 3.758-3.758a1 1 0 1 1 1.414 1.414l-4.5 4.5a1 1 0 0 1-1.414 0l-4.5-4.5a1 1 0 0 1-0.001-0.001z" fill="%23000"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
            background-size: 20px;
            padding-right: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Doctors Table</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "norah#@$&";
        $database = "Jamii1_hospital";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['doc_id'])) {
            $id = $_GET['doc_id'];
            $sql = "SELECT d.doc_id, d.doc_name, d.specialization, p.patient_name, s.name AS staff_name
            FROM Doctors d
            JOIN Patients p ON p.patient_id = d.patient_id
            JOIN Staff s ON d.staff_id = s.staff_id
            WHERE d.doc_id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form method="post" action="update_process.php">
                    <input type="hidden" name="doc_id" value="<?php echo $row['doc_id']; ?>">

                    <label for="doc_name">Doctors Name:</label>
                    <input type="text" id="doc_name" name="doc_name" placeholder="Enter doctor's name" value="<?php echo $row['doc_name']; ?>" required>

                    <label for="specialization">Specialization:</label>
                    <input type="text" id="specialization" name="specialization" placeholder="Enter specialization" value="<?php echo $row['specialization']; ?>" required>

                    <label for="patient_id">Patient Name:</label>
                    <select id="patient_id" name="patient_id" required>
                        <?php
                        $sql = "SELECT patient_id, patient_name FROM Patients";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['patient_id']."'>".$row['patient_name']."</option>";
                            }
                        }
                        ?>
                    </select>

                    <label for="staff_id">Staff Name:</label>
                    <select id="staff_id" name="staff_id" required>
                        <?php
                        $sql = "SELECT staff_id, name FROM Staff";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['staff_id']."'>".$row['name']."</option>";
                            }
                        }
                        ?>
                    </select>

                    <input type="submit" name="update" value="Update Doctors">
                </form>
                <?php
            } else {
                echo "Record not found.";
            }
        } else {
            echo "Doctor ID not provided.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
