<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    use HasFactory;
    private $statusCode = 200;
        private $body; 

        public function __construct($code, $response)
        {
            $this -> setStatusCode($code);
            $this -> setBody($response);
            $this -> send(); 
        }
        public function setStatusCode(int $code){
            $this -> statusCode = $code;
            http_response_code($code);
        }

        public function setBody($response){
            $this -> body = $response;
        }

        public function send(){
            echo json_encode(array('status' => $this -> statusCode, 'data' => $this -> body),  JSON_UNESCAPED_UNICODE);

        }
        
}
