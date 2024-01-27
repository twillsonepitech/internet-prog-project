<?php include('view/header.php'); ?>
<div class="info">
    <div class="leftbox">
        <nav>
            <a href="#" class="active">
                <i class="fa fa-user"></i>
            </a>
        </nav>
    </div>

    <?php
        include ('admin/db.php');
        $id = $_GET["id"];
        $sql = "SELECT * FROM orders WHERE order_id = $id LIMIT 1";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>
    <div class="rightbox">
        <div class="profile">
            <h1>Personal Info</h1>
            <h2>Contact Person</h2>
            <p><?php echo $row["contact_person"]; ?></p>
            <h2>Phone</h2>
            <p><?php echo $row["contact_no"]; ?></p>
            <h2>Number of Pax</h2>
            <p><?php echo $row["num_pax"]; ?></p>
            <h2>Event Date</h2>
            <p><?php echo $row["event_date"]; ?></p>
            <h2>Location</h2>
            <p><?php echo $row["location"]; ?></p>
        </div>
    </div>
</div>
<?php include('view/footer.php'); ?>