<div class="checkboxflat">
<!--    <input type="checkbox" value="1" id="checkboxFiveInput" name="" />-->
    <?php echo CHtml::activeCheckBox($model, $attribute, $htmlOptions)?>
    <label for="<?php echo $htmlOptions["id"];?>"></label>
</div>