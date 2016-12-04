<?php
//require_once (__DIR__. "/model/Model.php");
require_once (__DIR__. "/model/ProductsModel.php");
require_once (__DIR__. "/view/View.php");
require_once (__DIR__. "/controller/Controller.php");

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

            if (!$op) {
                $this->defaultRoute();
            }
            elseif ($op == 'list') {
                $this->listProducts();
            }
            elseif ($op == 'new') {
                $this->createProduct();
            }
            elseif ($op == 'edit') {
                $this->updateProduct();
            }
            elseif ($op == 'delete') {
                $this->deleteProduct();
            }
            elseif ($op == 'show') {
                $this->showProduct();
            }
            else {
                $this->showError("Operation not supported", "Operation : " . $op . " - was not found");
            }

        //if (!empty($_GET['page'])) {
            //mvc array defining each for each op
            $data = array(
                'create' => array('model' => 'ProductModel',
                               'view' => 'CreateView',
                               'controller' => 'CreateController'),
                'show' => array('model' => 'ProductModel',
                              'view' => 'ShowView',
                              'controller' => 'ShowController'),
                'edit' => array('model' => 'ProductModel',
                                'view' => 'EditView',
                                'controller' => 'EditController'),
                'delete' => array('model' => 'ProductModel',
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
                    $view = $components['view'];
                    $controller = $components['controller'];
                    break;
                }
            }
            //if set create the mvc
            if (isset($model)) {
                $m = new $model();
                $c = new $controller($model);
                $v = new $view($model);
                //$view = new View($controller, $model);

                //do any controller actions here
                if (isset($_GET['action']) && !empty($_GET['action'])) {
                    $controller->{$_GET['action']}();
                }

                //render the view
                echo $view->output();
            }
        }
        else {
            echo "no args";
        }
    }
}
