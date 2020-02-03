<?php
    require_once 'connect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Doctors Detail | Doctor's office</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <?php
            include 'fragments/navigation.php';
?>
<main>
<?php
                // Doctors SQL code
        
                $doctor_id = $_GET['doctor_id'];
                $doctor_sql = "SELECT doctors.name, doctors.specialisation, doctors.photograph,
                rooms.floor FROM doctors INNER JOIN rooms
                ON rooms.doctor_id = doctors.id
                WHERE doctors.id = :doctor_id;";
                $statement = $pdo->prepare($doctor_sql);
                $statement->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
                $statement->execute();
                $doctor_row = $statement->fetch();
            
              
              
                // Systems SQL code
                $appointments_sql = "SELECT patients.name as patient_name,appointments.appointment_time, appointments.appointment_date FROM doctors INNER JOIN appointments ON appointments.doctor_id = doctors.id INNER JOIN patients ON appointments.patient_id = patients.id WHERE doctors.id = :doctor_id;";
                $statement = $pdo->prepare($appointments_sql);
                $statement->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
                $statement->execute();
                $appointments_results = $statement->fetchAll();
    
               
                 // rooms SQL code
                $rooms_sql = "SELECT doctors.name as doctor_name, rooms.floor, rooms.number, rooms.name as room_name FROM doctors INNER JOIN rooms ON rooms.doctor_id = doctors.id
                WHERE doctors.id = :doctor_id;";
                $statement = $pdo->prepare($rooms_sql);
                $statement->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
                $statement->execute();
                $rooms_results = $statement->fetchAll();
            
       
    
    
                //  doctors SQL Output
 
               
                $doctor_path = $doctor_row['photograph'];
                $specialisation = $doctor_row['specialisation'];
                $name = $doctor_row['name'];
               
                         
     
                
                echo "<div class='detail'>";
                echo "<img class='flag' src='$doctor_path'>";
                echo "<p>$name is a $specialisation.</p>";
                echo "<p>$name is assigned to the following rooms</p>";
              
          // rooms SQL Output
   

              
               
                foreach ($rooms_results as $room_row) {
                $room_name = $room_row['room_name'];
                $room_number = $room_row['number'];
                $room_floor = $room_row['floor'];
                
            
            
                echo "<li>$room_name </li>";
                echo "<li>$room_number</li>  ";
                echo "<li>$room_floor</li> ";
                   
                
                }
           
    

                // Output systems information here
                echo "  <p>$name has the following appointments </p>";
                echo "  <ul>";
                foreach ($appointments_results as $appointment_row) {
                $appointment_time = $appointment_row['appointment_time'];
                $appointment_date = $appointment_row['appointment_date'];
             $patient_name = $appointment_row['patient_name'];
                
            
               
                echo "<li>$appointment_time</li>";
                echo "<li>$appointment_date</li>";
                echo "<li>$patient_name</li>";
                
                }
                echo " </ul>";
                $doctor_row = null;
                
                echo "</div>";
           
                
?>
        </main>
    </body>
</html>
<?php 
require_once 'disconnect.php'; 
?>