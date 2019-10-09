<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "blog");
define("CHARSET", "utf8mb4");

define("APPROOT", dirname(dirname(__FILE__)));
define("URLROOT", "http://localhost/journal");
define("SITENAME", "");
date_default_timezone_set("America/New_York");

session_start();
