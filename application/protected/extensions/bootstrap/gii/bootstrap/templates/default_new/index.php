<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	Yii::t('$this->modelClass','Index'),
);\n";
?>

if(Yii::app()->language == 'en'){
    $create_label = Yii::t('<?php echo $this->modelClass ?>','Create').' '.<?php echo $this->modelClass ?>::label();
}else{
    $create_label = <?php echo $this->modelClass ?>::label().' '.Yii::t('<?php echo $this->modelClass ?>','Create');
}

$this->menu=array(
	array('label'=>$create_label,'url'=>array('create')),
);
?>

<?php
    echo 
"<?php foreach(Yii::app()->user->getFlashes() as \$key => \$message) {
        echo '<div class=\"flash-' . \$key . '\">'.
                Yii::app()->clientScript->registerScript('myHideEffect',
                '$(\".flash-'.\$key.'\").animate({opacity: 1.0}, 3000).fadeOut(\"slow\");',
                CClientScript::POS_READY);
            \"</div>\n\";
    }
?>";
?>

<h1>
    <?php echo "<?php\n"; ?>
        if(Yii::app()->language == 'en'){
            $header_label = Yii::t('<?php echo $this->modelClass ?>','Manage').' '.<?php echo $this->modelClass ?>::label(2);
        }else{
            $header_label = <?php echo $this->modelClass ?>::label(2).' '.Yii::t('<?php echo $this->modelClass ?>','Manage');
        }
        <?php echo 'echo $header_label;';?> ?>
</h1>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
        if(!empty($column->isForeignKey))
            echo "\t\tarray(\n'name' => '".$column->name."',\n"
                . "//'value' => '\$data->$column->name===null?null:\$data->$column->name',\n"
                . "//'visible' => Yii::app->user->isAdmin,\n"
                . "\n),\n";
        
	echo "\t\tarray(\n'name' =>'".$column->name."',\n"
                . "//'visible' => Yii::app->user->isAdmin,\n"
                . "),\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>