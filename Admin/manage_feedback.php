<?php
include 'config.php';
include 'layout.php';

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Feedback</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f9;
        }

        .container {
            padding: 30px;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            /* space between buttons */
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .search-box input {
            padding: 8px 12px;
            width: 250px;
            border-radius: 4px;
            border: 1px solid #ccc;
            /* padding-top: 5px; */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border-radius: 6px;
            overflow: hidden;
        }

        th {
            background-color: #2c3e50;
            color: white;
            padding: 12px;
            text-transform: uppercase;
            font-size: 14px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eaeaea;
            font-size: 14px;
            color: #444;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            margin-right: 5px;
        }

        .btn-reply {
            background-color: #3498db;
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .btn-reply:hover {
            background-color: #2980b9;
        }

        .no-data {
            text-align: center;
            color: #999;
            padding: 15px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Manage User Feedback</h2>

        <!-- Search Bar -->
        <form method="get" class="top-bar">
            <div class="search-box">
                <input type="text" name="search" placeholder="Search by name, email, subject..."
                    value="<?php echo htmlspecialchars($search); ?>">
            </div>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Action</th>
            </tr>

            <?php
            if ($search != "") {
                $query = "SELECT * FROM feedback 
                      WHERE name LIKE '%$search%' 
                         OR email LIKE '%$search%' 
                         OR subject LIKE '%$search%'
                      ORDER BY id DESC";
            } else {
                $query = "SELECT * FROM feedback ORDER BY id DESC";
            }

            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['phno']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td>
                            <div class="action-buttons">
                                <!-- Reply Button -->
                                <!-- <a class="btn-reply"
                                    href="mailto:<?php /*echo $row['email']; ?>?subject=Re: <?php echo urlencode($row['subject']);*/ ?>">
                                    Reply
                                </a> -->

                                <!-- Delete Button -->
                                <a class="btn-delete" href="delete_feedback.php?id=<?php echo $row['id']; ?>"
                                    onclick="return confirm('Delete this feedback?')">
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7' class='no-data'>No feedback found</td></tr>";
            }
            ?>

        </table>

    </div>

</body>

</html>