<?php
/**
 * AuthFilter class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package auth.components
 */

/**
 * Filter that automatically checks if the user has access to the current controller action.
 */
class AuthFilter extends CFilter
{
    /**
     * @var array name-value pairs that would be passed to business rules associated
     * with the tasks and roles assigned to the user.
     */
    public $params = array();

    /**
     * Performs the pre-action filtering.
     * @param CFilterChain $filterChain the filter chain that the filter is on.
     * @return boolean whether the filtering process should continue and the action should be executed.
     * @throws CHttpException if the user is denied access.
     */
    protected function preFilter($filterChain)
    {
        $itemName = '';
        $controller = $filterChain->controller;

        /* @var $user CWebUser */
        $user = Yii::app()->getUser();

       /* $curpage = Yii::app()->getController()->getAction()->controller->id;
        echo "action;".$curpage;*/
        if((yii::app()->user->id==Yii::app()->session['_id']) && (Yii::app()->user->name!='Guest')){        

            if (($module = $controller->getModule()) !== null) {
                $itemName .= $module->getId(). '/'.$controller->getId().'/'.$controller->action->getId();

                if ($user->checkAccess($itemName,$this->params)) {
                    return true;
                }
            }else{
            	
            	$url=yii::app()->request->url;
            	$url= explode('=',$url);
            	$itemName=strstr($url[1],'&',true);
            	if ($itemName==''){
            		$itemName=$url[1];
            	}
            	//echo $itemName; exit();
            	if ($user->checkAccess($itemName,$this->params)) {
            		return true;
            	}
            }

        }else{
           // throw new CHttpException(401, Yii::t('yii', 'No esta logueado.'));
           echo'<script>window.location="'.Yii::app()->homeUrl.'";</script>';
           return false;
        }

     /*   if ($user->isGuest) {
            $user->loginRequired();
        }*/
       //$this->render('site/error');
       // throw new CHttpException(400, Yii::t('AuthModule.main', 'Invalid request.'));
        throw new CHttpException(401, Yii::t('', 'No se encuentra autorizado para realizar esta acción.'));
    }
}
