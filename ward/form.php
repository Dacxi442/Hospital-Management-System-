
<!DOCTYPE html>
<html>
<head>
    <title>Insert Ward Details</title>
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

        h4 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
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
        <h4>Insert Ward Details</h4>
        <form action="insertData.php" method="post">
            <label for="ward_name">Ward Name:</label>
            <input type="text" placeholder="Enter name" name="ward_name" id="ward_name" required>

            <label for="ward_type">Ward Type:</label>
            <select name="ward_type" id="ward_type">
                <option value="General">General</option>
                <option value="ICU">ICU</option>
                <option value="Pediatric">Pediatric</option>
                <option value="Maternity">Maternity</option>
                <option value="Surgical">Surgical</option>
            </select>

            <input type="submit" value="Add Wards">
        </form>
    </div>
</body>
</html>