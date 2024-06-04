<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="../index.css">
    <style>
        .course-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
            font-size: 16px;
            width: 100%;
        }

        .course-list li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
        }

        .course-list li a {
            color: #333;
            text-decoration: none;
        }

        .course-list li a:hover {
            text-decoration: underline;
        }

        .arrow {
            font-size: 18px;
        }

        input {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
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
    <div class="select_course_container">
        <div class="container">
            <form id="searchForm">
                <input type="text" id="searchInput" placeholder="Search by Course Name">
            </form>
            <ul class="course-list">
                <?php
                include "conn.php";

                // Query to retrieve course name and code from your database
                $sql = "SELECT Course_Name, Course_Code, Subject_ID FROM subject";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . $row["Course_Name"] . " - " . $row["Course_Code"] . "<a href='course_report.php?subject_id=" . $row["Subject_ID"] . "' class='arrow'>&rarr;</a></li>";
                }

                $conn->close();
                ?>
            </ul>
        </div>
    </div>

    <script>
        const courseList = document.querySelector('.course-list');
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('keyup', function() { // Use keyup event for live search
            const searchTerm = searchInput.value.toLowerCase();

            courseList.querySelectorAll('li').forEach(listItem => {
                const courseName = listItem.textContent.toLowerCase();
                listItem.style.display = courseName.includes(searchTerm) ? 'flex' : 'none';
            });
        });
    </script>
</body>

</html>