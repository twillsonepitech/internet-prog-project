<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body style="margin: 50px;">
    <h1>List of Orders</h1>
    <a class="btn btn-success" href="/project/form.php" role="button">New Order</a>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>order_id</th>
                <th>contact_person</th>
                <th>company_name</th>
                <th>email</th>
                <th>contact_no</th>
                <th>occasion</th>
                <th>location</th>
                <th>event_address</th>
                <th>event_date</th>
                <th>event_time</th>
                <th>budget</th>
                <th>num_pax</th>
                <th>special_requests</th>
                <th>promo_code</th>
                <th>subscribed</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "cateringdata";

            $connection = new mysqli($servername, $username, $password, $database);

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM orders";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            while ($row = $result->fetch_assoc()) {
                $subscribed = $row["subscribed"] == 1 ? "Yes" : "No";
                echo "<tr>
                        <td>$row[order_id]</td>
                        <td>$row[contact_person]</td>
                        <td>$row[company_name]</td>
                        <td>$row[email]</td>
                        <td>$row[contact_no]</td>
                        <td>$row[occasion]</td>
                        <td>$row[location]</td>
                        <td>$row[event_address]</td>
                        <td>$row[event_date]</td>
                        <td>$row[event_time]</td>
                        <td>$row[budget]</td>
                        <td>$row[num_pax]</td>
                        <td>$row[special_requests]</td>
                        <td>$row[promo_code]</td>
                        <td>$subscribed</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='update'>Update</a>
                            <a class='btn btn-danger btn-sm' href='/project/delete.php?id=" . $row["order_id"] . "'>Delete</a>
                        </td>
                    </tr>
                ";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
