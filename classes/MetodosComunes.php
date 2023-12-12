<?php 


class MetodosComunes {

    public $con;

    public function __construct( $con ){

        $this->con = $con;

    }

    public function writeLog( $title , $content ){

        $fileLog = "./logs/processLog_" . date('d-m-Y') . ".log";
        $text_content = date('d-m-Y H:i:s')." -- $title::$content\n";
        
        file_put_contents( $fileLog , $text_content , FILE_APPEND );

    }

    public function procesarError($errno, $errstr, $errfile, $errline) {

        $this->writeLog("ERROR_OVERALL", "Error general: $errno, $errstr, $errfile, $errline");
        
    }

    public function getAllUsers(){

        // $clausure = !$search ? "" : " where idUser like :search OR username like :search";

        $sql = "select idUser , username , password from users";

        // if ( $search ) {

        //     $search = $_GET['search'];

        //     $sql.= $clausure;

        //     $stmt = $this->con->prepare( $sql );
            
        //     $stmt->bindValue(':search',"%$search%", PDO::PARAM_INT);
        //     $stmt->bindValue(':search',"%$search%", PDO::PARAM_STR);

        //     try {

        //         $stmt->execute();

        //         $result = $stmt->fetchAll( PDO::FETCH_ASSOC);

        //         return $result;

        //     } catch ( PDOException $e ){

        //         $this->writeLog('SQLERROR:SEARCH' , $sql . ' --- ' . $e->getMessage());

        //     }

        // }

        return $this->processQuery( $sql );

    }

    public function checkUser( $username ){

        $sql = "select * from users where username = '$username'";

        $this->writeLog('SQL:CHECK USER' , $sql );

        return count($this->processQuery( $sql ));

    }

    public function addUser( $username , $password ){

        $sql = "insert into users ( username , password ) values ( '$username' , '$password' )";

        $this->processQueryUD( $sql );

    }

    public function updateUser( $id_user , $username ){

        if ( empty($username) ){ return false; }

        $sql = "update users set username = '$username' where idUser = $id_user";

        if ( $this->checkUser( $username ) > 0 ){ return false; }

        $this->processQueryUD( $sql );

        return true;

    }

    public function deleteUser( $id_user ){

        $sql = "delete from users where idUser = $id_user";

        $this->processQueryUD( $sql );

    }

    public function processQueryUD( $sql ){

        $stmt = $this->con->prepare($sql);

        $stmt->execute();

    }
    
    public function processQuery( $sql ){

        $stmt = $this->con->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

}


?>