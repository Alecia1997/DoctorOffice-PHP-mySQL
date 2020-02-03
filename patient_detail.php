<?php
    require_once 'connect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Patient Detail | Doctor's office</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <?php
            include 'fragments/navigation.php';
?>
<main>
<?php
    
    
    // Systems SQL code
                $patient_id = $_GET['patient_id'];
                $appointments_sql = "SELECT doctors.name as doctor_name,appointments.appointment_time, appointments.appointment_date FROM patients INNER JOIN appointments ON appointments.patient_id = patients.id INNER JOIN doctors ON appointments.doctor_id = doctors.id WHERE patients.id = :patient_id;";
                $statement = $pdo->prepare($appointments_sql);
                $statement->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
                $statement->execute();
                $appointments_results = $statement->fetchAll();
           
   
              // Output systems information here
                 echo "  <p> this patient has the following appointments </p>";
                echo "  <ul>";
                foreach ($appointments_results as $appointment_row) {
                $appointment_time = $appointment_row['appointment_time'];
                $appointment_date = $appointment_row['appointment_date'];
             $doctor_name = $appointment_row['doctor_name'];
                
            
               
                echo "<li>$appointment_time</li>";
                echo "<li>$appointment_date</li>";
                echo "<li>$doctor_name</li>";
                
                }
                echo " </ul>";
    
    
?>
        </main>
    </body>
</html>
<?php 
require_once 'disconnect.php'; 
?>