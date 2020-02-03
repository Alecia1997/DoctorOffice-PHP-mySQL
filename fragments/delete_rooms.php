<?php $self = htmlspecialchars($_SERVER['PHP_SELF']); ?>
<form name = "delete-room-form" method ="post" action="<?php echo $self ?>">
    <input type="hidden" name="rooms-id" value="<?php echo $id ?>">
   <input type = "submit" name="delete-room-submit" value="Delete">
</form>