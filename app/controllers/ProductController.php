<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController
{
	private $db;

	public function __construct()
	{
		if (!isset($_SESSION["user"])) {
			$_SESSION['flash_message'] = [
				'type' => 'danger',
				'message' => 'You are not authorized!'
			];
			header('Location: /ace_practical/public/login');
			exit;
		}
		$database = new Database();
		$this->db = $database->connect();
	}

	public function create()
	{
		$category = new Category($this->db);
		$result = $category->read();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			try {
				$product = new Product($this->db);
				$product->name = $_POST['name'];
				$product->category_id = $_POST['category_id'];
				$product->price = $_POST['price'];

				if ($product->create()) {
					$_SESSION['flash_message'] = [
						'type' => 'success',
						'message' => 'Product created successfully!'
					];
				} else {
					$_SESSION['flash_message'] = [
						'type' => 'danger',
						'message' => 'Failed to create product.'
					];
				}
			} catch (Exception $e) {
				$_SESSION['flash_message'] = [
					'type' => 'danger',
					'message' => 'Something went wrong here!'
				];
			}
			header('Location: /ace_practical/public/list-products');
			exit;
		}

		include __DIR__ . '/../views/create_product.php';
	}
	public function edit($id)
	{
		$category = new Category($this->db);
		$result = $category->read();

		$product = new Product($this->db);
		$productData = $product->getProductById($id);
		if ($productData) {
			include __DIR__ . '/../views/edit_product.php';
		} else {
			$_SESSION['flash_message'] = [
				'type' => 'danger',
				'message' => 'Product not found.'
			];
			header('Location: /ace_practical/public/list-products');
			exit;
		}
	}

	public function update($data)
	{
		try {
			$product = new Product($this->db);
			if ($product->updateProductById($data['id'], $data['name'], $data['price'], $data['category_id'])) {
				$_SESSION['flash_message'] = [
					'type' => 'success',
					'message' => 'Product updated successfully!'
				];
			} else {
				$_SESSION['flash_message'] = [
					'type' => 'success',
					'message' => 'Failed to update the product.'
				];
			}
		} catch (Exception $e) {
			$_SESSION['flash_message'] = [
				'type' => 'danger',
				'message' => 'Something went wrong here!'
			];
		}
		header("Location: /ace_practical/public/list-products");
		exit;
	}
	public function delete($id)
	{
		try {
			$product = new Product($this->db);
			if ($product->deleteProductById($id)) {
				$_SESSION['flash_message'] = [
					'type' => 'success',
					'message' => 'Product deleted successfully!'
				];
			} else {
				$_SESSION['flash_message'] = [
					'type' => 'danger',
					'message' => 'Failed to delete the product'
				];
			}
		} catch (Exception $e) {
			$_SESSION['flash_message'] = [
				'type' => 'danger',
				'message' => 'Something went wrong here!'
			];
		}
		header('Location: /ace_practical/public/list-products');
		exit;
	}

	public function list()
	{
		$product = new Product($this->db);
		$result = $product->read();

		include __DIR__ . '/../views/list_products.php';
	}
}
