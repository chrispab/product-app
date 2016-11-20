<?php
class Product {
    public $id = NULL;
    public $part_number 	= NULL;
    public $description  = NULL;
    public $image = NULL;
    public $stock_quantity = NULL;
    public $cost_price = NULL;
    public $selling_price = NULL;
    public $vat_rate = NULL;

	public function __construct() {
	}

	public function getPostParams() {
        $this->id = isset($_POST['id']) ? trim($_POST['id']) : null;
        $this->part_number = isset($_POST['part_number']) ? trim($_POST['part_number']) : null;
        $this->description = isset($_POST['description'])  ? trim($_POST['description'])  : null;
        $this->image = isset($_FILES["imagefile"]["name"]) ? trim($_FILES["imagefile"]["name"]) : null;
        $this->stock_quantity = isset($_POST['stock_quantity'])  ? trim($_POST['stock_quantity'])  : null;
        $this->cost_price = isset($_POST['cost_price'])  ? trim($_POST['cost_price'])  : null;
        $this->selling_price = isset($_POST['selling_price'])  ? trim($_POST['selling_price'])  : null;
        $this->vat_rate = isset($_POST['vat_rate'])  ? trim($_POST['vat_rate'])  : null;
	}

    public function validateProductParams() {
		echo "<br> ********   validating prod params in product";
		$errors = array();

		if ( !isset($this->part_number) || empty($this->part_number) ) {
		    $errors[] = 'Part Number is required';
		}
		if ( !isset($this->description) || empty($this->description) ) {
		    $errors[] = 'Description is required';
		}
		if ( !isset($this->stock_quantity) || empty($this->stock_quantity) ) {
		    $errors[] = 'Stock Level is required';
		}
		if ( !isset($this->cost_price) || empty($this->cost_price) ) {
		    $errors[] = 'Cost Price is required';
		}
		if ( !isset($this->selling_price) || empty($this->selling_price) ) {
		    $errors[] = 'Selling Price is required';
		}
		if ( !isset($this->vat_rate) || empty($this->vat_rate) ) {
		    $errors[] = 'VAT Rate is required';
		}
		// if ( !isset($image) || empty($image) ) {
		//     $errors[] = 'An Image is required';
		// }

		return ($errors);
	}


}