<?php

session_start();

require_once '../html/header.html';

if (!isset($_SESSION['connection'])){
    require_once '../html/navbar.html';
}else{
    if (isset($_SESSION['role'])){
        switch ($_SESSION['role']){
            case 'ADM':
                require_once '../html/adminNavbar.html';
                break;
            case 'MNG':
                require_once '../html/managerNavbar.html';
                break;
            default:
                require_once '../html/navbar.html';
                break;
            }
    }else{
        require_once '../html/navbar.html';
    }
}
require_once 'message.php';
require_once 'connectBd.php';