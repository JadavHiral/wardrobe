<?php
include 'config.php';
include 'layout.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Feedback</title>

    <style>
        .container {
            padding: 30px;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        #searchInput {
            margin-bottom: 15px;
            padding: 8px 12px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
        }

        th {
            background-color: #2c3e50;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eaeaea;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
        }

        .no-data {
            text-align: center;
            color: #999;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Manage User Feedback</h2>

        <input type="text" id="searchInput" placeholder="Search feedback...">

        <table id="FeedbackTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="feedbackBody">
                <?php
                $query = "SELECT * FROM feedback ORDER BY id DESC";
                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['phno'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['subject'] ?></td>
                            <td><?= $row['message'] ?></td>
                            <td>
                                <a class="btn-delete" href="delete_feedback.php?id=<?= $row['id'] ?>"
                                    onclick="return confirm('Delete this feedback?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='no-data'>No feedback found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById("searchInput").addEventListener("keyup", function () {
            const value = this.value.toLowerCase();
            const rows = document.querySelectorAll("#feedbackBody tr");

            rows.forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(value)
                    ? ""
                    : "none";
            });
        });
    </script>

</body>

</html>
