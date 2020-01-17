<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyStoreRequest;
use App\Property;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function propertyByUser(Request $request){
        $properties = DB::table('properties')->select()->where('user_id', $request->id_user)->get();
        return response()->json(['properties'=>$properties], 200);
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
            return response()->json(['error' => $valid->errors()], 400);
        }else{
            // return response()->json($request->all());
            $image = $request->get('photo');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('photo'))->save(public_path('images/').$name);
            $rent = new Property();
            $rent->title = $request->title;
            $rent->value = $request->value;
            $rent->description = $request->description;
            $rent->postal_code = $request->postal_code;
            $rent->city = $request->city;
            $rent->number = $request->number;
            $rent->street = $request->street;
            $rent->state = $request->state;
            $rent->user_id = $request->user_id;
            $rent->complement = $request->complement;
            $rent->photo = $name;
            $rent->save();
            return response($rent->jsonSerialize(), Response::HTTP_CREATED);
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
        if($property){
            return response($property->jsonSerialize(), Response::HTTP_OK);
        }else{
            return response()->json(["error" => "Imóvel não encontrado"], Response::HTTP_BAD_REQUEST);
        }
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
            return response()->json(["error" => "Não foi possível atualizar o imóvel"], Response::HTTP_BAD_REQUEST);
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
            return response($result, Response::HTTP_OK);
        }else{
            return response()->json(["error" => "Você deve ser o usuário dono da propriedade para excluí-la."],Response::HTTP_BAD_REQUEST);
        }
    }

    public function destaques(){
        $destaques = DB::table('properties')->select()->limit(3)->get();
        return response()->json(['destaques' => $destaques], Response::HTTP_OK);
    }
}
