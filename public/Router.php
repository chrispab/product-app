<?php
include_once "includes/includes.php";
/**
 *
 */
class Router {
    /**
	 * Handles requests and routes to correct view and passes controller and model.
	 *
	 * @param No params, but proccess the request from the client
	 *
	 * @return void
	 */
	public function handleRequest() {
        //if has GET vars in url - either new req or also has POST form data
        if ( $op = isset($_GET['op']) ) {
            $op = $_GET['op'];  // get operation if any
            //mvc array defining each for each op
            $data = array(
                'new' => array('model' => 'ProductsModel', 'view' => 'CreateView', 'controller' => 'CreateController'),
                'show' => array('model' => 'ProductsModel', 'view' => 'ShowView', 'controller' => 'ShowController'),
                'edit' => array('model' => 'ProductsModel', 'view' => 'EditView', 'controller' => 'EditController'),
                'delete' => array('model' => 'ProductsModel', 'view' => 'DeleteView', 'controller' => 'DeleteController'),
                'list' => array('model' => 'ProductsModel', 'view' => 'ListView', 'controller' => 'ListController')
            );
            //get mvc components for a given operation
            foreach($data as $key => $components){
                if ($op == $key) {
                    $model = $components['model'];
                    $view = $components['view'];
                    $controller = $components['controller'];
                }
            }
            //if model selected create the mvc
            if (isset($model)) {
                $m = new $model();
                $c = new $controller($m);
                $v = new $view($m,$c);

                //show view
                echo $v->output();
            }
            else {  //invalid operation supplied in url
                $this->showError("Operation not supported", "Operation : " . $op . " - was not found");
            }
        }
        else {  //no url parameters in GET supplied - just show home page
            require_once (__DIR__ . "/../view/tpl/home_tpl.php");
        }
    }

    /**
     * show error page when called
     *
     * @param string $title to display on err page.
     * @param string $message to display on error page
     *
     * @return void
     */
    public function showError($title, $message) {
        //echo __DIR__;
        require_once (__DIR__ . "/../view/tpl/error_tpl.php");
    }
}
