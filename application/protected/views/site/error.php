<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . Yii::t('site', ' - Error');
$this->breadcrumbs=array(
    Yii::t('site', 'Error'),
);
?>

<h2><?php echo Yii::t('site', 'Error ')?><?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>