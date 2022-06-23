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
   
    

    public function inserirPizza(Request $request){


        try{
            
            $request -> validate([
                'nome' => 'required',
                'codigo' => 'required',
                'descricao' => 'required',
                'imagem' => 'required',
                'categoria' => 'required',
                'preco' => 'required'
                
                 ]);

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


        public function deletePizza(Request $request){
            try{
                
                $errors = $this -> pizza -> validatesDelete($request -> id);
                
                if(empty($errors)) {   
                    Pizza::destroy($request -> id);
                    new Resposta(200, ["Remoção da pizza com sucesso"]);                   
                }
                else{
                    new Resposta(400, $errors[0]);
                }
            }

            catch(\Exception $e){
                new Resposta(400, ['Falha no cancelamento do cadastro -> ' . $e->getMessage()]);
               
            }
        }

        public function selectPizza(Request $request){
            try{
    
                $pizza = Pizza::find($request -> id);
                if(!empty($pizza)) {   
                    new Resposta(200, $pizza);                   
                }
                else{
                    new Resposta(400, ["A pizza não foi encontrada no sistema"]);
                }
            }

            catch(\Exception $e){
                new Resposta(400, ['Falha na busca pela pizza -> ' . $e->getMessage()]);
               
            }
        }

        public function selectList(){
            try{
                $list = Pizza::all();
                if(!empty($list)) {   
                    new Resposta(200, $list);                   
                }
                else{
                    new Resposta(400, ["Não foram encontradas pizza no sistema"]); 
                }
            }

            catch(\Exception $e){
                new Resposta(400, ['Falha na busca pelas pizzas -> ' . $e->getMessage()]);
               
            }
        }


        

}
