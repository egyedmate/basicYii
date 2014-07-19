<?php
/* @var $this UsersController */
/* @var $model Users */
?>
<?php
$this->breadcrumbs=array(
	Yii::t('Users','Index'),
);

if(Yii::app()->language == 'en'){
    $create_label = Yii::t('Users','Create').' '.Users::label();
}else{
    $create_label = Users::label().' '.Yii::t('Users','Create');
}

$this->menu=array(
	array('label'=>$create_label,'url'=>array('create')),
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
            $header_label = Yii::t('Users','Manage').' '.Users::label(2);
        }else{
            $header_label = Users::label(2).' '.Yii::t('Users','Manage');
        }
        echo $header_label; ?>
</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
'name' =>'id',
//'visible' => Yii::app->user->isAdmin,
),
		array(
'name' =>'ent_name',
//'visible' => Yii::app->user->isAdmin,
),
		array(
'name' =>'email',
//'visible' => Yii::app->user->isAdmin,
),
		array(
'name' =>'login_name',
//'visible' => Yii::app->user->isAdmin,
),
		array(
'name' => 'type_id',
//'value' => '$data->type_id===null?null:$data->type_id',
//'visible' => Yii::app->user->isAdmin,

),
		array(
'name' =>'type_id',
//'visible' => Yii::app->user->isAdmin,
),
		array(
'name' =>'password',
//'visible' => Yii::app->user->isAdmin,
),
		/*
		array(
'name' =>'enabled',
//'visible' => Yii::app->user->isAdmin,
),
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>