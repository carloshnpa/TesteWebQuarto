<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyStoreRequest;
use App\Property;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Property::all()->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // TODO: create a custom Request
    function store(Request $request)
    {
        $validator = new PropertyStoreRequest();
        $valid = Validator::make($request->all(), $validator->rules(), $validator->messages());
        if($valid->fails()){
            return response(json_encode($valid->errors(), JSON_UNESCAPED_UNICODE), Response::HTTP_CONFLICT);
        }else{
            try{
                $rent = Property::create($request->all());
                return response($rent->jsonSerialize(), Response::HTTP_CREATED);
            }catch(Exception $e){
                return response(json_encode($e->getMessage()), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return response($property->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $return = $property->update(
            $request->all()
        );

        if($return){
            return response(json_encode($return), Response::HTTP_CREATED);
        }else{
            return response(json_encode(array("error" => array("message" => "Não foi possível atualizar o imóvel"))), Response::HTTP_BAD_REQUEST);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        if($property->user_id == Auth::id()){
            $result = $property->delete();
            if($result){
                return response($result, Response::HTTP_OK);
            }else{
                return response(json_encode(array("error" => array("message" => "Não foi possível excluir propriedade."))), Response::HTTP_BAD_REQUEST);
            }
        }else{
            return response(array("error" => array("message" => "Você deve ser o usuário dono da propriedade para excluí-la.")), Response::HTTP_FORBIDDEN);
        }


    }
}
