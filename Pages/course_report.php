<?php
include 'conn.php';

if (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];

    // Fetch data from the subject table
    $courseSql = "SELECT * FROM subject WHERE Subject_ID = '$subject_id'";
    $courseResult = $conn->query($courseSql);

    $courseData = [];
    while ($row = $courseResult->fetch_assoc()) {
        $courseData[] = $row;
    }

    // Fetch data from the clo table
    $cloSql = "SELECT * FROM clo WHERE Subject_ID = '$subject_id'";
    $cloResult = $conn->query($cloSql);

    $cloData = [];
    while ($row = $cloResult->fetch_assoc()) {
        $cloData[] = $row;
    }

    // Fetch CLO_IDs for the subject
    $cloIds = [];
    foreach ($cloData as $clo) {
        $cloIds[] = $clo['CLO_ID'];
    }
    $cloIdString = implode(",", $cloIds);

    // Fetch data from the clo_detail table using the retrieved CLO_IDs
    $cloDetailSql = "SELECT * FROM clo_detail WHERE CLO_ID IN ($cloIdString)";
    $cloDetailResult = $conn->query($cloDetailSql);

    $cloDetailData = [];
    while ($row = $cloDetailResult->fetch_assoc()) {
        $cloDetailData[] = $row;
    }

    // Fetch data from the grade_detail table
    $gradeDetailSql = "SELECT * FROM grade_detail WHERE Subject_ID = '$subject_id'";
    $gradeDetailResult = $conn->query($gradeDetailSql);

    $gradeDetailData = [];
    while ($row = $gradeDetailResult->fetch_assoc()) {
        $gradeDetailData[] = $row;
    }

    $conn->close();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Course Report</title>
        <link rel="stylesheet" href="../index.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            .container {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .table-container {
                border: 1px solid #dddddd;
                padding: 10px;
                margin: 5px;
                width: 90%;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th,
            td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
            }

            #di {
                display: none;
            }



            .download-btn {
                padding: 10px 20px;
                font-size: 16px;
                color: #fff;
                background-color: #007bff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                position: absolute;
                top: 5%;
                right: 3%;
                z-index: 1;
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
        <div id="reportContainer">
            <div class="report_container">
                <button onclick="downloadWord()" class="download-btn">Download Report</button>

                <div class="container">
                    <div class="table-container">
                        <div id="di" class="di">ggg</div>
                        <h2>COURSE ASSESSMENT REPORT</h2>
                        <?php if (!empty($courseData)) : ?>
                            <table>
                                <tr>
                                    <th>Course Name</th>
                                    <?php foreach ($courseData as $row) : ?>
                                        <td id="courseName"><?php echo $row['Course_Name']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th>Course Code</th>
                                    <?php foreach ($courseData as $row) : ?>
                                        <td><?php echo $row['Course_Code']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th>Session</th>
                                    <?php foreach ($courseData as $row) : ?>
                                        <td><?php echo $row['Session']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th>Lecture</th>
                                    <?php foreach ($courseData as $row) : ?>
                                        <td><?php echo $row['Lec']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <?php foreach ($courseData as $row) : ?>
                                        <td><?php echo $row['Date']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th>Subject ID</th>
                                    <?php foreach ($courseData as $row) : ?>
                                        <td><?php echo $row['Subject_ID']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            </table>
                        <?php else : ?>
                            <p>No courses available for the selected subject.</p>
                        <?php endif; ?>
                    </div>

                    <div class="table-container">
                        <h2>Course Outcomes</h2>
                        <?php if (!empty($cloData)) : ?>
                            <table>
                                <tr>
                                    <th>CLO ID</th>
                                    <?php foreach ($cloData as $row) : ?>
                                        <td><?php echo $row['CLO_ID']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th>CLO Caption</th>
                                    <?php foreach ($cloData as $row) : ?>
                                        <td><?php echo $row['CLO_Caption']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th>CLO Description</th>
                                    <?php foreach ($cloData as $row) : ?>
                                        <td><?php echo $row['CLO_Description']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th>Percentage</th>
                                    <?php foreach ($cloData as $row) : ?>
                                        <td><?php echo $row['Persentage']; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            </table>
                        <?php else : ?>
                            <p>No CLOs available.</p>
                        <?php endif; ?>
                    </div>

                    <div class="table-container">
                        <h2>CLO Details</h2>
                        <?php if (!empty($cloDetailData)) : ?>
                            <table>
                                <?php foreach ($cloDetailData[0] as $key => $value) : ?>
                                    <tr>
                                        <th><?php echo $key; ?></th>
                                        <?php foreach ($cloDetailData as $row) : ?>
                                            <td><?php echo $row[$key]; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php else : ?>
                            <p>No CLO details available.</p>
                        <?php endif; ?>
                    </div>

                    <div class="table-container">
                        <h2>Grade Details</h2>
                        <?php if (!empty($gradeDetailData)) : ?>
                            <table>
                                <?php foreach ($gradeDetailData[0] as $key => $value) : ?>
                                    <tr>
                                        <th><?php echo $key; ?></th>
                                        <?php foreach ($gradeDetailData as $row) : ?>
                                            <td><?php echo $row[$key]; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php else : ?>
                            <p>No grade details available.</p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>


            <script>
                function loadData() {
                    const xhr = new XMLHttpRequest();
                    xhr.open("GET", "fetch.php?subject_id=" + <?php echo json_encode($_GET['subject_id']); ?>, true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            console.log("Response Text: ", xhr.responseText);
                            try {
                                const data = JSON.parse(xhr.responseText);
                                const courseData = data.courseData;
                                const cloData = data.cloData;
                                const cloDetailData = data.cloDetailData;
                                const gradeDetailData = data.gradeDetailData;
                                const error = data.error;
                                if (error) {
                                    console.error("Error from PHP: ", error);
                                }
                                let output = '';

                                // Course Data Table
                                output += "<br><br><br>";
                                output += "<h2>COURSE ASSESSMENT REPORT</h2>";
                                output += "<table style='width: 100%; margin-bottom: 40px; border-collapse: collapse; font-size: 24px;'>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2; '>Course Name</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + courseData[0]['Course_Name'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Course Code</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + courseData[0]['Course_Code'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Session</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + courseData[0]['Session'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Lecture</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + courseData[0]['Lec'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Date</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + courseData[0]['Date'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Subject ID</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + courseData[0]['Subject_ID'] + "</td></tr>";
                                output += "</table>";

                                // CLO Data Table
                                output += "<br><br><br><br><br><br>";
                                output += "<h2>Course Outcomes</h2>";
                                output += "<table style='width: 100%; margin-bottom: 40px; border-collapse: collapse; font-size: 24px;'>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>CLO ID</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + cloData[0]['CLO_ID'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>CLO Caption</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + cloData[0]['CLO_Caption'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>CLO Description</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + cloData[0]['CLO_Description'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Percentage</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + cloData[0]['Persentage'] + "</td></tr>";
                                output += "</table>";

                                // CLO Detail Data Table
                                output += "<br><br><br><br><br><br>";
                                output += "<h2>CLO Details</h2>";
                                output += "<table style='width: 100%; margin-bottom: 40px; border-collapse: collapse; font-size: 24px;'>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>CLO Detail ID</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + cloDetailData[0]['CLO_Detail_ID'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>CLO ID</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + cloDetailData[0]['CLO_ID'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Grade ID</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + cloDetailData[0]['Grade_ID'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Percentage</td><td style='border: 1px solid black; padding: 8px; text-align:center;'>" + cloDetailData[0]['Percentage'] + "</td></tr>";
                                output += "</table>";

                                // Grade Detail Data Table
                                output += "<br><br><br><br><br><br>";
                                output += "<h2>Grade Details</h2>";
                                output += "<table style='width: 100%; margin-bottom: 40px; border-collapse: collapse; font-size: 24px;'>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Grade ID</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + gradeDetailData[0]['Grade_ID'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Activity Name</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + gradeDetailData[0]['Activity_Name'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Percentage</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + gradeDetailData[0]['Percentage'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Student ID</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + gradeDetailData[0]['Student_ID'] + "</td></tr>";
                                output += "<tr><td style='border: 1px solid black; padding: 8px; text-align: left; background-color: #f2f2f2'>Subject ID</td><td style='border: 1px solid black; padding: 8px; text-align: center;'>" + gradeDetailData[0]['Subject_ID'] + "</td></tr>";
                                output += "</table>";


                                const diElement = document.getElementById("di");
                                if (diElement) {
                                    diElement.innerHTML = output;
                                } else {
                                    console.error("Element with ID 'di' not found.");
                                }
                            } catch (e) {
                                console.error("Error parsing JSON:", e);
                            }
                        }
                    };
                    xhr.send();
                }

                function downloadWord() {
                    const courseName = document.getElementById("courseName").innerText;
                    const htmlContent = document.getElementById("di").innerHTML;
                    const blob = new Blob(['<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' + htmlContent + '</body></html>'], {
                        type: 'application/msword'
                    });
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = courseName + ' CI.doc';
                    link.click();
                }

                window.onload = function() {
                    loadData();
                }
            </script>
    </body>

    </html>
<?php
} else {
    echo "Subject ID not provided!";
}
?>