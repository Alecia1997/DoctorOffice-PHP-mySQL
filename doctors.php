<?php
    require_once 'connect.php';
?>


  <?php
     $isPost = $_SERVER ['REQUEST_METHOD'] == 'POST';
    if ($isPost  && isset ($_POST['assign-room-submit'])){
    $room = $_POST["room-number"];
    $doctor = $_POST["doctor-name"];
  
  $sql = "UPDATE rooms
        SET doctor_id = '".$doctor."'
        WHERE number = '".$room."'";
        $statement = $pdo->prepare($sql);
        $statement->execute();  
        $results = $statement->fetchAll();
 foreach ($results as $row) {
       
        $room = $row['room-number'];
        $doctor = $row['doctor-name'];

             echo "<tr>";
       
        echo "<p> $room is assigned to doctor $doctor</p>";
      
       
           
       }
}

            
            
            
  ?>  












<!DOCTYPE html>
<html>
    <head>
        <title>Doctor Page | Doctor's office</title>
        <script src="js/jquery-ui-1.11.4/jquery-ui.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui.js"></script>
		<link rel="stylesheet" href="js/jquery-ui-1.11.4/jquery-ui.css" />
        <link rel="stylesheet" href="css/main.css">
        <script src="js/patients.js"></script>
    </head>
<body>
    
    
        <div class="HeaderBar">
            <h1>Doctor page</h1>
    
        
        </div> 
    <?php
    include 'fragments/navigation.php';
    ?>
    
    
  
  

        <main>
        <div class="SomeInfo">
        <div class="Yeah">
    
            <div class="PImage"><img alt="PImage" src="images/medicine5.jpg"></div>
    
         
        </div>
    </div>
          
             <h3>Information about our doctors</h3>
        
         <table class="doctor-table">
        <thead> 
            <tr> 
                <th id="image-heading"></th>
                <th id="name-heading">Name</th>
                <th id="specialisation-heading">Specialisation</th>
            </tr>
        </thead>
<tbody> 
          
 <?php
        $sql = "SELECT * FROM doctors;";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        foreach ($results as $row) {
            $id = $row['id'];
            $name = $row['name'];
            $specialisation = $row['specialisation'];
            $doctor_path = $row['photograph'];
            $doctor_id = $row['id'];
            
            echo "<tr>";
            echo "<td><a href='doctor_detail.php?doctor_id=$doctor_id'><img src='$doctor_path'></a></td>";
            echo "<td>$name</td>";
            echo "<td>$specialisation</td>";
            echo "</tr>";
} 
        $results = null;
  ?>

        </tbody>
    </table>
             
         
            
            <h3>Doctor's office consulting rooms</h3>
            
            <table class="room-table">
                <thead> <tr>
           
            <th id='heading-room-floor'>Floor</th>
            <th id='heading-room-number'>Number</th>
            <th id='heading-room-name'>Name</th>
            <th id='heading-room-doctor'>doctor assigned to this room</th>
          
        </tr>
    </thead>
<tbody>
<?php 
    // Currency List here 
    
    $sql = "SELECT doctors.name as doctor_name,rooms.floor,rooms.number,rooms.name FROM rooms
    INNER JOIN doctors ON rooms.doctor_id = doctors.id";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
    foreach ($results as $row) {
     
        $name = $row['name'];
        $floor = $row['floor'];
        $number = $row['number'];
        $doctor_name = $row['doctor_name'];
        echo "<tr>";
   
        echo "<td>$floor</td>";
        echo "<td>$number</td>";
        echo "<td>$name</td>";
        echo "<td>$doctor_name</td>";
     
        echo "</tr>";
}
    $results = null;
?> 
                </tbody>
</table>
                 
          <div id="groups">
                <h3>Assign rooms to doctors</h3>
         <div class="group">  
        
    <?php $self = htmlspecialchars($_SERVER['PHP_SELF']); ?>
    <form name="assign-room-form" method="post"
          action="<?php echo $self ?>">
        <div class="form-row">
            
            <label for="select">Select room by number</label>
                        <select  name="room-number">
                            <option >-- Choose a room -</option>
                            <option>101</option>
                             <option>102</option>
                             <option>103</option>
                             <option>104</option>
                             <option>105</option>
                             <option>106</option>
                             <option>201</option>
                             <option>202</option>
                             <option>203</option>
                             <option>204</option>
                             <option>205</option>
                             <option>206</option>
            </select>              
        </div>
       
 <div class="form-row">
                 <label for="select">Assign to doctor</label>
                        <select  name="doctor-name">
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

 
        <input name="assign-room-submit" type="submit" value="update">
    </form>
            
       
            
            </div>
                  </div>  

    
    
            <div class="someSpace"></div>
            
 
    </main>

  
    
</body>
</html>
<?php
    require_once 'disconnect.php';
?>