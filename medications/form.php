<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Insert Medications</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        padding: 20px;
    }

    h4 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<h4><b>Insert Medications</b></h4>

<form action="insertData.php" method="post">
    <label for="med_name">Medication Name:</label>
    <input type="text" id="med_name" placeholder="Enter Medication Name" name="med_name" required>

    <label for="dosage_form">Dosage Form:</label>
    <input type="text" id="dosage_form" placeholder="Enter Dosage Form" name="dosage_form" required>

    <input type="submit" value="Add Medication">
</form>
</body>
</html>

 <!-- CREATE TABLE Medications (
med_id INT AUTO_INCREMENT PRIMARY KEY,
med_name VARCHAR(100),
dosage_form varchar (100),
UNIQUE KEY (med_name)
); -->