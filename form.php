<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Request Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-8 offset-md-2 form-container">
                <div class="panel panel-primary">
                    <header class="panel-heading">
                        <h2 class="mb-0">Enquire Now! Request FREE Quote</h2>
                    </header>
                    <div class="panel-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <?php
                            // Initialize variables
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
                                    $subscription = sanitize_input($_POST["subscription"]);
                                }

                                if (empty($nameErr) && empty($emailErr) && empty($companyErr) && empty($phoneErr) && empty($occasionErr) && empty($locationErr) && empty($eventAddressErr) && empty($eventDateErr) && empty($eventTimeErr) && empty($budgetErr) && empty($nbPaxErr)) {
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $database = "cateringdata";

                                    $connection = new mysqli($servername, $username, $password, $database);

                                    if ($connection->connect_error) {
                                        die("Connection failed: " . $connection->connect_error);
                                    } else {
                                        $stmt = $connection->prepare("INSERT INTO orders (contact_person, company_name, email, contact_no,
                                                occasion, location, event_address, event_date, event_time, budget, num_pax, special_requests, promo_code, subscribed)
                                                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                        $stmt->bind_param(
                                            "sssssssssiissi",
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
                                            $subscription
                                        );
                                        $stmt->execute();
                                        echo "Order registered successfully...";
                                        $stmt->close();
                                        $connection->close();
                                    }

                                    header("Location: index.php");
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

                            <div class="mb-4">
                                <h4 class="mb-3">Event Details</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6 input-container position-relative">
                                        <label for="occasion" class="label-style">Occasion <span
                                                style="color: red">*</span></label>
                                        <select id="occasion" name="occasion" class="form-control"
                                            value="<?php echo $occasion; ?>">
                                            <option value="" disabled selected hidden>Select Occasion...</option>
                                            <option value="Wedding">Wedding</option>
                                            <option value="Birthday">Birthday</option>
                                            <option value="Anniversary">Anniversary</option>
                                            <!-- ... include all other options here ... -->
                                        </select>
                                        <span style="color: red">
                                            <?php echo $occasionErr; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 input-container position-relative">
                                        <label for="location" class="label-style">Location <span
                                                style="color: red">*</span></label>
                                        <select id="location" name="location" class="form-control"
                                            value="<?php echo $location; ?>">
                                            <option value="" disabled selected hidden>Location...</option>
                                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                                            <option value="Selangor">Selangor</option>
                                        </select>
                                        <span style="color: red">
                                            <?php echo $locationErr; ?>
                                        </span>
                                    </div>

                                </div>
                                <div class="section-separator"></div>
                                <div class="form-row">
                                    <div class="form-group col-md-12 input-container position-relative">
                                        <label for="event_address" class="label-style">Event Address <span
                                                style="color: red">*</span></label>
                                        <textarea placeholder="Event Address..." id="event_address" name="event_address"
                                            class="form-control" rows="4"
                                            value="<?php echo $eventAddress; ?>"></textarea>
                                        <span style="color: red">
                                            <?php echo $eventAddressErr; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 input-container position-relative">
                                        <label for="event_date" class="label-style">Event Date <span
                                                style="color: red">*</span></label>
                                        <input class="form-control" type="date" min="<?= date('Y-m-d'); ?>"
                                            id="event_date" name="event_date" value="<?php echo $eventDate; ?>"><br>
                                        <span style="color: red">
                                            <?php echo $eventDateErr; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 input-container position-relative">
                                        <label for="event_date" class="label-style">Event Time <span
                                                style="color: red">*</span></label>
                                        <input class="form-control" type="time" id="event_time" name="event_time"
                                            value="<?php echo $eventTime; ?>"><br>
                                        <span style="color: red">
                                            <?php echo $eventTimeErr; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="section-separator"></div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 input-container position-relative">
                                        <label for="budget" class="label-style">Budget/Pax (RM) <span
                                                style="color: red">*</span></label>
                                        <input placeholder="0" class="form-control" type="number" id="budget"
                                            name="budget" value="<?php echo $budget; ?>">
                                        <span style="color: red">
                                            <?php echo $budgetErr; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-4 input-container position-relative">
                                        <label for="nbPax" class="label-style">Number of Pax <span
                                                style="color: red">*</span></label>
                                        <input placeholder="0" class="form-control" type="number" id="nbPax"
                                            name="nbPax" value="<?php echo $nbPax; ?>">
                                        <span style="color: red">
                                            <?php echo $nbPaxErr; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-4 input-container position-relative">
                                        <label for="result" class="label-style" style="background-color: #eee;">Total
                                            Budget</label>
                                        <input placeholder="RM0" class="form-control" type="text" id="result"
                                            name="result" value="<?php echo $total; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="section-separator"></div>
                            <div class="mb-4">
                                <h4 class="mb-3">Contact Details</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-6 input-container position-relative">
                                        <label for="name" class="label-style">Contact Person <span
                                                style="color: red">*</span></label>
                                        <input placeholder="Contact Person" class="form-control" type="text" id="name"
                                            name="name" value="<?php echo $name; ?>">
                                        <span style="color: red">
                                            <?php echo $nameErr; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 input-container position-relative">
                                        <label for="company" class="label-style">Company Name <span
                                                style="color: red">*</span></label>
                                        <input placeholder="Company Name" class="form-control" type="text" id="company"
                                            name="company" value="<?php echo $company; ?>">
                                        <span style="color: red">
                                            <?php echo $companyErr; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 input-container position-relative">
                                        <label for="email" class="label-style">Email <span
                                                style="color: red">*</span></label>
                                        <input placeholder="Email" class="form-control" type="email" id="email"
                                            name="email" value="<?php echo $email; ?>">
                                        <span style="color: red">
                                            <?php echo $emailErr; ?>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 input-container position-relative">
                                        <input class="form-control" type="tel" id="phone" name="phone"
                                            value="<?php echo $phone; ?>"><br>
                                        <span style="color: red">
                                            <?php echo $phoneErr; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="section-separator"></div>
                            <div class="mb-4">
                                <h4 class="mb-3">Other Details</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-12 input-container position-relative">
                                        <label for="requests" class="label-style">Special Requests</label>
                                        <textarea placeholder="Special Requests..." id="requests" name="requests"
                                            class="form-control" rows="4" value="<?php echo $requests; ?>"></textarea>
                                    </div>
                                    <div class="form-group col-md-6 input-container position-relative">
                                        <label for="promoCode" class="label-style">Promo Code</label>
                                        <input placeholder="Promo Code" class="form-control" type="text" id="promoCode"
                                            name="promoCode" value="<?php echo $promoCode; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mt-2">
                                            <label for="subscription">Subscribe to our newsletter</label>
                                            <input style="position:relative; top: -26px; left: 65%;" type="checkbox"
                                                id="subscription" name="subscription"
                                                value="<?php echo $subscription; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                Note: In the event your chosen caterer is not available, we will assist to forward your
                                request to other caterers.
                            </div>
                            <input value="Submit for FREE Quote" type="submit" class="btn btn-primary">
                        </form>
                    </div>
                    <footer class="panel-footer">
                        <small>&copy; <a href="mailto:thomas.willson@s.unikl.edu.my">Thomas Matthieu
                                Willson</a> | <a href="mailto:antoine.gavira.bottari@s.unikl.edu.my">Antoine Richard
                                Gavira-Bottari</a></small>
                    </footer>
                </div>
            </div>
        </div>
    </div>
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