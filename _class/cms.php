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



}
?>