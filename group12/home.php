<?php include('./view/header.php');

if (isset($_GET["send"])) {
    echo '
    <script>
        Swal.fire({
            title: "Congratulations !",
            text: "Event has been successfuly ordered.",
            icon: "success",
            confirmButtonColor: "green",
        });
    </script>
    ';
}

?>
<div id="card-area">
    <div class="wrapper">
        <div class="box-area">
            <div class="box">
                <img src="assets/wedding.jpg" alt="">
                <div class="overlay">
                    <h3>Wedding</h3>
                    <p>Celebrate the most special day of your life with our exquisite wedding packages. Create lasting
                        memories in a magical setting.</p>
                    <a href="/group12/order.php">Book Now</a>
                </div>
            </div>
            <div class="box">
                <img src="assets/birthday.jpg" alt="">
                <div class="overlay">
                    <h3>Birthday</h3>
                    <p>Make your birthday a day to remember! Our birthday packages offer a perfect blend of fun, joy,
                        and delicious treats for everyone.</p>
                    <a href="/group12/order.php">Book Now</a>
                </div>
            </div>
            <div class="box">
                <img src="assets/housewarming.jpg" alt="">
                <div class="overlay">
                    <h3>Housewarming</h3>
                    <p>Warm your new home with a housewarming party. Our packages ensure a cozy and delightful gathering
                        for your friends and family.</p>
                    <a href="/group12/order.php">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('./view/footer.php'); ?>