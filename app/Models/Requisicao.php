<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisicao extends Model
{
    use HasFactory;
    public function validate(){
        try{
            $this -> request = json_decode(file_get_contents("php://input"));

            if(isset($this -> request) && !empty($this -> request)){
                return $this -> request -> data;
            }
            else{
                new Resposta(400, ['Sem dados de requisição ']);
                die;
            }
        }
        catch(\Exception $e){
            new Resposta(400, ['Falha na requisição dos dados -> '. $e->getMessage()]);
            die;
        }     
    }


    public function jsonData(){
        return json_encode($this -> validate());
    }

    public function objectData(){
        return $this -> validate();
    }
    
}
