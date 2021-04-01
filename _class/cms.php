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

        //essa função insere os Dados dos Banco de Dados


        public function gravar($p) {
            if ( $_POST[‘titulo’] )
            $titulo = mysql_real_escape_string($_POST[‘titulo’]);
            if ( $_POST[‘conteudo’])
            $conteudo = mysql_real_escape_string($_POST[‘conteudo’]);
            if ( $titulo && $conteudo ) {
            $data = time();
            $sql = "INSERT INTO artigos (titulo,conteudo,data) VALUES(‘$titulo’,’$conteudo’,’$data’)";
            return mysql_query($sql);
            } else {
            return false;
            }
            }

            //essa função exibe os Dados gravados 

            public function display_public() {
                $q = "SELECT * FROM artigos ORDER BY data DESC LIMIT 3";
                $r = mysql_query($q);
                if ( $r !== false && mysql_num_rows($r) > 0 ) {
                while ( $a = mysql_fetch_assoc($r) ) {
                $titulo = stripslashes($a[‘titulo’]);
                $conteudo = stripslashes($a[‘conteudo’]);
                $entry_display .= <<<ENTRY_DISPLAY
                <div class="post">
                <h2>
                $titulo
                </h2>
                <p>
                $conteudo
                </p>
                </div>
                ENTRY_DISPLAY;
                }
                } else {
                $entry_display = <<<ENTRY_DISPLAY
                <h2> Este Site está em Construção </h2>
                <p>
                Clique no link para adicionar novos posts!
                </p>
                ENTRY_DISPLAY;
                }
                $entry_display .= <<<ADMIN_OPTION
                <p class="admin_link">
                <a href="{$_SERVER[‘PHP_SELF’]}?admin=1">Add Novo Post</a>
                </p>
                ADMIN_OPTION;
                return $entry_display;
                }


}
?>