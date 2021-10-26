<?php
	/**
	 * 
	 */
	class Login
	{

		protected $link;
		
		function __construct()
		{
			$this->link = mysqli_connect('localhost','root','','rawPHP');
		}

		public function adminLoginCheck($data){

			$email = $data['email'];
			$password = md5($data['password']);

			$sql = "select * from users where email='$email' AND password = '$password'";

			if (mysqli_query($this->link,$sql)) {

				$queryResult = mysqli_query($this->link,$sql);
				$userInfo = mysqli_fetch_assoc($queryResult);
				
				if ($userInfo) {

					session_start();
					$_SESSION['id'] = $userInfo['id'];
					$_SESSION['name'] = $userInfo['name'];

					header("Location: Dashboard.php");
				}else{
					$msg = "Email or Password Not Valid!!";
 					return $msg;
				}

			}else{
				die("Query Problem".mysqli_error($this->link));
			}
		}

		public function logout(){

			unset($_SESSION['id']);
			unset($_SESSION['name']);

			header("Location: index.php");
		}
	}
?>