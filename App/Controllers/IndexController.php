<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');
	}

	
	public function menu_digital(){

		$this->render('menu_digital');
		// header('Location: /menu_digital');
	}

	public function inscreverse() {

		$this->view->usuario = array(
				'cli_name' => '',
				'cli_phone' => '',
				'cli_email' => '',
				'cli_pass' => ''
			);

		$this->view->erroCadastro = false;

		$this->render('inscreverse');
	}

	public function identifica(){
		$this->render('entrar');
	}

	public function pedido(){
		$this->render('finaliza_pedido');
	}

	

}


?>