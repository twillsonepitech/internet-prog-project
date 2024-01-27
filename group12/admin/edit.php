<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <title>Admin Edit Page</title>
    <style>
        footer {
            background: #404040;
            width: 100%;
            height: 50px;
            position: relative;
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
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit User Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>
        <?php include('db.php');
        $id = $_GET["id"];
        $sql = "SELECT * FROM orders WHERE order_id = $id LIMIT 1";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="container d-flex justify-content-center">
            <form method="post" action="" >
                <?php
                $name = $email = $company = $phone = $occasion = $location = $eventAddress = $eventDate = $eventTime = $budget = $nbPax = $requests = $promoCode = $subscription = "";
                $nameErr = $emailErr = $companyErr = $phoneErr = $occasionErr = $locationErr = $eventAddressErr = $eventDateErr = $eventTimeErr = $budgetErr = $nbPaxErr = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty($_POST["occasion"])) {
                        $occasionErr = "Occasion is required";
                    } else {
                        $occasion = sanitize_input($_POST["occasion"]);
                    }

                    if (empty($_POST["location"])) {
                        $locationErr = "Location is required";
                    } else {
                        $location = sanitize_input($_POST["location"]);
                    }

                    if (empty($_POST["event_address"])) {
                        $eventAddressErr = "Event Address is required";
                    } else {
                        $eventAddress = sanitize_input($_POST["event_address"]);
                    }

                    if (empty($_POST["event_date"])) {
                        $eventDateErr = "Event Date is required";
                    } else {
                        $eventDate = sanitize_input($_POST["event_date"]);
                    }

                    if (empty($_POST["event_time"])) {
                        $eventTimeErr = "Event Time is required";
                    } else {
                        $eventTime = sanitize_input($_POST["event_time"]);
                    }

                    if (empty($_POST["budget"])) {
                        $budgetErr = "Budget is required";
                    } else {
                        $budget = sanitize_input($_POST["budget"]);
                        if ($budget < 0) {
                            $budgetErr = "Cannot have negative budget";
                        }
                    }

                    if (empty($_POST["nbPax"])) {
                        $nbPaxErr = "Number of Pax is required";
                    } else {
                        $nbPax = sanitize_input($_POST["nbPax"]);
                        if ($nbPax < 0) {
                            $nbPaxErr = "Cannot have negative nbPax";
                        }
                    }

                    // Additional validation for contact details
                    if (empty($_POST["name"])) {
                        $nameErr = "Contact Person is required";
                    } else {
                        $name = sanitize_input($_POST["name"]);
                        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                            $nameErr = "Only letters and white space allowed";
                        }
                    }

                    if (empty($_POST["email"])) {
                        $emailErr = "Email is required";
                    } else {
                        $email = sanitize_input($_POST["email"]);
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Invalid email format";
                        }
                    }

                    if (empty($_POST["company"])) {
                        $companyErr = "Company is required";
                    } else {
                        $company = sanitize_input($_POST["company"]);
                    }

                    if (empty($_POST["phone"])) {
                        $phoneErr = "Phone Number is required";
                    } else {
                        $phone = sanitize_input($_POST["phone"]);
                        if (!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)) {
                            $phoneErr = "Invalid phone format";
                        }
                    }

                    if (!empty($_POST["requests"])) {
                        $requests = sanitize_input($_POST["requests"]);
                    }

                    if (!empty($_POST["promoCode"])) {
                        $promoCode = sanitize_input($_POST["promoCode"]);
                    }

                    if (!empty($_POST["subscription"])) {
                        $subscription = isset($_POST["subscription"]) ? 1 : 0;
                    }

                    if (empty($nameErr) && empty($emailErr) && empty($companyErr) && empty($phoneErr) && empty($occasionErr) && empty($locationErr) && empty($eventAddressErr) && empty($eventDateErr) && empty($eventTimeErr) && empty($budgetErr) && empty($nbPaxErr)) {
                        $stmt = $connection->prepare("UPDATE orders SET contact_person=?, company_name=?, email=?, contact_no=?,
                        occasion=?, location=?, event_address=?, event_date=?, event_time=?, budget=?, num_pax=?, special_requests=?, promo_code=?, subscribed=?
                        WHERE order_id = ?");
                        $stmt->bind_param(
                            "sssssssssiissii",
                            $name,
                            $company,
                            $email,
                            $phone,
                            $occasion,
                            $location,
                            $eventAddress,
                            $eventDate,
                            $eventTime,
                            $budget,
                            $nbPax,
                            $requests,
                            $promoCode,
                            $subscription,
                            $id
                        );
                        $stmt->execute();
                        echo "Order updated successfully...";
                        $stmt->close();
                        $connection->close();

                        header("Location: /group12/admin.php?updated=yes");
                        exit();

                    }
                }

                // Function to sanitize input data
                function sanitize_input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                ?>

                <div class="row mb-5">
                    <div class="col">
                        <label for="occasion" class="form-label">Occasion <span style="color: red">*</span></label>
                        <select id="occasion" name="occasion" class="form-control">
                            <option value="<?php echo $row["occasion"]; ?>">
                                <?php echo $row["occasion"]; ?>
                            </option>
                            <option value="Wedding">Wedding</option>
                            <option value="Birthday">Birthday</option>
                            <option value="Housewarming">Housewarming</option>
                        </select>
                        <span style="color: red">
                            <?php echo $occasionErr; ?>
                        </span>
                    </div>
                    <div class="col">
                        <label for="location" class="form-label">Location <span style="color: red">*</span></label>
                        <select id="location" name="location" class="form-control">
                            <option value="<?php echo $row["location"]; ?>">
                                <?php echo $row["location"]; ?>
                            </option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Selangor">Selangor</option>
                        </select>
                        <span style="color: red">
                            <?php echo $locationErr; ?>
                        </span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <label for="event_address" class="form-label">Event Address <span
                                style="color: red">*</span></label>
                        <textarea placeholder="Event Address..." id="event_address" name="event_address"
                            class="form-control" rows="2" ><?php echo $row["event_address"]; ?></textarea>
                        <span style="color: red">
                            <?php echo $eventAddressErr; ?>
                        </span>
                    </div>
                    <div class="col">
                        <label for="event_date" class="form-label">Event Date <span style="color: red">*</span></label>
                        <input class="form-control" type="date" min="<?= date('Y-m-d'); ?>" id="event_date"
                            name="event_date" value="<?php echo $row["event_date"]; ?>"><br>
                        <span style="color: red">
                            <?php echo $eventDateErr; ?>
                        </span>
                    </div>
                    <div class="col">
                        <label for="event_date" class="form-label">Event Time <span style="color: red">*</span></label>
                        <input class="form-control" type="time" id="event_time" name="event_time"
                            value="<?php echo $row["event_time"]; ?>"><br>
                        <span style="color: red">
                            <?php echo $eventTimeErr; ?>
                        </span>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <label for="budget" class="form-label">Budget/Pax (RM) <span style="color: red">*</span></label>
                        <input placeholder="0" class="form-control" type="number" id="budget" name="budget"
                            value="<?php echo $row["budget"]; ?>">
                        <span style="color: red">
                            <?php echo $budgetErr; ?>
                        </span>
                    </div>
                    <div class="col">
                        <label for="nbPax" class="form-label">Number of Pax <span style="color: red">*</span></label>
                        <input placeholder="0" class="form-control" type="number" id="nbPax" name="nbPax"
                            value="<?php echo $row["num_pax"]; ?>">
                        <span style="color: red">
                            <?php echo $nbPaxErr; ?>
                        </span>
                    </div>
                    <div class="col">
                        <label for="result" class="form-label">Total
                            Budget</label>
                        <input placeholder="RM0" class="form-control" type="text" id="result" name="result"
                            value="<?php echo "RM", ($row["budget"] * $row["num_pax"]); ?>" readonly>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <label for="name" class="form-label">Contact Person <span style="color: red">*</span></label>
                        <input placeholder="Contact Person" class="form-control" type="text" id="name" name="name"
                            value="<?php echo $row["contact_person"]; ?>">
                        <span style="color: red">
                            <?php echo $nameErr; ?>
                        </span>
                    </div>
                    <div class="col">
                        <label for="company" class="form-label">Company Name <span style="color: red">*</span></label>
                        <input placeholder="Company Name" class="form-control" type="text" id="company" name="company"
                            value="<?php echo $row["company_name"]; ?>">
                        <span style="color: red">
                            <?php echo $companyErr; ?>
                        </span>
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">Email <span style="color: red">*</span></label>
                        <input placeholder="Email" class="form-control" type="email" id="email" name="email"
                            value="<?php echo $row["email"]; ?>">
                        <span style="color: red">
                            <?php echo $emailErr; ?>
                        </span>
                    </div>
                </div>
                <div class="row mb-5">

                    <div class="col">
                        <label for="phone" class="form-label">Phone <span style="color: red">*</span></label>
                        <input class="form-control" type="tel" id="phone" name="phone"
                            value="<?php echo $row["contact_no"]; ?>"><br>
                        <span style="color: red">
                            <?php echo $phoneErr; ?>
                        </span>
                    </div>
                    <div class="col">
                        <label for="requests" class="form-label">Special Requests</label>
                        <textarea placeholder="Special Requests..." id="requests" name="requests" class="form-control"
                            rows="2"><?php echo $row["special_requests"]; ?></textarea>
                    </div>
                    <div class="col">
                        <label for="promoCode" class="form-label">Promo Code</label>
                        <input placeholder="Promo Code" class="form-control" type="text" id="promoCode" name="promoCode"
                            value="<?php echo $row["promo_code"]; ?>">
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <label for="subscription">Subscribe to our newsletter</label>
                        <input type="checkbox" id="subscription" name="subscription" value="1" <?php if ($row["subscribed"]) {
                            echo "checked='checked'";
                        } ?>>
                    </div>
                    <div class="col">
                        <input value="Update" type="submit" class="btn btn-success">
                        <a href="/group12/admin.php" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <p>&copy;2024 | Designed by <a href="mailto:thomas.willson@s.unikl.edu.my">Thomas
                Willson</a> and <a href="mailto:antoine.gavira.bottari@s.unikl.edu.my">Antoine Gavira-Bottari</a></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function () {
            // Get references to the input elements and result element
            var budget = $('#budget');
            var nb_pax = $('#nbPax');
            var result = $('#result');

            // Function to update the result based on the input values
            function updateResult() {
                var num1 = parseInt(budget.val()) || 0;
                var num2 = parseInt(nb_pax.val()) || 0;
                var res = 'RM' + (num1 * num2);
                result.val(res);
            }

            // Attach the updateResult function to the input change event
            budget.on('input', updateResult);
            nb_pax.on('input', updateResult);
        });
    </script>
    <script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
    </script>

</body>

</html>