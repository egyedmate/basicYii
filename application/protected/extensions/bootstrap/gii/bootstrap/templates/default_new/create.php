<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
<?php echo "?>\n"; ?>

<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	$this->modelClass::label(2)=>array('index'),
	Yii::t('$this->modelClass','Create'),
);\n";
?>

if(Yii::app()->language == 'en'){
    $index_label = Yii::t('<?php echo $this->modelClass ?>','Manage').' '.<?php echo $this->modelClass ?>::label(2);
}else{
    $index_label = <?php echo $this->modelClass ?>::label(2).' '.Yii::t('<?php echo $this->modelClass ?>','Manage');
}

$this->menu=array(
	array('label'=>$index_label,'url'=>array('index')),
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
            $header_label = Yii::t('<?php echo $this->modelClass ?>','Create').' '.<?php echo $this->modelClass ?>::label();
        }else{
            $header_label = <?php echo $this->modelClass ?>::label().' '.Yii::t('<?php echo $this->modelClass ?>','Create');
        }
        <?php echo 'echo $header_label;';?> ?>
</h1>
<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>