
<?php
    require_once 'connect.php';
?>

<?php
    // Handle form submission
    //(Refreshes the page with new info)

//Get information user selected
    $isPost = $_SERVER ['REQUEST_METHOD'] == 'POST';
    if ($isPost  && isset ($_POST['new-appointment-submit'])){
       $time = $_POST['appointment-time'];
       $date = $_POST['when']; 
       $patient = $_POST['appointment-patient']; 
       $doctor = $_POST['appointment-doctor']; 
        
        //code that checks whether there is already an existing combination in database
        $sql = "select * from appointments where appointment_time=:time and appointment_date=:date and doctor_id=:doctor";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':time', $time);
        $statement->bindValue(':date', $date);
        $statement->bindValue(':doctor', $doctor);
        $statement->execute();
        $checkrows = $statement->fetchAll();
        
         $sql = "select * from appointments where appointment_time=:time and appointment_date=:date and patient_id=:patient";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':time', $time);
        $statement->bindValue(':date', $date);
        $statement->bindValue(':patient', $patient);
        $statement->execute();
        $checkrows2 = $statement->fetchAll();
    
        if(count($checkrows) > 0) {
            $message = "This doctor already has an appointment at that time.";
           echo "<script type='text/javascript'>alert('$message');</script>";
        } else if (count($checkrows2) > 0) {
            $message = "This patient already has an appointment at that time.";
           echo "<script type='text/javascript'>alert('$message');</script>";
        }else{
        
        //insert results into database 
     $sql = "INSERT INTO appointments(appointment_time, appointment_date, patient_id, doctor_id)
    VALUES (:time, :date, :patient, :doctor)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":time", $time);  
        $statement->bindValue(":date", $date);
        $statement->bindValue(":patient", $patient);
        $statement->bindValue(":doctor", $doctor);
        $statement->execute();
             
      
    } 
    }

    ?>



<!DOCTYPE html>
<html>
    <head>
        <title>New Appointment | Doctor's office</title>  
         <script src="js/jquery-ui-1.11.4/jquery-ui.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui.js"></script>
		<link rel="stylesheet" href="js/jquery-ui-1.11.4/jquery-ui.css" />
        <script src="js/appointments.js"></script>
         <link rel="stylesheet" href="css/main.css"> 
        
    </head>
    <body>
            <div class="HeaderBar">
            <h1>Appointments page</h1>
    
        
        </div> 
        <?php
            include 'fragments/navigation.php';
        ?>
    
        <main>
           <div class="SomeInfo">
        <div class="Yeah">
    
            <div class="PImage"><img alt="PImage" src="images/medicine6.jpg"></div>
    
         
        </div>
    </div>
          
            <h3>Appointments</h3>
            <table class="appointment-table">
                <thead> 
                    <tr>
            <th id='heading-appointment-time'>Time</th>
            <th id='heading-appointment-date'>Date</th>
            <th id='heading-appointment-patient'>Patient name</th>
            <th id='heading-appointment-doctor'>Doctor name</th>
         
                    </tr>
                </thead>
                <tbody>
<?php
                    // Currency List here 
    $sql = "SELECT appointments.appointment_time, appointments.appointment_date, doctors.name as doctor_name, patients.name as patient_name FROM appointments INNER JOIN doctors ON appointments.doctor_id = doctors.id INNER JOIN patients on appointments.patient_id = patients.id;";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
    foreach ($results as $row) {
        $time = $row['appointment_time'];
        $date = $row['appointment_date'];
        $patient = $row['patient_name'];
        $doctor = $row['doctor_name'];
     
        echo "<tr>";
        echo "<td>$time</td>";
        echo "<td>$date</td>";
        echo "<td>$patient</td>";
        echo "<td>$doctor</td>";
      
        echo "</tr>";
}
    $results = null;
?>  
                </tbody>
</table>
  
    <?php $self = htmlspecialchars($_SERVER['PHP_SELF']); ?>
    <form name="new-appointment-form" method="post"
          action="<?php echo $self ?>">
       
        <div class="form-row">
           <label for="when">Date</label>
            <input type="text" name="when" id="when"/>
        </div>
         <div class="form-row">
             <label for="select">Time</label>
                        <select  name="appointment-time">
                            <option >-- Choose a time --</option>
                            <option >09:00-10:00</option>
                            <option >11:00-12:00</option>
                            <option >13:00-14:00</option>
                            <option >15:00-16:00</option>
                        </select>
        </div>
      
        <div class="form-row">
            <label>Patient's Name</label>
            <select name="appointment-patient">
            <option >-- Choose a patient --</option>
    <?php
    $sql = "SELECT * FROM patients";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
    foreach ($results as $patients) {
        ?>
                            <option value = "<?php echo $patients["id"]; ?>"><?php echo $patients["name"]; ?></option>
        <?php
    }
          ?>
    
                        </select>
        </div>
         <div class="form-row">
                <label for="select">Doctor's Name</label>
                        <select  name="appointment-doctor">
                            <option >-- Choose a doctor --</option>
    <?php
    $sql = "SELECT * FROM doctors";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
    foreach ($results as $doctors) {
        ?>
                            <option value = "<?php echo $doctors["id"]; ?>"><?php echo $doctors["name"]; ?></option>
        <?php
    }
          ?>
    
                        </select>
        </div>
      
        <input name="new-appointment-submit" type="submit" value="Book Appointment">
    </form>
            <div class="ImageBox">
            <img alt="medicine1" src="images/medicine6.jpg">
            </div>
                            <div class="PinkStrip"> 
   
       
    </div>
        </main>
    </body>
</html>
<?php
    require_once 'disconnect.php';
?>