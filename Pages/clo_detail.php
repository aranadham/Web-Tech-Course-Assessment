<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLO Detail Information</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <<div class="nav-rail">
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
        <div class="clo_detail_container">
            <div class="container">
                <h1>CLO Detail Information</h1>
                <form id="cloDetailForm">
                    <div class="info">
                        <label for="cloDetailId">CLO Detail ID:</label>
                        <input type="text" id="cloDetailId" name="cloDetailId" required>
                    </div>

                    <div class="info">
                        <label for="cloId">CLO ID:</label>
                        <input type="text" id="cloId" name="cloId" required>
                    </div>

                    <div class="info">
                        <label for="gradeId">Grade ID:</label>
                        <input type="text" id="gradeId" name="gradeId" required>
                    </div>

                    <div class="info">
                        <label for="percentage">Percentage:</label>
                        <input type="number" id="percentage" name="percentage" required>
                    </div>

                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
        </div>

        <script>
            document.getElementById('cloDetailForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(event.target);
                const jsonData = {};
                formData.forEach((value, key) => {
                    jsonData[key] = value;
                });

                fetch('submit_clo_detail.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(jsonData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        alert('CLO detail information submitted successfully!');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        </script>

</body>

</html>