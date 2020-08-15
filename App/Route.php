<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['entrar'] = array(
			'route' => '/entrar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);
		$routes['identifica'] = array(
			'route' => '/identifica',
			'controller' => 'IndexController',
			'action' => 'identifica'
		);
		
		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$routes['menu_digital'] = array(
			'route' => '/menu_digital',
			'controller' => 'indexController',
			'action' => 'menu_digital'
		);

		$routes['pedido'] = array(
			'route' => '/pedido',
			'controller' => 'IndexController',
			'action' => 'pedido'
		);

		$routes['acao'] = array(
			'route' => '/acao',
			'controller' => 'AppController',
			'action' => 'acao'
		);

		$routes['cadastra'] = array(
			'route' => '/cadastra',
			'controller' => 'AuthController',
			'action' => 'cadastra'
		);

		$routes['formModal'] = array(
			'route' => '/formModal',
			'controller' => 'AuthController',
			'action' => 'formModal'
		);

		
		$this->setRoutes($routes);
	}

}

?>