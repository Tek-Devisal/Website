<?php
    include_once 'sms.php';

    function sendSms($phone_number, $message){
        $send = new SendSms();
        $send->key = 'txTZ1jJdWREgUqJSrdCIVu2IO';
        $send->message = strip_tags(str_replace(array("\r", "\n"), ' ', str_replace(array("&"), ' n ', $message)));
        // $send->message = $message;

        $send->numbers = $phone_number;

        $sender_id    = 'APCS';
        $send->sender = $sender_id;
        $send->sendMessage();
    }
    
    function fetchFromAnytableUsingIDAsOnlyParameter($con, $table_name, $id, $what_to_return){
        $query = "SELECT * FROM $table_name WHERE id = :id";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":id" => $id,
            )
        );
        $result = $statement->fetch();
        return $result[$what_to_return];
    }

    function fetchFirstImage($con, $project_id){
        $query = "SELECT image_url FROM images WHERE project_id = :id LIMIT 1";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":id" => $project_id,
            )
        );
        $result = $statement->fetch();
        return $result['image_url'];
    }

    function fetchFirstShopImage($con, $project_id){
        $query = "SELECT image_url FROM shop_images WHERE project_id = :id LIMIT 1";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":id" => $project_id,
            )
        );
        $result = $statement->fetch();
        return $result['image_url'];
    }

    function dateFormat($date){
        return date('l, M j, Y', strtotime($date));
    }

    function timeFormat($time){
        return date('H:i A', strtotime($time));
    }

    function moneyFormat($amount){
        return 'GHS ' . number_format($amount, 2);
    }