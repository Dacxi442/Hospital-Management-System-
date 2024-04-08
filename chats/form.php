<?php
// Include the navbar file
// include './layout/navbar.php';
include 'C:/wamp64/www/hospital/layout/navbar.php';
// include __DIR__ . 'navbar.php';
?>
<h4>insert Emergency details here</h4>

 <form action="insertData.php" method="post">
chat start time:
 <input type="time" placeholder="time" name="chat_start_time" required>
 chat end time:
 <input type="time" placeholder="time" name="chat_end_time" required>

 
 consultations:
 <select id="consultation_id" name="consultation_id" required>
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
                $sql = "SELECT consultation_id FROM Consultations";
                $result = $conn->query($sql);

                // Display options
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['consultation_id']."'>".$row['consultation_id']."</option>";
                    }
                }

                // Close connection
                $conn->close();
            ?>
        </select><br>

     

 <input type="submit" value="add chat">
 </form>

