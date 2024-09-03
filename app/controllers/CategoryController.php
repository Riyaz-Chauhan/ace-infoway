<?php
require_once __DIR__ . '/../models/Category.php';

class CategoryController
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
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			try {
				$category = new Category($this->db);
				$category->name = $_POST['name'];
				if ($category->create()) {
					$_SESSION['flash_message'] = [
						'type' => 'success',
						'message' => 'Category created successfully!'
					];
				} else {
					$_SESSION['flash_message'] = [
						'type' => 'danger',
						'message' => 'Failed to create category.'
					];
				}
			} catch (Exception $e) {
				$_SESSION['flash_message'] = [
					'type' => 'danger',
					'message' => 'Something went wrong here!'
				];
			}
			header('Location: /ace_practical/public/list-categories');
			exit;
		}

		include __DIR__ . '/../views/create_category.php';
	}
	public function edit($id)
	{
		$category = new Category($this->db);
		$categoryData = $category->getCategoryById($id);

		if ($categoryData) {
			include __DIR__ . '/../views/edit_category.php';
		} else {
			$_SESSION['flash_message'] = [
				'type' => 'danger',
				'message' => 'Category not found.'
			];
			header('Location: /ace_practical/public/list-categories');
			exit;
		}
	}

	public function update($data)
	{
		try {
			$category = new Category($this->db);
			if ($category->updateCategoryById($data['id'], $data['name'])) {
				$_SESSION['flash_message'] = [
					'type' => 'success',
					'message' => 'Category updated successfully!'
				];
			} else {
				$_SESSION['flash_message'] = [
					'type' => 'success',
					'message' => 'Failed to update the category.'
				];
			}
		} catch (Exception $e) {
			$_SESSION['flash_message'] = [
				'type' => 'danger',
				'message' => 'Something went wrong here!'
			];
		}
		header("Location: /ace_practical/public/list-categories");
		exit;
	}

	public function list()
	{
		$category = new Category($this->db);
		$result = $category->read();

		include __DIR__ . '/../views/list_categories.php';
	}
}
