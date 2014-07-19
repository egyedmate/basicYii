<?php
$this->breadcrumbs=array(
	Users::label(2)=>array('index'),
	$model->id,
);

if(Yii::app()->language == 'en'){
    $index_label = Yii::t('Users','Manage').' '.Users::label(2);
    $create_label = Yii::t('Users','Create').' '.Users::label(2);
    $update_label = Yii::t('Users','Update').' '.Users::label(2);
    $delete_label = Yii::t('Users','Delete').' '.Users::label(2);
}else{
    $index_label = Users::label(2).' '.Yii::t('Users','Manage');
    $create_label = Users::label(2).' '.Yii::t('Users','Create');
    $update_label = Users::label(2).' '.Yii::t('Users','Update');
    $delete_label = Users::label(2).' '.Yii::t('Users','Delete');
}

$this->menu=array(
	array('label'=>$index_label,'url'=>array('index')),
	array('label'=>$create_label,'url'=>array('create')),
	array('label'=>$update_label,'url'=>array('update','id'=>$model->id)),
	array('label'=>$delete_label,'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
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
<h1>View Users #<?php echo $model->id; ?></h1>

<h1>
    <?php
        if(Yii::app()->language == 'en'){
            $header_label = Yii::t('Users','View').' '.Users::label(). ' #' . $model->id;
        }else{
            $header_label = $model->id.'. '.Users::label().' '.Yii::t('Users','View');
        }
        echo $header_label; ?>
</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ent_name',
		'email',
		'login_name',
		array(
'name' => 'type_id',
'value' => ($model->type_id===null?null:$model->type_id),
),
		'password',
		array(
'name' => 'enabled',
'value' => ($model->enabled===0?Yii::t('Users', '0'):Yii::t('Users', '1')),
),
	),
)); ?>
