<?php
//require_once (__DIR__. "/model/Model.php");
require_once (__DIR__. "/model/ProductsModel.php");
require_once (__DIR__. "/view/ListView.php");
require_once (__DIR__. "/controller/ListController.php");

class Router {
    /**
	 * Handles requests and routes to correct view and passes controller and model.
	 *
	 * @param No params
	 *
	 * @return void
	 */
	public function handleRequest() {

        //$page = $_GET['page'];
        $op = isset($_GET['op']) ? $_GET['op'] : null;

        //if (!empty($_GET['page'])) {
            //mvc array defining each for each op
        $data = array(
            'create' => array('model' => 'ProductsModel',
                           'view' => 'CreateView',
                           'controller' => 'CreateController'),
            'show' => array('model' => 'ProductsModel',
                          'view' => 'ShowView',
                          'controller' => 'ShowController'),
            'edit' => array('model' => 'ProductsModel',
                            'view' => 'EditView',
                            'controller' => 'EditController'),
            'delete' => array('model' => 'ProductsModel',
                            'view' => 'DeleteView',
                            'controller' => 'ViewController'),
            'list' => array('model' => 'ProductsModel',
                            'view' => 'ListView',
                            'controller' => 'ListController')
        );
        //get mvc for a given op
        foreach($data as $key => $components){
            if ($op == $key) {
                $model = $components['model'];
                var_dump($model);
                $view = $components['view'];
                var_dump($view);
                $controller = $components['controller'];
                var_dump($controller);
                break;
            }
        }
        //if set create the mvc
        if (isset($model)) {
            $m = new $model();
            var_dump( $m);

            $c = new $controller($m);
            $v = new $view($m);
            //$view = new View($controller, $model);

            //do any controller actions here
            if (isset($_GET['action']) && !empty($_GET['action'])) {
                $c->{$_GET['action']}();
            }
            //render the view
            echo $v->output();
        }
        else {
            echo "no args";
        }
    }
}
