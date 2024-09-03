<?php
require_once __DIR__ . '/../models/User.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../PHPMailer/src/SMTP.php';

class UserController
{
	private $db;

	public function __construct()
	{
		$database = new Database();
		$this->db = $database->connect();
	}

	public function register()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			try {
				$user = new User($this->db);
				$user->username = $_POST['username'];
				$user->email = $_POST['email'];
				$user->password = $_POST['password'];

				if ($user->checkEmailExists()) {
					$_SESSION['flash_message'] = [
						'type' => 'danger',
						'message' => 'Email already exists'
					];
					header('Location: /ace_practical/public/register');
					exit;
				}
				if ($user->register()) {
					$this->sendRegistrationEmail($user->email);
					$_SESSION['flash_message'] = [
						'type' => 'success',
						'message' => 'Registration successful!'
					];
				} else {
					$_SESSION['flash_message'] = [
						'type' => 'danger',
						'message' => 'Registration failed!'
					];
				}
			} catch (Exception $e) {
				$_SESSION['flash_message'] = [
					'type' => 'danger',
					'message' => 'Something went wrong here!'
				];
			}
			header('Location: /ace_practical/public/register');
			exit;
		}

		include __DIR__ . '/../views/register.php';
	}

	public function login()
	{
		if (isset($_SESSION['user'])) {
			header('Location: /ace_practical/public/dashboard');
			exit;
		}
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			try {
				$user = new User($this->db);
				$user->email = $_POST['email'];
				$user->password = $_POST['password'];
				$getUser = $user->login();
				if ($getUser["status"]) {
					$_SESSION['username'] = $getUser["user"]["username"];
					$_SESSION['user'] = $getUser["user"]["email"];
					$_SESSION['flash_message'] = [
						'type' => 'success',
						'message' => 'Login successful!'
					];
					header('Location: /ace_practical/public/dashboard');
					exit;
				} else {
					$_SESSION['flash_message'] = [
						'type' => 'danger',
						'message' => 'Login failed!'
					];
				}
			} catch (Exception $e) {
				$_SESSION['flash_message'] = [
					'type' => 'danger',
					'message' => 'Something went wrong here!'
				];
			}
			header('Location: /ace_practical/public/login');
			exit;
		}
		include __DIR__ . '/../views/login.php';
	}

	public function logout()
	{
		if (isset($_SESSION['user'])) {
			session_unset();
			session_destroy();
			header('Location: /ace_practical/public/login');
		} else {
			header('Location: /ace_practical/public/list-categories');
		}
		exit;
	}

	public function dashboard()
	{
		include __DIR__ . '/../views/dashboard.php';
	}

	public function forgotPassword()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$user = new User($this->db);
			$user->email = $_POST['email'];
			if ($user->checkEmailExists()) {
				$newPassword = bin2hex(random_bytes(4));
				if ($user->resetPassword($newPassword)) {
					$this->sendResetPasswordEmail($user->email, $newPassword);
					$_SESSION['flash_message'] = [
						'type' => 'success',
						'message' => 'Password reset successful!'
					];
					header('Location: /ace_practical/public/login');
					exit;
				}
			} else {
				$_SESSION['flash_message'] = [
					'type' => 'danger',
					'message' => 'Email does not exist!'
				];
				header('Location: /ace_practical/public/forgot-password');
				die;
			}
		}
		include __DIR__ . '/../views/forgot_password.php';
	}

	private function sendRegistrationEmail($email)
	{
		$mail = new PHPMailer(true);
		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Username = 'riyaz.eww@gmail.com';
		$mail->Password = 'cwktahnatxtizirs';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = '465';

		$mail->From = 'admin.test@yopmail.com';
		$mail->FromName = 'Mailer';
		$mail->addAddress($email, 'Rahul');

		$mail->WordWrap = 50;
		$mail->isHTML(true);

		$mail->Subject = 'Registration Successful';
		$mail->Body    = 'Thank you for registering!';

		if (!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}

	private function sendResetPasswordEmail($email, $newPassword)
	{
		$mail = new PHPMailer(true);
		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Username = 'riyaz.eww@gmail.com';
		$mail->Password = 'cwktahnatxtizirs';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = '465';

		$mail->From = 'admin.test@yopmail.com';
		$mail->FromName = 'Mailer';
		$mail->addAddress($email, 'Rahul');

		$mail->WordWrap = 50;
		$mail->isHTML(true);

		$mail->Subject = 'Password Reset';
		$mail->Body    = "Your new password is: $newPassword";

		if (!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
}
