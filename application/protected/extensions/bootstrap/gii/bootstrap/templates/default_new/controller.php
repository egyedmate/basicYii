<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass . "\n"; ?>
{        
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
                        'rights', // perform access control for CRUD operations
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new <?php echo $this->modelClass; ?>;
                                
                //$model->setScenario('insert_<?php echo $this->modelClass; ?>');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
                        
                        $transaction = Yii::app()->db->beginTransaction();
			try{
                        
                        	if (!($model->save()))
					throw new CDbException(Yii::t('<?php echo $this->modelClass; ?>', '<?php echo "Can not save <i>$this->modelClass</i> data. Please contact an adminsitrator."; ?>'));
                                   
				//$model->setScenario('insert_<?php echo $this->modelClass; ?>');
				$transaction->commit();
				Yii::app()->user->setFlash('success',Yii::t('<?php echo $this->modelClass; ?>','<?php echo "<strong>Success!</strong>The data successfully inserted.";?>'));
                        	
                                if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
                                        $this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
					//$this->redirect(array('index', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>));
                        
                        }catch (CDbException $ex){
                        	$transaction->rollback();
                                //$model->setScenario('insert_<?php echo $this->modelClass; ?>');
				$model->setIsNewRecord(true);
				$model->addError('<?php echo $this->modelClass; ?>', $ex->getMessage());
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                //$model->setScenario('update_<?php echo $this->modelClass; ?>');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
                        
                        $transaction = Yii::app()->db->beginTransaction();
			try{
                        
                        	if (!($model->save()))
					throw new CDbException(Yii::t('<?php echo $this->modelClass; ?>', '<?php echo "Can not save <i>$this->modelClass</i> data. Please contact an adminsitrator."; ?>'));
                                   
				//$model->setScenario('update_<?php echo $this->modelClass; ?>');
				$transaction->commit();
				Yii::app()->user->setFlash('success',Yii::t('<?php echo $this->modelClass; ?>','<?php echo "<strong>Success!</strong>The data successfully updated.";?>'));
                        	
                                if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
                                        $this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
					//$this->redirect(array('index', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>));
                        
                        }catch (CDbException $ex){
                        	$transaction->rollback();
                                //$model->setScenario('update_<?php echo $this->modelClass; ?>');
				$model->setIsNewRecord(true);
				$model->addError('<?php echo $this->modelClass; ?>', $ex->getMessage());
                        }
		}                
                
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
                //if cannot delete record in db then uncomment the following code
                /*
                
                if (Yii::app()->getRequest()->getIsPostRequest()) {
			// we only allow deletion via POST request
			$model = $this->loadModel($id);
                        
			$model->setAttribute('attribute', Yii::app()->params['']);

			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				if (!($model->save()))
					throw new CDbException(Yii::t('<?php echo $this->modelClass; ?>', '<?php echo "Can not save <i>$this->modelClass</i> data. Please contact an adminsitrator."; ?>'));
				$transaction->commit();
				Yii::app()->user->setFlash('success',Yii::t('<?php echo $this->modelClass; ?>','<?php echo "<strong>Success!</strong>The data successfully deleted.";?>'));
				if (!Yii::app()->getRequest()->getIsAjaxRequest()){
					$this->redirect(array('index'));
				}
			}
			catch (CDbException $ex)
			{
				$transaction->rollback();
				$model->addError('app', $ex->getMessage());
			}
		} else
			throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
                
                */
                
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['<?php echo $this->modelClass; ?>'])) {
			$model->attributes=$_GET['<?php echo $this->modelClass; ?>'];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return <?php echo $this->modelClass; ?> the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,Yii::t('app','The requested page does not exist.'));
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param <?php echo $this->modelClass; ?> $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}