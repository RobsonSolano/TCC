<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action
{

	public function __get($atributo)
	{
		return $this->$atributo;
	}

	public function __set($atributo, $valor)
	{
		$this->$atributo = $valor;
	}

	public function cadastra()
	{
		$usuario = Container::getModel('Usuario');

		if (strlen($_POST['cli_pass']) < 6) {
			header("location: /inscreverse?pass=error");
			exit;
		}

		$usuario->__set('cli_name', trim($_POST['cli_name']));
		$usuario->__set('cli_phone', trim($_POST['cli_phone']));
		$usuario->__set('cli_email', trim($_POST['cli_email']));
		$usuario->__set('cli_pass', str_replace(' ', '', (md5($_POST['cli_pass']))));

		if ($usuario->cadastrar()) {
			header("location: /identifica");
		} else {
			header("location: /inscreverse?cad=error");
			exit;
		}
	}

	public function autenticar()
	{

		$usuario = Container::getModel('Usuario');

		$usuario->__set('cli_email', trim($_POST['cli_email']));
		$usuario->__set('cli_pass', trim(md5($_POST['cli_pass'])));

		$usuario->autenticar();

		if ($usuario->__get('cli_id') != '' && $usuario->__get('cli_name')) {

			session_start();

			$_SESSION['cli_id'] = $usuario->__get('cli_id');
			$_SESSION['cli_name'] = $usuario->__get('cli_name');

			header('Location: /menu_digital');
		} else {
			header('Location: /identifica?login=erro');
		}
	}

	public function sair()
	{
		session_start();
		session_destroy();
		header('Location: /');
	}

	public function formModal()
	{
		$usuario = Container::getModel('Usuario');

		$usuario->__set('cli_name', trim($_POST['cli_name']));
		$usuario->__set('cli_email', trim($_POST['cli_email']));
		$usuario->__set('cli_phone', trim($_POST['cli_phone']));

		if ($usuario->cadUserModal()) {
			header('Location: /?modal=success');
		} else {
			header('Location: /?modal=error');
		}
	}

	public function pedido()
	{
		$usuario = Container::getModel('Usuario');

		$usuario->pedido();
	}
}
