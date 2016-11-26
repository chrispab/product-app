<?php
/**
 * Product class represents product
 */
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

/**
 *
 */
    public function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     *
     */
    public function getPostParams() {
        $this->id = isset($_POST['id']) ? trim($_POST['id']) : null;
        //$this->id = $this->clean_input($_POST['id']);// ? trim($_POST['id']) : null;
        $this->part_number = $this->clean_input($_POST['part_number']);// ? trim($_POST['part_number']) : null;
        $this->description = $this->clean_input($_POST['description']); //  ? trim($_POST['description'])  : null;
        $this->image = isset($_FILES["imagefile"]["name"]) ? trim($_FILES["imagefile"]["name"]) : null;
        $this->stock_quantity = $this->clean_input($_POST['stock_quantity']); //  ? trim($_POST['stock_quantity'])  : null;
        $this->cost_price = $this->clean_input($_POST['cost_price']); //  ? trim($_POST['cost_price'])  : null;
        $this->selling_price = $this->clean_input($_POST['selling_price']); //  ? trim($_POST['selling_price'])  : null;
        $this->vat_rate = $this->clean_input($_POST['vat_rate']); //  ? trim($_POST['vat_rate'])  : null;
    }

    /**
     *
     */
    public function validateProductParams() {
        //clear error array
        $errors = array("part_number_err"=>"",
		 				"description_err"=>"",
						"image_err"=>"",
						"stock_quantity_err"=>"",
						"image_err"=>"",
                        "cost_price_err"=>"",
                        "selling_price_err"=>"",
						"vat_rate_err"=>"",
						"errs_count"=>"");
        $errs = 0;      //init err counter

		if ( empty($this->part_number) ) {
		    $errors['part_number_err'] = 'Part Number is required';
		}

		if ( strlen($this->description)==0 ) {
		    $errors['description_err'] = 'Description is required';
            $errs++;
		}
        if ( !$this->validateImageToStore($this->image, $errors) ) {
            //$errors['image_err'] = 'image error';
            $errs++;
        }
		if ( empty($this->stock_quantity) ) {
		    $errors['stock_quantity_err'] = 'Stock Level is required';
            $errs++;
		}
        if ( !is_numeric($this->stock_quantity) ) {
            $errors['stock_quantity_err'] = 'Stock Level must be anumber';
            $errs++;
        }
		if ( empty($this->cost_price) ) {
		    $errors['cost_price_err'] = 'Cost Price is required';
            $errs++;
		}
        if ( !is_numeric($this->cost_price) ) {
		    $errors['cost_price_err'] = 'Cost Price must be a price';
            $errs++;
		}
		if ( empty($this->selling_price) ) {
		    $errors['selling_price_err'] = 'Selling Price is required';
            $errs++;
		}
        if ( !is_numeric($this->selling_price) ) {
		    $errors['selling_price_err'] = 'Selling Price must be a number';
            $errs++;
		}
		if ( empty($this->vat_rate) ) {
		    $errors['vat_rate_err'] = 'VAT Rate is required';
            $errs++;
		}
        if ( !is_numeric($this->vat_rate) ) {
		    $errors['vat_rate_err'] = 'VAT Rate must be a number';
            $errs++;
		}
        $errors['errs_count'] = $errs;
		return ($errors);
	}
    /**
     *
     */
    	private function validateImageToStore($imagefile, &$errors){
    		$uploadOk = 1;//start as ok
            $target_dir = "product_images/";

            //check for filename exists
            if (empty($imagefile)) {
                $errors['image_err'] = "no filname provided";
                var_dump($errors);
    	        $uploadOk = 0;
                return $uploadOk;
            }

            $target_file = $target_dir . basename($_FILES["imagefile"]["name"]);
    		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            $check = getimagesize($_FILES["imagefile"]["tmp_name"]);
    	    if($check !== false) {
    	        //echo "File is an image - " . $check["mime"] . ".";
    	        $uploadOk = 1;
    	    } else {
    	        $errors['image_err'] = "File is not an image.";
    	        $uploadOk = 0;
    	    }
    		// Check if file already exists
    		if (file_exists($target_file)) {
    		    $errors['image_err'] = "Sorry, file already exists.";
    		    $uploadOk = 0;
    		}
    		// Check file size
    		if ($_FILES["imagefile"]["size"] > 500000) {
    		    $errors['image_err'] = "Sorry, your file is too large.";
    		    $uploadOk = 0;
    		}
    		// Allow only specific file formats
    		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    		&& $imageFileType != "gif" ) {
    		    $errors['image_err'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    		    $uploadOk = 0;
    		}
    		return $uploadOk;
    	}
}
