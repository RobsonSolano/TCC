<?php

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model
{

	private $cli_name;
	private $cli_phone;
	private $cli_email;
	private $cli_pass;

	public function __get($atributo)
	{
		return $this->$atributo;
	}

	public function __set($atributo, $valor)
	{
		$this->$atributo = $valor;
	}

	public function cadastrar()
	{
		$sql = "SELECT cli_phone FROM tb_clientes WHERE cli_phone = :CLI_PHONE";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':CLI_PHONE', $this->__get('cli_phone'));
		$stmt->execute();

		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

		if ($usuario['cli_phone'] == '') {
			$query = "insert into tb_clientes(cli_name, cli_phone,cli_email, cli_pass)values(:NAME, :PHONE, :EMAIL, :PASS)";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':NAME', $this->__get('cli_name'));
			$stmt->bindValue(':PHONE', $this->__get('cli_phone'));
			$stmt->bindValue(':EMAIL', $this->__get('cli_email'));
			$stmt->bindValue(':PASS', $this->__get('cli_pass')); //md5() -> hash 32 caracteres
			$stmt->execute();

			return $this;
		} else {
			return false;
		}
	}

	public function autenticar()
	{

		$query = "select cli_id, cli_name, cli_email from tb_clientes where cli_email = :EMAIL and cli_pass = :PASS";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':EMAIL', $this->__get('cli_email'));
		$stmt->bindValue(':PASS', $this->__get('cli_pass'));
		$stmt->execute();

		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

		if ($usuario['cli_id'] != '' && $usuario['cli_name'] != '') {
			$this->__set('cli_id', $usuario['cli_id']);
			$this->__set('cli_name', $usuario['cli_name']);
		}

		return $this;
	}

	//Informações do Usuário
	public function getInfoUsuario()
	{
		$query = "SELECT cli_id, cli_name, cli_email, cli_data_cadastro FROM tb_clientes WHERE cli_id = :CLI_ID";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':CLI_ID', $this->__get('cli_id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function cadUserModal()
	{
		$query = "SELECT cli_email FROM tb_clientes_notifi WHERE cli_email = :CLI_EMAIL";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':CLI_EMAIL', $this->__get('cli_email'));
		$stmt->execute();

		$usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

		if ($usuario['cli_email'] != '') {
			return false;
		} else {
			$sql = "INSERT INTO tb_clientes_notifi (cli_name,cli_email,cli_phone) VALUES (:CLI_NAME, :CLI_EMAIL, :CLI_PHONE)";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(':CLI_NAME', $this->__get('cli_name'));
			$stmt->bindValue(':CLI_EMAIL', $this->__get('cli_email'));
			$stmt->bindValue(':CLI_PHONE', $this->__get('cli_phone'));
			$stmt->execute();

			return $this;
		}
	}

}
