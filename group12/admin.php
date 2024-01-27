<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Page</title>
    <style>
        footer {
            background: #404040;
            width: 100%;
            height: 50px;
            position: absolute;
            bottom: 0;
            left: 0;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background: black;">
            <div class="container-fluid">
                <a class="navbar-brand text-light" href="/group12/admin.php">Admin Page</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-light" href="/group12/home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-light" href="/group12/order.php">Order</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" id="searchInput" placeholder="Search"
                            aria-label="Search">
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <?php
        include('./admin/db.php');
        if (isset($_GET["deleted"])) {
            echo '
            <script>
                Swal.fire({
                    title: "Order deleted.",
                    icon: "success",
                    confirmButtonColor: "green",
                });
            </script>
            ';
        }
        else if (isset($_GET["updated"])) {
            echo '
            <script>
                Swal.fire({
                    title: "Order updated.",
                    icon: "success",
                    confirmButtonColor: "green",
                });
            </script>
            ';
        }
        ?>

        <table class="table text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">order_id</th>
                    <th scope="col">contact_person</th>
                    <th scope="col">contact_no</th>
                    <th scope="col">num_pax</th>
                    <th scope="col">event_date</th>
                    <th scope="col">location</th>

                    <!-- <th scope="col">company_name</th>
                <th scope="col">email</th>
                <th scope="col">occasion</th>
                <th scope="col">event_address</th>
                <th scope="col">event_time</th>
                <th scope="col">budget</th>
                <th scope="col">special_requests</th>
                <th scope="col">promo_code</th>
                <th scope="col">subscribed</th> -->

                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM orders";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr class="order-row" style="background: white;">
                        <td>
                            <?php echo $row["order_id"] ?>
                        </td>
                        <td>
                            <?php echo $row["contact_person"] ?>
                        </td>
                        <td>
                            <?php echo $row["contact_no"] ?>
                        </td>
                        <td>
                            <?php echo $row["num_pax"] ?>
                        </td>
                        <td>
                            <?php echo $row["event_date"] ?>
                        </td>
                        <td>
                            <?php echo $row["location"] ?>
                        </td>

                        <!-- <td>
                        <?php echo $row["company_name"] ?>
                    </td>
                    <td>
                        <?php echo $row["email"] ?>
                    </td>
                    <td>
                        <?php echo $row["occasion"] ?>
                    </td>
                    <td>
                        <?php echo $row["event_address"] ?>
                    </td>
                    <td>
                        <?php echo $row["event_time"] ?>
                    </td>
                    <td>
                        <?php echo $row["budget"] ?>
                    </td>
                    <td>
                        <?php echo $row["special_requests"] ?>
                    </td>
                    <td>
                        <?php echo $row["promo_code"] ?>
                    </td>
                    <td>
                        <?php echo $row["subscribed"] ? "Yes" : "No" ?>
                    </td> -->
                        <td>
                            <a href="info.php?id=<?php echo $row["order_id"] ?>" class="link-dark"><i
                                    class="fa-solid fa-eye fs-5 me-3"></i></a>
                            <a href="admin/edit.php?id=<?php echo $row["order_id"] ?>" class="link-dark"><i
                                    class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="admin/delete.php?id=<?php echo $row["order_id"] ?>" class="link-dark"><i
                                    class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy;2024 | Designed by <a href="mailto:thomas.willson@s.unikl.edu.my">Thomas
                Willson</a> and <a href="mailto:antoine.gavira.bottari@s.unikl.edu.my">Antoine Gavira-Bottari</a></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#searchInput').on('input', searchOrders);
        });

        function searchOrders() {
            var searchTerm = $('#searchInput').val().toLowerCase();

            $('.order-row').hide();
            $('.order-row').each(function () {
                var rowData = $(this).text().toLowerCase();
                if (rowData.includes(searchTerm)) {
                    $(this).show();
                }
            });
        }
    </script>

</body>

</html>