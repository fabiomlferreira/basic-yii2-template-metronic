<?php
namespace app\helpers;

class NavHelper
{
    /**
     * Load XML from string. Can throw exception
     * @param string $response String from a CURL response
     * @return SimpleXMLElement status_code, response
     */
    public static function isItemActive($url) {
        if (isset($url) && is_array($url) && isset($url[0])) {
            $this_route = null;
            $this_params = \Yii::$app->request->getQueryParams();
            
            if(\Yii::$app->controller !== null) {
                $this_route =  \Yii::$app->controller->getRoute();
            }
            $route = $url[0];
            if ($route[0] !== '/' && \Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== $this_route) {
                return false;
            }
            unset($url['#']);
            if (count($url) > 1) {
                foreach (array_splice($url, 1) as $name => $value) {
                    if ($value !== null && (!isset($this_params[$name]) || $this_params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }
    
    /**
     * Check if an action is active, receive an action or an array of actions
     * @param type $action
     * @return boolean
     */
    public static function isActionActive($action){
        if(is_array($action)){
            foreach($action as $temp){
                if(\Yii::$app->controller->action->id == $temp)
                    return true;
            }
            return false;
        }
        return \Yii::$app->controller->action->id == $action;
    }
    
     /**
     * Check if a controller is active, receive a controller or an array os controllers
     * @param type $action
     * @return boolean
     */
    public static function isControllerActive($controller){
        if(is_array($controller)){
            foreach($controller as $temp){
                if(\Yii::$app->controller->id == $temp)
                    return true;
            }
            return false;
        }
        return \Yii::$app->controller->id == $controller;
    }
    
    
}
?>