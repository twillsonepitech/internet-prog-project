<?php
include ('db.php');

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM orders WHERE order_id=$id";
    $connection->query($sql);
}

header("Location: /group12/admin.php?deleted=yes");
exit;
