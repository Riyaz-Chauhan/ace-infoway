<?php
require_once __DIR__ . '/../../config/database.php';

class Category
{
	private $conn;
	private $table = 'categories';

	public $id;
	public $name;
	public $created_at;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function create()
	{
		$query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
		$stmt = $this->conn->prepare($query);
		$this->name = htmlspecialchars(strip_tags($this->name));
		$stmt->bindParam(':name', $this->name);
		if ($stmt->execute()) {
			return true;
		}
		return false;
	}
	public function getCategoryById($id)
	{
		$query = "SELECT * FROM categories WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function updateCategoryById($id, $name)
	{
		$query = "UPDATE categories SET name = :name WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':name', $name);
		return $stmt->execute();
	}

	public function read()
	{
		$query = "SELECT * FROM " . $this->table;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}
