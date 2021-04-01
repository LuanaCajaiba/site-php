<?php
class CMS {
var $host; //variáveis serão utilizadas para a interação com o BD
var $usuario;
var $senha;
var $bd;
public function display_public() {}
public function display_admin() {}
public function gravar() {}
public function conectar() {}
private function criaBD() {}


// Essa função irá criar as tabelas no Banco de Dados

private function criaBD() {
    $sql = <<<MySQL_QUERY
    CREATE TABLE IF NOT EXISTS artigos (
    id INT(11) NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(150),
    conteudo TEXT,
    data VARCHAR(100),
    PRIMARY KEY (id)
    )
    MySQL_QUERY;
    return mysql_query($sql);
    }

    //Essa função será responsável por conectar o site com o Banco de Dados

    public function conectar() {
        mysql_connect($this->host,$this->usuario,$this->senha)     //conecta ao servidor de banco de dados
        or die("Não foi possível conectar. " . mysql_error());
        mysql_select_db($this->bd)                                   //certifica-se de operar com bd correto
        or die("Não foi possível selecionar o BD. " . mysql_error());  //die informa o erro
        return $this->criaBD();
        }


    //essa função cria os formulários

    public function display_admin() {
        return <<<ADMIN_FORM
        <form action="{$_SERVER[‘PHP_SELF’]}" method="post">
        
        <label for="titulo">Título:</label><br />
        <input name="titulo" id="titulo" type="text" maxlength="150" />
        <div class="clear"></div>
        
        <label for="conteudo">Conteúdo:</label><br />
        <textarea name="conteudo" id="conteudo"></textarea>
        <div class="clear"></div>
        
        <input type="submit" value="Criar Post!" />
        </form>
        
        <br />
        
        <a href="blog.php">Voltar para Home</a>
        ADMIN_FORM;
        }


        

}
?>