<?php
require_once __DIR__ . '/../../config/database.php';

class Product
{
	private $conn;
	private $table = 'products';

	public $id;
	public $name;
	public $category_id;
	public $price;
	public $created_at;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function create()
	{
		$query = "INSERT INTO " . $this->table . " (name, category_id, price) VALUES (:name, :category_id, :price)";
		$stmt = $this->conn->prepare($query);

		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->category_id = htmlspecialchars(strip_tags($this->category_id));
		$this->price = htmlspecialchars(strip_tags($this->price));

		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':category_id', $this->category_id);
		$stmt->bindParam(':price', $this->price);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}
	public function getProductById($id)
	{
		$query = "SELECT * FROM products WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function updateProductById($id, $name, $price, $category_id)
	{
		$query = "UPDATE products SET name = :name, price = :price, category_id = :category_id WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':price', $price);
		$stmt->bindParam(':category_id', $category_id);
		return $stmt->execute();
	}
	public function deleteProductById($id)
	{
		$query = "DELETE FROM products WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":id", $id);
		return $stmt->execute();
	}
	public function read()
	{
		$query = "SELECT p.id, p.name, p.price, p.created_at, p.category_id, c.name as c_name FROM " . $this->table . " as p INNER JOIN categories as c ON c.id = p.category_id";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}
}
