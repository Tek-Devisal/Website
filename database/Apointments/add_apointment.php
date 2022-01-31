<?php
    require_once '../config.php';
    require_once 'manage_appointment.php';
    require_once '../../helpers/functions.php';

    $add = new ManageApointment();
    $add->__construct();
    if($add->verifyDate($_POST['date']) == 1){
        if($add->ConfirmPresence($con) == 1){
            // echo 1;
            $add->sendSMSToUser();
            $add->sendSMSToAdmin();
        }
    }
    else{
        echo "You cannot choose a past date";
    }
