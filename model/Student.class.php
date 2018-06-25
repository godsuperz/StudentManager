<?php
    class Student
    {
        private $sno;
        private $sname;

        function __construct($par1,$par2){
            $this->sno = $par1;
            $this->sname = $par2;
        }

        public function __get($key){
            return $this->$key;
        }

        public function __set($key,$value){
            $this->$key = $value;
        }
    }
?>