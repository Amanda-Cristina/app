<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Resposta;

class ClientController extends Controller
{

    
    public Client $cliente;
    
    

    public function __construct()
    {
        $this -> cliente = new Client();
        
    }

    public function validatesForm($request){
        $request -> validate([
            'nome' => 'required',
            'codigo' => 'required',
            'descricao' => 'required',
            'imagem' => 'required',
            'categoria' => 'required',
            'preco' => 'required'
            
             ]);

    }

   
    public function inserirClient(Request $request){

        try{
            $this -> validatesForm($request);

            $errors = $this -> cliente -> validatesInsert($request);
            if(empty($errors)){
                foreach ($this -> cliente -> attributes() as $attribute): 
                            
                    $this -> cliente -> $attribute = $request -> input($attribute); 
                    
                endforeach;
                $this -> cliente -> save();
                new Resposta(200, ["Inserção com sucesso"]);
            }
            else{
                new Resposta(400, $errors[0]);
            }
        }
        catch(\Exception $e){
            new Resposta(400, ['Falha na inserção -> ' . $e->getMessage()]);
           
        }
    }

    
}
