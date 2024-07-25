<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Data Table</title>
    <style>
        table {
            width: 100%;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Data</h2>

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'php');

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $insert = "SELECT * FROM form";
    $result = mysqli_query($conn, $insert);

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Email</th>';
        echo '<th>Password</th>';
        echo '<th>Contact</th>';
        echo '<th>Gender</th>';
        echo '<th>City</th>';
        echo '<th>Hobby</th>';
        echo '<th>Image</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['password'] . '</td>';
            echo '<td>' . $row['contact'] . '</td>';
            echo '<td>' . $row['gender'] . '</td>';
            echo '<td>' . $row['city'] . '</td>';
            echo '<td>' . $row['hobby'] . '</td>';
            echo '<td><img src="image/' . $row['image'] . '></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "No records found";
    }

    ?>

</div>

</body>
</html>
