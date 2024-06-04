<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Detail Information</title>
    <link rel="stylesheet" href="../index.css">
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            color: #333;
        }

        .info {
            margin-bottom: 20px;
        }

        .info label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .info input {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .submit-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style> -->
</head>

<body>
    <div class="nav-rail">
        <a href="student.php" class="nav-item active">
            <img src="../icons/student1.svg" alt="">
            <span class="text">Student</span>
        </a>
        <a href="subject.php" class="nav-item">
            <img src="../icons/student.svg" alt="">
            <span class="text">Course</span>
        </a>
        <a href="clo.php" class="nav-item">
            <img src="../icons/clo.svg" alt="">
            <span class="text">Clo</span>
        </a>
        <a href="grade_detail.php" class="nav-item">
            <img src="../icons/grade.svg" alt="">
            <span class="text">Grade Details</span>
        </a>
        <a href="clo_detail.php" class="nav-item">
            <img src="../icons/clo_detail.svg" alt="">
            <span class="text">CLO Details</span>
        </a>

        <a href="select_course.php" class="nav-item">
            <img src="../icons/report.svg" alt="">
            <span class="text">Report</span>
        </a>
    </div>
    <div class="grade_container">
        <div class="container">
            <h1>Grade Detail Information</h1>
            <form id="gradeDetailForm">
                <div class="info">
                    <label for="gradeId">Grade ID:</label>
                    <input type="text" id="gradeId" name="gradeId" required>
                </div>

                <div class="info">
                    <label for="activityName">Activity Name:</label>
                    <input type="text" id="activityName" name="activityName" required>
                </div>

                <div class="info">
                    <label for="percentage">Percentage:</label>
                    <input type="number" id="percentage" name="percentage" required>
                </div>

                <div class="info">
                    <label for="studentId">Student ID:</label>
                    <input type="text" id="studentId" name="studentId" required>
                </div>

                <div class="info">
                    <label for="subjectId">Subject ID:</label>
                    <input type="text" id="subjectId" name="subjectId" required>
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('gradeDetailForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const jsonData = {};
            formData.forEach((value, key) => {
                jsonData[key] = value;
            });

            fetch('submit_grade_detail.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(jsonData)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    alert('Grade detail information submitted successfully!');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>

</body>

</html>