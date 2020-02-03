<?php
    require_once 'connect.php';
?>

<?php
  
// Global declarations go here
$self = htmlspecialchars($_SERVER['PHP_SELF']);
$errors = array();
$fields = array('patient-name', 'patient-medical-aid-number', 'patient-number');
$descriptions = array(
'patient-name' => "Name",  'patient-medical-aid-number' => "medical-aid-number",  'patient-number' => "phone-number" 
);




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function validate_populated($field) {
        global $errors, $descriptions;
        if (empty($_POST[$field])) {
            $errors[$field] = "$descriptions[$field] is required.";
        }
    }
    function validate_length($field, $length) {
        global $errors, $descriptions;
        if (empty($errors[$field]) && mb_strlen($_POST[$field]) != $length) {
            $errors[$field] = "The phone number $descriptions[$field] must be exactly $length
    characters.";
        } 
    }
    
    
    
     // Handle form submission
    //(Refreshes the page with new info
     if (isset ($_POST['new-patient-submit'])){
             
       // Validation happens here
        foreach ($fields as $field) {
            validate_populated($field);
        }
      
        validate_length('patient-number', 10); 
         
       $name = $_POST['patient-name'];
       $medical = $_POST['patient-medical-aid-number']; 
       $number = $_POST['patient-number'];
         
         if (count($errors) == 0) {
              $sql = "INSERT INTO patients(name, medical_aid_number, phone_number)
            VALUES (:name, :medical, :number)";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(":name", $name);  
                $statement->bindValue(":medical", $medical);
                $statement->bindValue(":number", $number);
                $statement->execute();
             }
    } else if ((isset ($_POST['delete-patient-submit']))) {
        $id = intval($_POST ['patient-id']);   
        $sql = "DELETE FROM patients WHERE id=:id;";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();    
    }
    
}
 
 ?> 


<!DOCTYPE html>
<html>
    <head>
        <title>Patient Page | Doctor's office</title>
        <script src="js/jquery-ui-1.11.4/jquery-ui.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui.js"></script>
		<link rel="stylesheet" href="js/jquery-ui-1.11.4/jquery-ui.css" />
        <link rel="stylesheet" href="css/main.css">
        <script src="js/patients.js"></script>
    <?php
        include 'fragments/style.php';
    ?>
    </head>
<body>
 
        <div class="HeaderBar">
            <h1>Patient page</h1>
    
        
        </div> 
    <?php
    include 'fragments/navigation.php';
    ?>
 

 
  
        
        <main>
    <div class="SomeInfo">
        <div class="Yeah">
    
            <div class="PImage"><img alt="PImage" src="images/PImage.jpg"></div>
    
        
        </div>
    </div>
                  
 
        
             <h3>Patients table</h3>
       
        <table class="patient-table">
            <thead> 
                <tr> 
                    
                    <th id='heading-patient-name'>Patient's Name</th>
                    <th id=‘heading-patient-medical’>Medical-aid-number</th>
                    <th id='heading-patient-number'>Phone Number</th>
	                <th id='heading-patient-appointment'>Appointments</th>
                    <th id='heading-patient-delete'>Delete</th>
                </tr>
            </thead>
<tbody> 
<?php
    // Currency List here 
    $sql = "SELECT * FROM patients;";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
    foreach ($results as $row) {
       
        $name = $row['name'];
        $medical = $row['medical_aid_number'];
        $number = $row['phone_number'];
        $id = $row['id'];
        $patient_id = $row['id'];
       
        echo "<tr>";
       
        echo "<td>$name</td>";
        echo "<td>$medical</td>";
        echo "<td>$number</td>";
        echo "<td><a href ='patient_detail.php?patient_id=$patient_id'>See appointments</td>";
        echo "<td>";
        include "fragments/delete.php";
        echo "</td>";
        echo "</tr>";
} 
    $results = null;

?> 
</tbody> 
</table>
       
       
        
           
          
  
    
        <h2>Add New Patient</h2>
        
    <?php $self = htmlspecialchars($_SERVER['PHP_SELF']); ?>
    <form name="new-patient-form" method="post"
          action="<?php echo $self ?>">
<?php
        foreach ($fields as $field) {
            include 'fragments/form_row.php';
} 
        ?>
        <input name="new-patient-submit" type="submit" value="Add">
    </form>
       
     
        
                <h2>Find a Patient</h2>
       
            <form method ="post" action="patients.php">
            Find Patient by medical-aid-number: <input type = "text" name="medical_aid_number"><br>
            <input type ="submit" name="search-submit" value="Search"></form>
            
  <?php
        if (isset ($_POST['search-submit'])) {
    $input = $_POST["medical_aid_number"];
  
  $sql = "SELECT patients.name as patient_name, patients.medical_aid_number, patients.phone_number FROM patients WHERE medical_aid_number = '".$input."'";
        $statement = $pdo->prepare($sql);
        $statement->execute();  
        $results = $statement->fetchAll();
       foreach ($results as $row) {
       
        $name = $row['patient_name'];
        $number = $row['phone_number'];

             echo "<tr>";
       
        echo "<p> The patient you are looking for is $name</p>";
        echo "<p> Here is the patient's contact details for your convenience $number</p>";
       
           
       }
}
     
  ?>             
    
        </main> 


  
    
</body>
</html>
<?php
    require_once 'disconnect.php';
?>