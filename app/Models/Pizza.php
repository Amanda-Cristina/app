<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pizza extends Model
{
    use HasFactory;
    public function attributes(): array{
        return ['nome', 'codigo', 'imagem', 'descricao', 'preco', 'categoria'];
    }

    public function validatesInsert($request){
        $errors=array();
        if (!empty(Pizza::where('codigo', '=', $request -> codigo)->get()->first())){
            array_push($errors, 'Este código já está cadastrado');
            return [$errors];
            }

        if (!empty(Pizza::where('nome', '=', $request -> nome)->get()->first())){
            array_push($errors,'Uma pizza com este nome já está cadastrada');
            return [$errors];
            }
        return $errors;

       
    }

    public function validatesUpdate($request){
        $errors=array();

        $pizza = Pizza::where('id', '=', $request -> id)->get()->first();
        
        if (empty($pizza)){
            array_push($errors, 'A pizza não foi encontrada no sistema');
            return [$errors];
        }

        $pizza = Pizza::where('codigo', '=', $request -> codigo)->get()->first();
        if (!empty($pizza)){
            if (($pizza -> codigo == $request -> codigo) && ($pizza -> id != $request -> id)){
                array_push($errors, 'Uma pizza com este código já está cadastrada');
                return [$errors];
                }
        }

        $pizza = Pizza::where('nome', '=', $request -> nome)->get()->first();
        if (!empty($pizza)){
            if (($pizza -> nome == $request -> nome) && ($pizza -> id != $request -> id)){
                array_push($errors,'Uma pizza com este nome já está cadastrada');
                return [$errors];
            }
        }
        
        return $errors;
    }
}
