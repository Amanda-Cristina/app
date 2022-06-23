<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use App\Models\Resposta;

class PizzaController extends Controller
{
    public Pizza $pizza;
    
    

    public function __construct()
    {
        $this -> pizza = new Pizza();
        
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

    public function inserirPizza(Request $request){


        try{
            
            $this -> validatesForm($request);
            $errors = $this -> pizza -> validatesInsert($request);
            if(empty($errors)){
                foreach ($this -> pizza -> attributes() as $attribute): 
                            
                    $this -> pizza -> $attribute = $request -> input($attribute); 
                    
                endforeach;
                $this -> pizza -> save();
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

    public function updatePizza(Request $request){
        try{
            $request -> validate([
                'id' => 'required',
                'codigo' => 'required'
                
                 ]);

            $errors = $this -> pizza -> validatesUpdate($request);
            if(empty($errors)){
                $entrada = Pizza::find($request -> id);
                foreach ($this -> pizza -> attributes() as $attribute): 
                            
                    $entrada -> $attribute = $request -> input($attribute); 
                    
                endforeach;
                
                $entrada -> save();
                new Resposta(200, ["Atualização com sucesso"]);
            }
            else{
                new Resposta(400, $errors[0]);
            }
        }
        catch(\Exception $e){
            new Resposta(400, ['Falha na atualização -> ' . $e->getMessage()]);
           
        }
        }
        

}
