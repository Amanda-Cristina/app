<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Resposta;
use App\Models\User;

class ClientController extends Controller
{

    
    public Client $cliente;
    
    

    public function __construct()
    {
        $this -> cliente = new Client();
        
    }


   
    public function inserirClient(Request $request){

        try{
            $fields = $request -> validate([
                'nome' => 'required|string',
                'cpf' => 'required|string',
                'email' => 'required|string|unique:users,email|email',
                'telefone' => 'required|string',
                'cep' => 'required|string',
                'numero' => 'required|numeric',
                'rua' => 'required|string',
                'bairro' => 'required|string',
                'cidade' => 'required|string',
                'estado' => 'required|string',
                'senha' => 'required|string',
                
                 ]);

        
                $user = User::firstOrCreate([
                    'name' => $fields['nome'],
                    'email' => $fields['email'],
                    'password' => bcrypt($fields['senha'])
                ]);

            $errors = $this -> cliente -> validatesInsert($request);
            if(empty($errors)){
                foreach ($this -> cliente -> attributes() as $attribute): 
                            
                    $this -> cliente -> $attribute = $request -> input($attribute); 
                    
                endforeach;
                $this -> cliente -> user_id = $user -> id;

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


    public function updateClient(Request $request){
        try{
            $request -> validate([
                'id' => 'required',
                'cpf' => 'required|string',
                'email' => 'required|string',
                 ]);

            $errors = $this -> cliente -> validatesUpdate($request);
            if(empty($errors)){
                $entrada = Client::find($request -> id);
                foreach ($this -> cliente -> attributes() as $attribute): 
                            
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

        public function deleteClient(Request $request){
            try{
                
                $errors = $this -> cliente -> validatesDelete($request -> id);
                
                if(empty($errors)) {   
                    Client::destroy($request -> id);
                    new Resposta(200, ["Cancelamento da conta com sucesso"]);                   
                }
                else{
                    new Resposta(400, $errors[0]);
                }
            }

            catch(\Exception $e){
                new Resposta(400, ['Falha no cancelamento do cadastro -> ' . $e->getMessage()]);
               
            }
        }

        public function selectClient(Request $request){
            try{
    
                $cliente = Client::find($request -> id);
                if(!empty($cliente)) {   
                    new Resposta(200, $cliente);                   
                }
                else{
                    new Resposta(400, ["O usuário não foi encontrado no sistema"]);
                }
            }

            catch(\Exception $e){
                new Resposta(400, ['Falha na busca pelo usuário -> ' . $e->getMessage()]);
               
            }
        }

        public function selectList(){
            try{
                $list = Client::all();
                if(!empty($list)) {   
                    new Resposta(200, $list);                   
                }
                else{
                    new Resposta(400, ["Não foram encontrados usuários no sistema"]); 
                }
            }

            catch(\Exception $e){
                new Resposta(400, ['Falha na busca pelos usuários -> ' . $e->getMessage()]);
               
            }
        }





    
    
}
