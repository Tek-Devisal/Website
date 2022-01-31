<?php
    require_once '../../helpers/functions.php';

    class ManageApointment{
        public $name;
        public $phonenumber;
        public $service;
        public $date;
        public $time; 
        public $reason;

        function __construct(){
            $this->name             = $_POST['name'];
            $this->phonenumber      = $_POST['phone_number'];
            $this->service          = $_POST['service'];
            $this->date             = $_POST['date'];
            $this->time             = $_POST['time'];
            $this->reason           = $_POST['message'];
        }

        function verifyDate($date){
            // $day = getDayFromDate($date);
            
            //checking if the selected date has been back dated
            $date_now = time();

            if($date_now > strtotime($date)){
                return 2;
            }
            // else if($day == 'Saturday' || $day == 'Sunday'){
            //     return 1;
            // }
            else{
                return 1;
            }
        }

        function ConfirmPresence($con){
            $query = "SELECT * FROM apointments WHERE client_name = :cn AND phone_number = :n 
                AND service = :s AND apointment_date = :d AND apointment_time = :t AND reason = :r AND status = 0";
            $statement = $con->prepare($query);
            $statement->execute(
                array(
                    ":cn"   => $this->name,
                    ":n"    => $this->phonenumber,
                    ":s"    => $this->service, 
                    ":d"    => $this->date, 
                    ":t"    => $this->time, 
                    ":r"    => $this->reason, 
                )
            );

            $count = $statement->rowCount();
            if($count > 0){
                echo "Apointment already booked";
            }
            else{
                //add new user
                $this->SaveInfo($con);
            }
        }

        function SaveInfo($con){
            $query = "INSERT INTO apointments(status, client_name, phone_number, service, 
                reason, apointment_date, apointment_time)
                VALUES(0, :cn, :n, :s, :r, :d, :t)";
            $statement = $con->prepare($query);

            $has_added = $statement->execute(
                array(
                    ":cn"   => $this->name,
                    ":n"    => $this->phonenumber,
                    ":s"    => $this->service, 
                    ":r"    => $this->reason,
                    ":d"    => $this->date, 
                    ":t"    => $this->time, 
                )
            );

            if($has_added){
                echo 1;
                $this->sendSMSToUser($con);
                $this->sendSMSToAdmin($con);
            }
            else{
                echo "Something went wrong";
            }
        }

        function sendSMSToUser($con){
            //fetch time using the time id included there. 
            $message = "Hi " . $this->name . "," . dateFormat($this->date) . " at " . timeFormat(fetchFromAnytableUsingIDAsOnlyParameter($con, 'available_time', $this->time, 'time')) . " is your apointment date. Call +233246756644 if you have any issues or concerns.";
            if(sendSms($this->phonenumber, $message)){
                return 1;
            }
            else{
                return 0;
            }
        }

        function sendSMSToAdmin($con){
            $message = "Hi Tek-Devisal, " . $this->name . " has scheduled an apointment for " . dateFormat($this->date) . " at " . timeFormat(fetchFromAnytableUsingIDAsOnlyParameter($con, 'available_time', $this->time, 'time')) . ". Do well to contact " . $this->name . " on " . $this->phonenumber;
            if(sendSms("0268977129", $message)){
                return 1;
            }
            else{
                return 0;
            }
        }
    }
?>