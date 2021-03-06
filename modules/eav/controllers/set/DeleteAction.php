<?php
/**
 * DeleteAction class file
 * @author Igor Manturov, Jr. <igor.manturov.jr@gmail.com>
 * @link https://github.com/iAchilles/eavactiverecord/
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

/**
 * DeleteAction class
 *
 * @author Igor Manturov, Jr. <igor.manturov.jr@gmail.com>
 */
class DeleteAction extends CAction
{
    public function run($id)
    {
        $model = EavSetExtended::model()->findByPk($id);

        if (is_null($model))
        {
            throw new CHttpException(404);
        }

        try
        {
            if ($model->delete())
            {
                Yii::app()->getComponent('user')->setFlash('success', Yii::t('EavModule.eavactiverecord', 'The attribute set has been successfully deleted'));
            }
            else
            {
                Yii::app()->getComponent('user')->setFlash('error', Yii::t('EavModule.eavactiverecord', 'An error occurred while deleting the attribute set'));
            }
        }
        catch (CDbException $ex)
        {
            Yii::app()->getComponent('user')->setFlash('error', Yii::t('EavModule.eavactiverecord', 'The attribute set cannot be deleted because it is in use'));
        }

        $this->controller->redirect(array('set/index'));
    }
} 