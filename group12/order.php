<?php include('./view/header.php'); ?>
<div class="content">
    <div class="content__inner">
        <div class="container overflow-hidden">
            <div class="multisteps-form">
                <div class="row">
                    <div class="col-12 col-lg-8 mt-1 ml-auto mr-auto mb-4">
                        <div class="multisteps-form__progress">
                            <button class="multisteps-form__progress-btn js-active" title="Event Details">Event
                                Details</button>
                            <button class="multisteps-form__progress-btn" title="Contact Details">Contact
                                Details</button>
                            <button class="multisteps-form__progress-btn" title="Other Details">Other
                                Details</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="multisteps-form__form" method="post"
                            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
                                    $subscription = isset($_POST["subscription"]) ? 1 : 0;
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

                                    header("Location: /group12/home.php?send=POST");
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
                            <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active"
                                data-animation="scaleIn">
                                <h3 class="multisteps-form__title">Event Details<button class="trash-button"
                                        type="button" onclick="deleteEventDetails()">Clear All</button>
                                </h3>
                                <div class="multisteps-form__content">
                                    <div class="form-row mt-4">
                                        <div class="col-12 col-sm-6">
                                            <select id="occasion" name="occasion"
                                                class="multisteps-form__input form-control"
                                                value="<?php echo $occasion; ?>">
                                                <option value="" disabled selected hidden>Select Occasion</option>
                                                <option value="Wedding">Wedding</option>
                                                <option value="Birthday">Birthday</option>
                                                <option value="Housewarming">Housewarming</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                                            <select id="location" name="location"
                                                class="multisteps-form__input form-control"
                                                value="<?php echo $location; ?>">
                                                <option value="" disabled selected hidden>Location</option>
                                                <option value="Kuala Lumpur">Kuala Lumpur</option>
                                                <option value="Selangor">Selangor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row mt-4">
                                        <div class="col-12 col-sm-12">
                                            <textarea placeholder="Event Address" id="event_address"
                                                name="event_address" class="multisteps-form__input form-control"
                                                rows="2" value="<?php echo $eventAddress; ?>"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row mt-4">
                                        <div class="col-12 col-sm-6">
                                            <input class="multisteps-form__input form-control" type="date"
                                                min="<?= date('Y-m-d'); ?>" id="event_date" name="event_date"
                                                value="<?php echo $eventDate; ?>">
                                        </div>
                                        <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                                            <input class="multisteps-form__input form-control" type="time"
                                                id="event_time" name="event_time" value="<?php echo $eventTime; ?>">
                                        </div>
                                    </div>
                                    <div class="form-row mt-4">
                                        <div class="col-12 col-sm-4">
                                            <input placeholder="Budget/Pax (RM)"
                                                class="multisteps-form__input form-control" type="number" id="budget"
                                                name="budget" value="<?php echo $budget; ?>">
                                        </div>
                                        <div class="col-12 col-sm-4 mt-4 mt-sm-0">
                                            <input placeholder="Number of Pax" class="form-control" type="number"
                                                id="nbPax" name="nbPax" value="<?php echo $nbPax; ?>">
                                        </div>
                                        <div class="col-12 col-sm-4 mt-4 mt-sm-0">
                                            <input placeholder="Total Budget" class="form-control" type="text"
                                                id="result" name="result" value="<?php echo $total; ?>" readonly>
                                        </div>
                                    </div>
                                    <div id="gray-line"></div>

                                    <div class="button-row d-flex mt-4">
                                        <button style="color: white; border-color: white; background: #ff5e00;"
                                            class="btn btn-primary ml-auto js-btn-next" type="button" title="Next"
                                            id="next1" name="next1" onclick="validateEventDetails()">Next</button>
                                    </div>
                                </div>
                            </div>

                            <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                                <h3 class="multisteps-form__title">Contact Details<button class="trash-button"
                                        type="button" onclick="deleteContactDetails()">Clear All</button>
                                </h3>
                                <div class="multisteps-form__content">
                                    <div class="form-row mt-4">
                                        <div class="col-12 col-sm-6">
                                            <input placeholder="Contact Person"
                                                class="multisteps-form__input form-control" type="text" id="name"
                                                name="name" value="<?php echo $name; ?>">
                                        </div>
                                        <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                                            <input placeholder="Company Name"
                                                class="multisteps-form__input form-control" type="text" id="company"
                                                name="company" value="<?php echo $company; ?>">
                                        </div>
                                    </div>
                                    <div class="form-row mt-4">
                                        <div class="col-12 col-sm-6">
                                            <input placeholder="Email" class="multisteps-form__input form-control"
                                                type="email" id="email" name="email" value="<?php echo $email; ?>">
                                        </div>
                                        <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                                            <input class="multisteps-form__input form-control" type="tel" id="phone"
                                                name="phone" value="<?php echo $phone; ?>">
                                        </div>
                                    </div>
                                    <div id="gray-line"></div>

                                    <div class="button-row d-flex mt-4">
                                        <button
                                            style="margin-left:500px; color: #ff5e00; border-color: white; background: #ffeee4;"
                                            class="btn js-btn-prev" type="button" title="Prev">Prev
                                        </button>
                                        <button style="color: white; border-color: white; background: #ff5e00;"
                                            class="btn btn-primary ml-auto js-btn-next" type="button" title="Next"
                                            onclick="validateContactDetails()">Next</button>
                                    </div>
                                </div>
                            </div>

                            <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                                <h3 class="multisteps-form__title">Other Details<button class="trash-button"
                                        type="button" onclick="deleteOtherDetails()">Clear All</button>
                                </h3>
                                <div class="multisteps-form__content">
                                    <div class="form-row mt-4">
                                        <div class="col-12 col-sm-12">
                                            <textarea placeholder="Special Requests" id="requests" name="requests"
                                                class="multisteps-form__input form-control" rows="2"
                                                value="<?php echo $requests; ?>"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row mt-4">
                                        <div class="col-12 col-sm-6">
                                            <input placeholder="Promo Code" class="multisteps-form__input form-control"
                                                type="text" id="promoCode" name="promoCode"
                                                value="<?php echo $promoCode; ?>">
                                        </div>
                                        <div class="form-check mt-2">
                                            <input type="checkbox" id="subscription" name="subscription" class="toggle"
                                                value="1">
                                            <label for="subscription">
                                                &nbsp;Subscribe to our newsletter
                                            </label>
                                        </div>
                                    </div>
                                    <div id="gray-line"></div>
                                    <div class="button-row d-flex mt-4">
                                        <button
                                            style="margin-left:500px; color: #ff5e00; border-color: white; background: #ffeee4;"
                                            class="btn js-btn-prev" type="button" title="Prev">Prev
                                        </button>
                                        <button class="btn btn-success ml-auto" type="submit" title="Send">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function () {
        var budget = $('#budget');
        var nb_pax = $('#nbPax');
        var result = $('#result');

        function updateResult() {
            var num1 = parseInt(budget.val()) || 0;
            var num2 = parseInt(nb_pax.val()) || 0;
            var res = 'RM' + (num1 * num2);
            result.val(res);
        }

        budget.on('input', updateResult);
        nb_pax.on('input', updateResult);

        var inputElements = [
            'occasion', 'location', 'event_address',
            'event_date', 'event_time', 'budget', 'nbPax',
            'name', 'company', 'email', 'phone'
        ];

        function updateInputBorder(element) {
            element.css('border', '');
        }

        for (var i = 0; i < inputElements.length; i++) {
            (function (index) {
                $('#' + inputElements[index]).on('input', function () {
                    updateInputBorder($('#' + inputElements[index]));
                });
            })(i);
        }
    });
</script>
<script>
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
</script>
<?php include('./view/footer.php'); ?>