
<!DOCTYPE html>
<html>
<head>
    <title>Update Medication Record</title>
</head>
<body>
    <h2>Update Medication Record</h2>

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
    $id = $_GET["med_id"];
    // $id = $_GET["id"];

    // SQL query to fetch the record based on the id
    $sql = "SELECT * FROM Medications WHERE med_id = $id";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the record exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $med_name = $_POST['med_name'];
            $dosage_form = $_POST['dosage_form'];
            // $med_id = $_POST["med_id"];
            
           

            // Prepare SQL statement
            $sql = "UPDATE Medications SET med_name = ?, dosage_form = ? WHERE med_id = ?";

            // Prepare statement
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("ssi",  $med_name, $dosage_form, $id);

            // Execute statement
            if ($stmt->execute()) {
                header("Location: table.php?success=true");
                echo "Record updated successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close statement
            $stmt->close();
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?med_id=" . $id; ?>">
            <label for="name">Medication name:</label>
            <input type="text" id="name" name="med_name" value="<?php echo $row["med_name"]; ?>" required><br><br>
            <label for="name">Dosage Form:</label>
            <input type="text" id="name" name="dosage_form" value="<?php echo $row["dosage_form"]; ?>" required><br><br>
           <input type="submit" name="submit" value="Update">
        </form>
        <?php
    } else {
        echo "No record found.";
    }

    // Close the connection
    $conn->close();
    ?>
</body>
</html>