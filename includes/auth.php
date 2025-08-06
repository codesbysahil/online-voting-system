<?php
session_start();
if (!isset($_SESSION["voter_id"])) {
    header("Location: login.php");
    exit;
}
