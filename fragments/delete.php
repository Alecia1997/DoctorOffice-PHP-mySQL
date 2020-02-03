<?php $self = htmlspecialchars($_SERVER['PHP_SELF']); ?>
<form name = "delete-patient-form" method ="post" action="<?php echo $self ?>">
    <input type="hidden" name="patient-id" value="<?php echo $id ?>">
   <input type = "submit" name="delete-patient-submit" value="Delete">
</form>


