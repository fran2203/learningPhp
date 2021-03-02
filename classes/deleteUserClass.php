<?php
    class deleteUser {
        private $id;

        function __construct($user_id){
            $this->id = $user_id;
        }

        public function verifyIdType(){
            if ($this->id !== '0') {
                if(intval($this->id) < 0 ||intval($this->id) === 0){
                    return 422;
                }
            }

            return 0;
        }

        public function whiteSpaceId(){
            if(str_contains($this->id, ' ')) {
                return 422;
            }

            return 0;
        }

        public function nullVerification(){
            if($this->id === '' || $this->id === null){
                return 400;
            }

            return 400;
        }
    }
?>