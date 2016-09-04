<?php 

class Controller
{
	public function model($model) {
		$model = $model;
		require_once '../app/models/' . $model . '.php';
		return Model::getInstance();
	}

	public function view($view, $data = []) {
		if (is_array($view)) {
			foreach ($view as $part) {
				require_once '../app/views/home/' . $part . '.php';
			}
		} else {
			require_once '../app/views/home/' . $view . '.php';
		}
	}

	public function helper($helper) {
		require_once '../app/helpers/' . $helper . '.php';
	}
}