
<h1>insert Emergency details here</h1>

 <form action="insertData.php" method="post">

Consultation Date:
 <input type="date" name="consultation_date" required>
 Notes:
 <textarea name="notes" id="" cols="30" rows="10"></textarea>
 
 patient name:
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

                // Fetch departments
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
        </select><br>

        staff name
        <select id="staff_id" name="staff_id" required>
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

                // Fetch departments
                $sql = "SELECT staff_id, name FROM Staff";
                $result = $conn->query($sql);

                // Display options
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['staff_id']."'>".$row['name']."</option>";
                    }
                }

                // Close connection
                $conn->close();
            ?>
        </select><br>
 
 <input type="submit" value="add patient">
 </form>

 <!-- CREATE TABLE Consultations (
consultation_id INT AUTO_INCREMENT PRIMARY KEY,
patient_id INT NOT NULL,
doc_id INT NOT NULL,
consultation_date DATE,
notes TEXT,
FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
FOREIGN KEY (doc_id) REFERENCES Doctors(doc_id)
); -->