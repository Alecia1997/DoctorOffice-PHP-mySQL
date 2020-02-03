<div class="form-row">
    <?php
        
        $value = "";
        if (isset($_POST[$field])) {
            $value = $_POST[$field];
        }
    
        echo "<label>$descriptions[$field]</label>";
        echo "<input name='$field' type='text' value='$value'>";
        if (isset($errors[$field])) {
            echo "<label class='ui-state-error'>";
            echo " <span class='ui-icon ui-icon-alert'></span>";
            echo " $errors[$field]";
            echo "</label>";
        }
    ?>
</div>