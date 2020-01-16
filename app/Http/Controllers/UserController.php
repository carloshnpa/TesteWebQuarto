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
    public function index()
    {
        //
    }

    public function init(){
        return response()->json(['user' => Auth::user()], Response::HTTP_OK);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)){
            return response()->json(Auth::user(), Response::HTTP_OK);
        }else{
            return response()->json(['error' => 'Falha na autenticação'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout()
    {
        Auth::logout();
    }

    public function show(User $user){

        if(!Auth::user()){
            return response()->json(array('error' => 'Usuário deve estar logado'), Response::HTTP_FORBIDDEN);
        }

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
                $user = new User();
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();
                Auth::login($user);
                return response($user->jsonSerialize(), Response::HTTP_CREATED);
            }catch(Exception $e){
                return response(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function update(Request $request, User $user)
    {
        if(Auth::user()->id == $user->id){
            $return = $user->update(
                $request->all()
            );
        }

        if(isset($return)){
            return response(json_encode($return), Response::HTTP_OK);
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
