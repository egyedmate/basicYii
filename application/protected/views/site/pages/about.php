<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
        Yii::t('site', 'About'),
);
?>
<h1><?php echo Yii::t('site', 'About');?></h1>
<?php 
echo '<pre>';
print_r($app = Yii::app()->controller->module ? Yii::app()->controller->module : Yii::app());
echo '</pre>'; 

?>
<p><?php echo Yii::t('site', 'This is a "static" page. You may change the content of this page
by updating the file');?> <code><?php echo __FILE__; ?></code>.</p>


