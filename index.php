<?php
require_once("config.php");
/*$sql=new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);*/
// carrega um usuario
//$usuario=new Usuario();
//$usuario->loadById(4);
//echo $usuario;

// Carrega uma lista de usuarios
//$lista = Usuario::getList(); // não precisa instanciar.
//echo json_encode($lista);

// Carrega uma lsita de usuários buscando pelo login
//$busca = Usuario::search("j");
//echo json_encode($busca);

// Carrega usuarios a partir de login e senha
/*$busca=new Usuario();
$login="Altair";
$password="1a2b3c4d55ee";
$busca->login($login,$password);
echo $busca;*/
$aluno = new Usuario("Alessandra","lele547076");

//$aluno->setDeslogin("aluno");
//$aluno->setDessenha("@alun0");
// após o método construtor criado na classe usuario
// não há necessidade das duas linhas acima.

$aluno->insert();

echo $aluno;
?>