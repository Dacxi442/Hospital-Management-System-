<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Insert Emergency Patient</title>
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

    input[type="text"],
    input[type="date"] {
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
<h4><b>Insert Emergency Patient</b></h4>

<form action="insertData.php" method="post">
    <label for="empatient_name">Name:</label>
    <input type="text" id="empatient_name" placeholder="Enter Patient's Name" name="empatient_name" required>

    <label for="contact">Contact:</label>
    <input type="text" id="contact" placeholder="Enter Contact" name="contact" required>

    <label for="datetime_added">Date:</label>
    <input type="date" id="datetime_added" name="datetime_added" required>
 
    <input type="submit" value="Add Patient">
</form>
</body>
</html>
