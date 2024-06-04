<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <link rel="stylesheet" href="../index.css">
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
    <div class="student_container">
        <div class="container">
            <h1>Student Information</h1>
            <form id="studentForm">
                <div class="info">
                    <label for="studentId">Student ID:</label>
                    <input type="text" id="studentId" name="studentId" required>
                </div>
                <div class="info">
                    <label for="studentName">Student Name:</label>
                    <input type="text" id="studentName" name="studentName" required>
                </div>

                <div class="info">
                    <label for="matrixNumber">Matrix Number:</label>
                    <input type="text" id="matrixNumber" name="matrixNumber" required>
                </div>

                <div class="info">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="info">
                    <label for="courseName">Course Name:</label>
                    <select id="courseName" name="courseName" required>
                        <option value="">Select Course</option>
                        <!-- Options will be populated dynamically through JavaScript -->
                    </select>
                </div>

                <div class="info">
                    <!-- <label for="subjectId">Subject ID:</label> -->
                    <input type="hidden" id="subjectId" name="subjectId" required>
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('studentForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const jsonData = {};
            formData.forEach((value, key) => {
                jsonData[key] = value;
            });

            fetch('submit_student.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(jsonData)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    alert('Student information submitted successfully!');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        // Fetch course names and populate the dropdown
        document.addEventListener('DOMContentLoaded', function() {
            fetch('get_course_names.php')
                .then(response => response.json())
                .then(data => {
                    const courseDropdown = document.getElementById('courseName');
                    data.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course.Subject_ID;
                        option.textContent = course.Course_Name;
                        courseDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching course names:', error);
                });

            document.getElementById('courseName').addEventListener('change', function() {
                const selectedSubjectId = this.value;
                document.getElementById('subjectId').value = selectedSubjectId;
            });
        });
    </script>

</body>

</html>