<?php

/**
 * Descrição da classe dsb_connection_bd
 *
 * @author Cleber Nardelli
 */
class dsb_connection_bd {
    
    private $instanceConnection;
    
    private $connected;
    
    private $database;
    private $host;
    private $useername;
    private $password;
    
    function __construct($database, $host, $useername, $password) {
        $this->database = $database;
        $this->host = $host;
        $this->useername = $useername;
        $this->password = $password;
        
        $this->connected = false;        
    }

    public function connect(){
        if(!$this->connected) {
            try {
                $this->instanceConnection = new PDO('pgsql:' .
                                                    'dbname=' . $this->getDatabase() . ';' .
                                                    'host=' . $this->getHost() . ';' . 
                                                    'user=' . $this->getUseername() . ';' . 
                                                    'password=' . $this->getPassword());        
                $this->instanceConnection->exec("SET APPLICATION_NAME TO 'dashboard'");
                $this->connected = true;
            } catch (Exception $exc) {
                if($this->instanceConnection) {
                    throw new dsb_class_exception_base('Erro ao conectar no SGBD. Info: ' . $this->instanceConnection->errorInfo() . '<br>' .
                                                       'Detalhes: ' . $exc->getMessage() . '<br>' .
                                                       'Trace: ' . $exc->getTraceAsString());
                } else { 
                    throw new dsb_class_exception_base('Erro ao conectar no SGBD. <br>' .
                                                       'Detalhes: ' . $exc->getMessage() . '<br>' .
                                                       'Trace: ' . $exc->getTraceAsString());
                }
            }
        }
    }
    
    function getConnected() {
        return $this->connected;
    }

    public function criaQuery($sSQL) {
        $result = new dsb_query($this);
        $result->setSQL($sSQL);
        return $result;
    }

    function getInstanceConnection() {
        return $this->instanceConnection;
    }

    function getDatabase() {
        return $this->database;
    }

    function getHost() {
        return $this->host;
    }

    function getUseername() {
        return $this->useername;
    }

    function getPassword() {
        return $this->password;
    }

    function setDatabase($database) {
        $this->database = $database;
    }

    function setHost($host) {
        $this->host = $host;
    }

    function setUseername($useername) {
        $this->useername = $useername;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    
}

class dsb_query {
    
    /* @var dsb_connection_bd */
    private $connection;
    /* @var string */
    private $SQL;
    /* @var resource */
    private $query;
    
    function __construct($connection) {
        $this->connection = $connection;
    }
    
    function getConnection() {
        return $this->connection;
    }

    function setConnection($connection) {
        $this->connection = $connection;
    }
    
    function getSQL() {
        return $this->SQL;
    }

    function setSQL($SQL) {
        $this->SQL = $SQL;
    }

    function execute() {
       if(!$this->connection->getConnected()) {
           $this->connection->connect;
       }
       $query = $this->connection->getInstanceConnection()->exec($this->getSQL());
    }
    
    function open() {
       if(!$this->connection->getConnected()) {
           $this->connection->connect();
       }
       $this->query = $this->connection->getInstanceConnection()->prepare($this->getSQL());
       return $this->query->execute();
    }
    
    function next() {
       if($this->query){
          $result = $this->query->fetch(PDO::FETCH_BOTH);
       } else {
           throw new dsb_class_exception_base('Query não preparada para carrega os dados!');
       }
       return $result;
    }
    
    function getAsJson() {
        $result = '';
        while($linha = $this->next()) {
           $result .= json_encode($linha) . ',';
        }
        $result = substr($result, 0, strlen($result)-1);
        return '[' . $result . ']';
    }
    
}