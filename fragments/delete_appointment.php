<?php $self = htmlspecialchars($_SERVER['PHP_SELF']); ?>
<form name = "delete-appointment-form" method ="post" action="<?php echo $self ?>">
    <input type="hidden" name="appointment-id" value="<?php echo $id ?>">
   <input type = "submit" name="delete-appointment-submit" value="Delete">
</form>