<?php
$this->breadcrumbs=array(
	Users::label(2)=>array('index'),
	Yii::t('Users','Create'),
);

if(Yii::app()->language == 'en'){
    $index_label = Yii::t('Users','Manage').' '.Users::label(2);
}else{
    $index_label = Users::label(2).' '.Yii::t('Users','Manage');
}

$this->menu=array(
	array('label'=>$index_label,'url'=>array('index')),
);

?>

<?php foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">'.
                Yii::app()->clientScript->registerScript('myHideEffect',
                '$(".flash-'.$key.'").animate({opacity: 1.0}, 3000).fadeOut("slow");',
                CClientScript::POS_READY);
            "</div>
";
    }
?>
<h1>
    <?php
        if(Yii::app()->language == 'en'){
            $header_label = Yii::t('Users','Create').' '.Users::label();
        }else{
            $header_label = Users::label().' '.Yii::t('Users','Create');
        }
        echo $header_label; ?>
</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>