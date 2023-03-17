<?php
include('includes/db_conn.php');
session_destroy();
header('location:index.php');
