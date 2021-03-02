<?php
    class User {
        private $name;
        private $lastName;
        private $age;

        function __construct($nombre, $apellido, $edad){
            $this->name = $nombre;
            $this->lastName = $apellido;
            $this->age = $edad;
        }
        public function emptyNullVerification(){
            $dataArr = array($this->name, $this->lastName, $this->age);

            for ($i=0; $i < count($dataArr); $i++) { 
                if($dataArr[$i] === '' || $dataArr[$i] === null){
                    return 400;
                }
            }

            return 0;
        }

        public function whiteSpaceVerification(){
            //* Es importante que un nombre o un apellido puede tener entre medio un espacio en blanco
            //* Ej: Jose Maria

            //* Si el nombre o el apellido empiezan con un espacio en blanco, retornan 422
            if(str_starts_with($this->name, ' ') || str_starts_with($this->lastName, ' ')) {
                return 422;
            }
            //* Si el nombre o el apellido terminan con un espacio en blanco, retornan 422
            if(str_ends_with($this->name, ' ') || str_ends_with($this->lastName, ' ')) {
                return 422;
            }
            
            if(str_contains($this->age, ' ')) {
                return 422;
            }

            return 0;
        }

        public function typeVerification(){
            $typeArr = array(intval($this->name), intval($this->lastName));

            if ($this->age !== '0') {
                if(intval($this->age) < 0 ||intval($this->age) === 0){
                    return 422;
                }
            }

            for ($i=0; $i < count($typeArr); $i++) {
                if ($typeArr[$i] !== 0) {
                    return 422;
                }
            }

            return 0;
        }
    }
?>