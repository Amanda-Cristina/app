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
                'cpf' => 'required',
                'email' => 'required|string|unique:users,email',
                'telefone' => 'required',
                'cep' => 'required',
                'numero' => 'required',
                'rua' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required',
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

    
}
