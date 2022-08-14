<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Mockery\Undefined;
use Validator;
use Laravel\Sanctum\PersonalAccessToken;
use DB;

class CarsController extends Controller
{

    public function getCars(Request $request)
    {
        $userId = 0;
        if ($request->bearerToken()!==null) {
            $token = PersonalAccessToken::findToken($request->bearerToken());
            $user = $token->tokenable;
            $userId = $user->id;
        }

        $userFavorites = DB::table('favorite')
                   ->where('id_user', $userId);


        $car = Car::join('model_autos', 'model_autos.id_model', '=', 'car.id_model')
            ->join('plataform', 'plataform.id_plataform', '=', 'car.id_plataform')
            ->join('color', 'color.id_color', '=', 'car.id_color')
            ->join('fuel', 'fuel.id_fuel', '=', 'car.id_fuel')
            ->join('motor', 'motor.id_motor', '=', 'car.id_motor')
            ->leftjoinSub($userFavorites, 'favorite', function ($join) {
                $join->on('favorite.id_car', '=', 'car.id_car');
            })
            ->get(['car.*', 'model_autos.name_model', 'plataform.name_plataform', 'motor.name_motor', 'fuel.name_fuel', 'color.name_color','favorite.id_favorite']);



        if ($request->filled('id_model')) {
            $car = $car->where('id_model', '=', $request->input('id_model'));
        }
        return $car;
    }

    private $rulesModel = array(
        'id_model' => 'required',
        'id_plataform' => 'required|exists:plataform,id_plataform',
        'url_car' => 'required||max:256',
        'price' => 'required',
        'km' => 'required',
        'year' => 'required',
        'id_color' => 'required|exists:color,id_color',
        'id_fuel' => 'required|exists:fuel,id_fuel',
        'id_motor' => 'required|exists:motor,id_motor',
        'url_picture' => 'required||max:256'
    );

    public function addCar(Request $request)
    {


        $validator = Validator::make($request->all(), $this->rulesModel);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors(),
            ], 400);
        }

        $car = Car::create([
            'id_model' => $request->input('id_model'),
            'id_plataform' => $request->input('id_plataform'),
            'url_car' => $request->input('url_car'),
            'price' => $request->input('price'),
            'km' => $request->input('km'),
            'year' => $request->input('year'),
            'id_color' => $request->input('id_color'),
            'id_fuel' => $request->input('id_fuel'),
            'id_motor' => $request->input('id_motor'),
            'url_picture' => $request->input('url_picture'),
        ]);

        return $car;
    }

    public function show(Car $car)
    {
        return $car;
    }

    public function update(Request $request, Car $car)
    {

        $validator = Validator::make($request->all(), $this->rulesModel);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors(),
            ], 400);
        }

        $car->id_model = $request->input('id_model');
        $car->id_plataform = $request->input('id_plataform');
        $car->url_car = $request->input('url_car');
        $car->price = $request->input('price');
        $car->km = $request->input('km');
        $car->year = $request->input('year');
        $car->id_color = $request->input('id_color');
        $car->id_fuel = $request->input('id_fuel');
        $car->id_motor = $request->input('id_motor');
        $car->url_picture = $request->input('url_picture');
        $car->save();

        return $car;
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return response()->json(['success' => true]);
    }
}
