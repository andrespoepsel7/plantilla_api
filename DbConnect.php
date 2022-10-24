<?php
    class DbConnect{
        // Servidor al que se le hará el request
        private $server = 'localhost';
        // Nombre de la base de datos
        private $dbname = 'react_prueba';
        // Usuario
        private $user = 'root';
        // Contraseña
        private $pass = 'root';

        public function connect(){
            try{
                $conn = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbname, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                return $conn;
            }catch(\Exception $e){
                echo "Database Error: ". $e->getMessage();
            }
        }
    }
?> 