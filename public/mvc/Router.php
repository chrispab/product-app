<?php
//require_once (__DIR__. "/model/Model.php");
require_once (__DIR__. "/model/ProductsModel.php");
require_once (__DIR__. "/view/ListView.php");
require_once (__DIR__. "/view/ShowView.php");
require_once (__DIR__. "/view/EditView.php");
require_once (__DIR__. "/view/DeleteView.php");
require_once (__DIR__. "/view/CreateView.php");
require_once (__DIR__. "/controller/ListController.php");
require_once (__DIR__. "/controller/ShowController.php");
require_once (__DIR__. "/controller/EditController.php");
require_once (__DIR__. "/controller/DeleteController.php");
require_once (__DIR__. "/controller/CreateController.php");



class Router {
    /**
	 * Handles requests and routes to correct view and passes controller and model.
	 *
	 * @param No params
	 *
	 * @return void
	 */
	public function handleRequest() {
        $op = isset($_GET['op']) ? $_GET['op'] : null;
            //mvc array defining each for each op
        $data = array(
            'new' => array('model' => 'ProductsModel', 'view' => 'CreateView', 'controller' => 'CreateController'),
            'show' => array('model' => 'ProductsModel', 'view' => 'ShowView', 'controller' => 'ShowController'),
            'edit' => array('model' => 'ProductsModel', 'view' => 'EditView', 'controller' => 'EditController'),
            'delete' => array('model' => 'ProductsModel', 'view' => 'DeleteView', 'controller' => 'DeleteController'),
            'list' => array('model' => 'ProductsModel', 'view' => 'ListView', 'controller' => 'ListController')
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
            $c = new $controller($m);
            $v = new $view($m);
            //$view = new View($controller, $model);
            //render the view
            echo $v->output();

            //do any controller actions here
            //actions that mod the db are: create, edit, delete
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                var_dump($_GET['id']);
                $c->action( $_GET['id'] );
            }
        }
        else {
            echo "no args";
        }
    }
}
