<?php 


class Conexion extends MetodosComunes {

    public $host = SERVER;  // e.g., "localhost" or "127.0.0.1"
    public $dbname = DB;
    public $username = USER;
    public $password = PASSWORD;
    public $engine_db = ENGINE_DB;
    public $port = PORT[ENGINE_DB];
    public $pdo = false;

    public function __construct(){
        
        try {

            $this->pdo = new PDO("{$this->engine_db}:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->username, $this->password);
            // For other databases, replace "mysql" with the appropriate database driver (e.g., "pgsql", "sqlite").
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->writeLog('CON_DB::','Conected successfully to ' . $this->host . '/'.$this->engine_db.':'.$this->port);

        } catch (PDOException $e) {

            $this->writeLog('CON_DB::','Failed to connect ' . $this->host . '/'.$this->engine_db.':'.$this->port . '----' . $e->getMessage());

        }


    }

    public function __destruct(){

        $this->host = '';
        $this->dbname ='';
        $this->username ='';
        $this->password ='';
        $this->engine_db ='';
        $this->port ='';
        $this->pdo = false;

    }

}


?>