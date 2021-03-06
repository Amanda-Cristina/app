<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use JMS\Serializer\Annotation as Serialize;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Exception\PartialDenormalizationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ConstraintViolationList;
use Doctrine\Common\Annotations\AnnotationRegistry;

class Client extends Model
{
    use HasFactory;

    
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function attributes(): array{
        return ['nome', 'cpf', 'email', 'cep', 'numero', 'rua', 'bairro', 'cidade', 'estado', 'senha', 'telefone'];
    }

    
    public function validatesInsert($request){
        $errors=array();
        if (!empty(Client::where('email', '=', $request -> email)->get()->first())){
            array_push($errors, 'Este email já está cadastrado');
            return [$errors];
            }

        if (!empty(Client::where('cpf', '=', $request -> cpf)->get()->first())){
            array_push($errors,'O usuário com este cpf já está cadastrado');
            return [$errors];
            }
        return $errors;
    }

     public function validatesUpdate($request){
        $errors=array();

        $cliente = Client::where('id', '=', $request -> id)->get()->first();
        
        if (empty($cliente)){
            array_push($errors, 'O usuário não foi encontrado no sistema');
            return [$errors];
        }

        $cliente = Client::where('email', '=', $request -> email)->get()->first();
        if (!empty($cliente)){
            if (($cliente -> email == $request -> email) && ($cliente -> id != $request -> id)){
                array_push($errors, 'Este email já está cadastrado');
                return [$errors];
                }
        }

        $cliente = Client::where('cpf', '=', $request -> cpf)->get()->first();
        if (!empty($cliente)){
            if (($cliente -> cpf == $request -> cpf) && ($cliente -> id != $request -> id)){
                array_push($errors,'O usuário com este cpf já está cadastrado');
                return [$errors];
            }
        }
        
        return $errors;
    }

    public function validatesDelete($id){
        $errors=array();

        $cliente = Client::where('id', '=', $id)->get()->first();
        if (empty($cliente)){
            array_push($errors, 'O usuário não foi encontrado no sistema');
            return [$errors];
        }

        return $errors;
        }
   
}
    
    
        

    

