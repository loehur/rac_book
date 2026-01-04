<?php
$_start_time = microtime(true);

require_once('app/init.php');

$_init_time = microtime(true);

$route = new Route();

$_end_time = microtime(true);

// Debug timing (hapus setelah selesai debug)
echo "<!-- DEBUG TIMING:
  Init: " . round(($_init_time - $_start_time) * 1000, 2) . "ms
  Route: " . round(($_end_time - $_init_time) * 1000, 2) . "ms
  Total: " . round(($_end_time - $_start_time) * 1000, 2) . "ms
-->";