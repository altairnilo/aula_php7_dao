<?php
class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;
    public function getIdusuario(){
        return $this->idusuario;
    }
    public function setIdusuario($value){
        $this->idusuario=$value;
    }
    public function getDeslogin(){
        return $this->deslogin;
    }
    public function setDeslogin($value){
        $this->deslogin=$value;
    }
    public function getDessenha(){
        return $this->dessenha;
    }
    public function setDessenha($value){
        $this->dessenha=$value;
    }
    public function getDtcadastro(){
        return $this->dtcadastro;
    }
    public function setDtcadastro($value){
        $this->dtcadastro=$value;
    }
    public function loadById($id){
        $sql=new Sql();
        $result=$sql->select("SELECT * FROM tb_usuarios WHERE idusuario= :ID",array(":ID"=>$id));
        if (count($result)>0){
            $this->setData($result[0]);
        }
    }
    public static function getList(){ 
        //static não precisa instanciar o objeto
        // o método estático é usado quando não precisamos da palavra this
        $sql=new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function search($login){
        $sql=new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(':SEARCH'=>"%".$login."%"));
    }
    public function login($login, $password){
        $sql=new Sql();
        $result=$sql->select("SELECT * FROM tb_usuarios WHERE deslogin=:LOGIN AND dessenha=:PASSWORD",array(":LOGIN"=>$login, ":PASSWORD"=>$password));
        if (count($result)>0){
            $this->setData($result[0]);
        } else {
            throw new Exception("Login e/ou Senha inválidos!");
        }
    }

    public function setData($data){
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    public function insert(){
        $sql=new Sql();
        // no MySql usamos CALL, no MSSQL chamamos de EXECUTE.
        // deve-se criar uma procedure no mysql para executação da chamada
        // abaixo.
        $results=$sql->select("CALL sp_usuarios_insert (:LOGIN, :SENHA)",array(
            ':LOGIN'=>$this->getDeslogin(),
            ':SENHA'=>$this->getDessenha()
        ));
        if (count($results)>0){
            $this->setData($results[0]);
        }
    }

    public function __construct($login="",$senha=""){
        // aspas colocadas pra não dar erro caso estejam vazios.
        $this->setDeslogin($login);
        $this->setDessenha($senha);

    }


    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
}
?>