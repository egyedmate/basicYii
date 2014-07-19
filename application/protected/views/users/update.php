<?php
/* @var $this UsersController */
/* @var $model Users */
?>

<?php
$this->breadcrumbs=array(
	Users::label(2)=>array('index'),
	$model->id=>array('view','id'=>$model->id),
        Yii::t('Users','Update'),
);

if(Yii::app()->language == 'en'){
    $index_label = Yii::t('Users','Manage').' '.Users::label(2);
    $create_label = Yii::t('Users','Create').' '.Users::label(2);
    $view_label = Yii::t('Users','View').' '.Users::label(2);
}else{
    $index_label = Users::label(2).' '.Yii::t('Users','Manage');
    $create_label = Users::label(2).' '.Yii::t('Users','Create');
    $view_label = Users::label(2).' '.Yii::t('Users','View');
}

$this->menu=array(
	array('label'=>$index_label,'url'=>array('index')),
	array('label'=>$create_label,'url'=>array('create')),
	array('label'=>$view_label,'url'=>array('view','id'=>$model->id)),
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
            $header_label = Yii::t('Users','Update').' '.Users::label(). ' #' . $model->id;
        }else{
            $header_label = $model->id.'. '.Users::label().' '.Yii::t('Users','Update');
        }
        echo $header_label; ?>
</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>