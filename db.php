<?php
    class database{
        private $db;
        public function  __construct(){
            $this->db=mysqli_connect("localhost", "root","","user");
            if(mysqli_connect_error($this->db)){
                echo "error database connect";
                return false;
            }
            mysqli_query($this->db, "SET NAME UTF8");
            return  $this->db;

        }
        // upiti
        
	public function __destruct(){
		mysqli_close($this->db);
	}
	

	
	public function upit($upit){
		return mysqli_query($this->db, $upit);
	}
	
	public function dohvatiRed($rez){
		return mysqli_fetch_object($rez);
	}
	public function promenjeniRedovi(){
		return mysqli_affected_rows($this->db);
	}
	public function procitajRed($rez)
	{
		return mysqli_fetch_object($rez);
	}
	public function brojRedova($rez)
	{
		
		return mysqli_num_rows($rez);
		
	}
	public function greska()
	{
		return mysqli_error($this->db);
	}

    }

?>