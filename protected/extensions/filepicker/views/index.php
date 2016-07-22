<div class="file-picker" style="border: 1px solid #eaeaea;font-family: sans-serif;padding: 3px;display: inline-block;width: 131px;">
    <img src="<?php echo $defaultImage; ?>" id="imgAvatar" alt="" style="display: block;height: 99px;max-width: 99px;margin: 0 auto;">
    <div style="position: relative;overflow: hidden;cursor: pointer;font-family: sans-serif;margin: 0;padding: 0;">
        <?php echo CHtml::activeFileField($model, $attribute, array("onchange" => "showPreview(this)", "style" => "display: block;position: absolute;top: 0;right: 0;bottom: 0;left: 0;filter: alpha(opacity=1);opacity: 0.01;-moz-opacity: 0.01;cursor: pointer;")); ?>
        <div class="button" style="color: #fff;text-align: center;background: #e5412d;padding: 4px 18px;display: block;font-weight: bold;cursor: pointer;margin-top: 3px;">Chose File</div>
    </div>
</div>