<?php

class Home extends Controller
{
	public function __construct() {
		$this->helper('Session');
		$this->helper('Input');
		$this->helper('Redirect');
	}
	
	public function index() {
		$this->view('head');
		$this->view('navbar');

		if(Session::exists('user')) {
			$posts = $this->model('Post');
			$posts = $posts->getAll();
			$this->view('content', ['posts' => $posts]);
		} else {
 			$this->view('signup');
		}
		$this->view('footer');
	}

	public function login()
	{
		if(Input::exists()) {
			if(Token::check('login', Input::get('login_token'))) {
				$email = Input::get('email');
				$password = Input::get('password');
				$user = $this->model('User');
				if($user->check($email, $password)) {
					Redirect::index();
				} else {
					Redirect::index();
				}

			} else {
				Redirect::index();
			}
		} else {
			Redirect::index();
		}
	}

	public function logout() {
		Session::delete('user');
		Redirect::index();
	}

	public function signup() {
		if(Input::exists()) {
			if(Token::check('signup', Input::get('signup_token'))) {
				$user = $this->model('User');
				$user->email = $_POST['email'];
				$user->password = md5($_POST['password']);
				$user->first_name = $_POST['first_name'];
				$user->last_name = $_POST['last_name'];
				$user->insert();
				Session::put(Config::get('session/flash_success'), "You have successfuly registred.");
				Redirect::index();

			} else {
				Redirect::index();
			}
		} else {
			Redirect::index();
		}
	}

	public function insertPost() {
		$post = $this->model('Post');
		$post->content = $_POST['post'];
		$post->user_id = $_SESSION['user']['user_id'];
		$post->insert();
		Redirect::index();
	}
}