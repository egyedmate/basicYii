<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	$this->modelClass::label(2)=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

if(Yii::app()->language == 'en'){
    $index_label = Yii::t('<?php echo $this->modelClass ?>','Manage').' '.<?php echo $this->modelClass ?>::label(2);
    $create_label = Yii::t('<?php echo $this->modelClass ?>','Create').' '.<?php echo $this->modelClass ?>::label(2);
    $update_label = Yii::t('<?php echo $this->modelClass ?>','Update').' '.<?php echo $this->modelClass ?>::label(2);
    $delete_label = Yii::t('<?php echo $this->modelClass ?>','Delete').' '.<?php echo $this->modelClass ?>::label(2);
}else{
    $index_label = <?php echo $this->modelClass ?>::label(2).' '.Yii::t('<?php echo $this->modelClass ?>','Manage');
    $create_label = <?php echo $this->modelClass ?>::label(2).' '.Yii::t('<?php echo $this->modelClass ?>','Create');
    $update_label = <?php echo $this->modelClass ?>::label(2).' '.Yii::t('<?php echo $this->modelClass ?>','Update');
    $delete_label = <?php echo $this->modelClass ?>::label(2).' '.Yii::t('<?php echo $this->modelClass ?>','Delete');
}

$this->menu=array(
	array('label'=>$index_label,'url'=>array('index')),
	array('label'=>$create_label,'url'=>array('create')),
	array('label'=>$update_label,'url'=>array('update','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>$delete_label,'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Are you sure you want to delete this item?')),
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

<h1>View <?php echo $this->modelClass." #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<h1>
    <?php echo "<?php\n"; ?>
        if(Yii::app()->language == 'en'){
            $header_label = Yii::t('<?php echo $this->modelClass ?>','View').' '.<?php echo $this->modelClass ?>::label(). ' #' . <?php echo "\$model->{$this->tableSchema->primaryKey}"; ?>;
        }else{
            $header_label = <?php echo "\$model->{$this->tableSchema->primaryKey}"; ?>.'. '.<?php echo $this->modelClass ?>::label().' '.Yii::t('<?php echo $this->modelClass ?>','View');
        }
        <?php echo 'echo $header_label;';?> ?>
</h1>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
<?php

foreach($this->tableSchema->columns as $column)
    
    if(!empty($column->isForeignKey)){
	echo "\t\tarray(\n"
                . "'name' => '".$column->name."',\n"
                . "'value' => (\$model->$column->name===null?null:\$model->$column->name),\n"
                . "),\n";
    }
    elseif($column->dbType == "smallint"){
	echo "\t\tarray(\n"
                . "'name' => '".$column->name."',\n"
                . "'value' => (\$model->$column->name===0?Yii::t('$this->modelClass', '0'):Yii::t('$this->modelClass', '1')),\n"
                . "),\n";
    }else{
	echo "\t\t'".$column->name."',\n";
    }
?>
	),
)); ?>
