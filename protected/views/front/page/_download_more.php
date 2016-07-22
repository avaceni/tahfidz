<?php
$ip = $number + 1;
foreach ($model_download as $download) {
    $path_info = pathinfo($download->url);
    $file_extension = $path_info['extension'];
    $file_icon = $file_extension == 'mp3' ? 'audio' : 'file';
    ?>
    <tr>
        <td><?php echo $ip ?></td>
        <td><span class="<?php echo $file_icon ?>" title=""></span></td>
        <td><a href="<?php echo Yii::app()->baseUrl . $download->url ?>" class="title"><?php echo $download->title ?></a></td>
        <td><a href="" class="author"><?php echo $download->author ?></a></td>
        <td><?php echo Utility::getDateFormat2($download->created_time) ?></td>
        <td><?php echo Utility::getHumanReadableFilesize(filesize($_SERVER["DOCUMENT_ROOT"] . Yii::app()->baseUrl . $download->url)) ?></td>
        <td><a href="<?php echo Yii::app()->baseUrl . $download->url ?>" class="download"></a></td>
    </tr>
    <?php
    $ip++;
}
?>
