<?php
session_start();
require "../server.php";

require '../routes/web.php';


// route
Router::run();


