<?php
require 'config/constants.php';
session_start();
session_destroy();
header('location: ' . ROOT_URL);
die();
