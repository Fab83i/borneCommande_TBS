<?php
class connexion
{
    private $dbhost = "localhost";
    private $dbuser = "bdd_macDo";
    private $dbpassword = "azerty";
    private $dbname = "bdd_macDo";
    private $PDO = null;
    private static $_instance = null;


    function __construct(){
    }
    public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new connexion();
        }
        return self::$_instance;
    }

    public function connect()
    {
        $this->PDO = null;

        if ($this->PDO == null) {
            try {

                $this->PDO =new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->
                dbpassword,array(PDO::ATTR_PERSISTENT => true));


            } catch (Exception $e) {
                echo $e->getMessage();

            }
        }
        return $this->PDO;
    }

    public function disconnect(){
        $this ->PDO=null;
    }
}
