<?php
define('BASEPATH', true);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../core/core.php';

$data = $_POST;

$person =  json_decode($data['person']);
$details =  json_decode($data['details']);
$core = new CORE();
$core->savePagoMatricula($person, $details);
