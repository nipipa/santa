<?php
$action = $_POST['action'];

require_once 'function.php';

switch ($action) {
    case 'showZad':
        showZad();
        break;
    case 'showUsers':
        showUsers();
        break;
    case 'showRooms':
        showRooms();
        break;
    }