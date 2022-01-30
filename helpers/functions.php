<?php

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

    function dateFormat($date){
        return date('l, M j, Y', strtotime($date));
    }

    function timeFormat($time){
        return date('H:i A', strtotime($time));
    }