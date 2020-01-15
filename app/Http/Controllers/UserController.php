<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Validator;
use Exception;

class UserController extends Controller
{
    //
    public function index(){
        //
    }

    public function show(User $user){
        if($user){
            return response($user->jsonSerialize(), Response::HTTP_OK);
        }else{
            return response(json_encode(array("error" => "Usuário não encontrado"), JSON_UNESCAPED_UNICODE), Response::HTTP_BAD_REQUEST);
        }
    }

    function store(Request $request)
    {
        $validator = new UserStoreRequest();
        $valid = Validator::make($request->all(), $validator->rules(), $validator->messages());
        if($valid->fails()){
            return response(json_encode($valid->errors(), JSON_UNESCAPED_UNICODE), Response::HTTP_CONFLICT);
        }else{
            try{
                $user = User::create($request->all());
                return response($user->jsonSerialize(), Response::HTTP_CREATED);
            }catch(Exception $e){
                return response(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function update(Request $request, User $user)
    {
        $return = $user->update(
            $request->all()
        );

        if($return){
            return response(json_encode($return), Response::HTTP_CREATED);
        }else{
            return response(json_encode(array("error" => "Não foi possível atualizar o usuário"), JSON_UNESCAPED_UNICODE), Response::HTTP_BAD_REQUEST);
        }
    }

    // public function destroy(User $user)
    // {
    //     if($user->id == Auth::id()){
    //         $result = $user->delete();
    //         if($result){
    //             return response($result, Response::HTTP_OK);
    //         }else{
    //             return response(json_encode(array("error" => "Não foi possível excluir usuário."), JSON_UNESCAPED_UNICODE), Response::HTTP_BAD_REQUEST);
    //         }
    //     }else{
    //         return response(json_encode(array("error" => "Você deve ser o usuário para se"), JSON_UNESCAPED_UNICODE), Response::HTTP_FORBIDDEN);
    //     }
    // }

}
