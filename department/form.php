
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Departments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h4 {
            color: #007bff;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
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

        .error-message {
            color: red;
            margin-top: 5px;
        }
        .outlined-button {
    background-color: transparent;
    color: #007bff;
    border: 2px solid #007bff;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

.outlined-button:hover {
    background-color: #007bff;
    color: white;
}


    </style>
</head>
<body>
    
    <h1><b>Insert Departments Here</b></h1>

    <form id="departmentForm" action="department_data.php" method="post" onsubmit="return validateForm()">
        <div>
            <label for="departmentName">Department Name:</label>
            <input type="text" id="departmentName" placeholder="Enter department name" name="Department_name" required>
            <div id="departmentNameError" class="error-message"></div>
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" placeholder="Enter description" name="Description_name" required>
            <div id="descriptionError" class="error-message"></div>
        </div>
        <div>
            <label for="departmentType">Department Type:</label>
            <input type="text" id="departmentType" placeholder="Enter department type" name="Department_type" required>
            <div id="departmentTypeError" class="error-message"></div>
        </div>
     <button class="outlined-button" >  <input type="submit" value="Add Department"> </button>  
    </form>

    <script>
        function validateForm() {
            var departmentName = document.getElementById("departmentName").value;
            var description = document.getElementById("description").value;
            var departmentType = document.getElementById("departmentType").value;
            var isValid = true;

            // Reset error messages
            document.getElementById("departmentNameError").innerHTML = "";
            document.getElementById("descriptionError").innerHTML = "";
            document.getElementById("departmentTypeError").innerHTML = "";

            // Department Name validation
            if (departmentName.trim() === "") {
                document.getElementById("departmentNameError").innerHTML = "Department Name is required";
                isValid = false;
            }

            // Description validation
            if (description.trim() === "") {
                document.getElementById("descriptionError").innerHTML = "Description is required";
                isValid = false;
            }

            // Department Type validation
            if (departmentType.trim() === "") {
                document.getElementById("departmentTypeError").innerHTML = "Department Type is required";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>

