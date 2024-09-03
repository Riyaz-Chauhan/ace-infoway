<?php
require_once __DIR__ . '/../../config/database.php';

class User
{
	private $conn;
	private $table = 'users';

	public $id;
	public $username;
	public $email;
	public $password;
	public $created_at;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function register()
	{
		$query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (:username, :email, :password)";
		$stmt = $this->conn->prepare($query);

		$this->username = htmlspecialchars(strip_tags($this->username));
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->password = htmlspecialchars(strip_tags($this->password));

		$stmt->bindParam(':username', $this->username);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':password', password_hash($this->password, PASSWORD_DEFAULT));

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	public function login()
	{
		$query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':email', $this->email);

		if ($stmt->execute()) {
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			if (password_verify($this->password, $user['password'])) {
				return ["status" => true, "user" => $user];
			}
		}

		return false;
	}

	public function checkEmailExists()
	{
		$query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':email', $this->email);
		$stmt->execute();

		return $stmt->rowCount() > 0;
	}

	public function resetPassword($newPassword)
	{
		$query = "UPDATE " . $this->table . " SET password = :password WHERE email = :email";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':password', password_hash($newPassword, PASSWORD_DEFAULT));
		$stmt->bindParam(':email', $this->email);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}
}
