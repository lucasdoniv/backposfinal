<?php

namespace App\Http\Controllers;

use App\Models\ModelAuto;
use Illuminate\Http\Request;
use Validator;

class ModelsController extends Controller
{
    public function getModels()
    {
        $models = ModelAuto::join('brand', 'model_autos.id_brand', '=', 'brand.id_brand')->orderBy('name_model', 'ASC')
            ->get(['model_autos.*', 'brand.name_brand']);

        return $models;
    }

    private $rulesModel = array(
        'name_model' => 'required||max:45',
        'id_brand' => 'required|exists:brand,id_brand',
    );

    public function addModel(Request $request)
    {


        $validator = Validator::make($request->all(), $this->rulesModel);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors(),
            ], 400);
        }

        $modelAuto = ModelAuto::create([
            'name_model' => $request->input('name_model'),
            'id_brand' => $request->input('id_brand'),
        ]);

        return $modelAuto;
    }

    public function show(ModelAuto $modelAuto)
    {
        return $modelAuto;
    }

    public function update(Request $request, ModelAuto $modelAuto)
    {

        $validator = Validator::make($request->all(), $this->rulesModel);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors(),
            ], 400);
        }


        $modelAuto->name_model = $request->input('name_model');
        $modelAuto->id_brand = $request->input('id_brand');

        $modelAuto->save();

        return $modelAuto;
    }

    public function destroy(ModelAuto $modelAuto)
    {
        $modelAuto->delete();
        return response()->json(['success' => true]);
    }
}
