<?php

require_once("config.php");

// Traz apenas um usuario pelo ID passado como parametro
//$root = new Usuario();
//$root->loadByID(2);
//echo $root;

// Traz a lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

// Traz uma lista de usuario pesquisando por login que é enviado através de parametro
//$busca = Usuario::search("charles");
//echo json_encode($busca);

// Carrega o usuario passando o login e a senha por parametros
$usuario = new Usuario();
$usuario->login("charles", "1234");
echo $usuario;

?>