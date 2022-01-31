<?php

    require_once '../../helpers/functions.php';
    require_once '../config.php';

    $date   = $_POST['date'];

    $query = "SELECT * FROM available_time WHERE id NOT IN 
    (SELECT apointment_time FROM apointments WHERE apointment_date = :date)";

    $statement = $con->prepare($query);

    $statement->execute(
        array(
            ":date" => $date
        )
    );
    $count   = $statement->rowCount();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

     
    if($count > 0 && !empty($results)){?>
    	<label>Time</label>
        <select class="form-control" id="time" name="time" required>
            <option value="" disabled selected>Select Specific Time</option>
        <?php
            foreach($results as $result){?>
                <option value="<?= $result['id']?>"><?= $result['time_range']?></option>
        <?php
            }
        ?>
        </select>
<?php
    }else{
        echo " ";
    }