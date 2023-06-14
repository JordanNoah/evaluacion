<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Materials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MaterialesController extends Controller
{
    public function index(){
        $material = Materials::all();
        return response()->json($material);
    }

    public function store(Request $request){
        $allowedStatuses = implode(',', Materials::getAllowedStatuses());

        $data = $request->all();

        $validator = Validator::make($data,[
            'status' => 'required|in:' . $allowedStatuses,
            'name' => 'required|string',
            'description' => 'nullable|string',
            'min_stock' => 'required|integer',
            'category' => 'required|string'
        ]);

        if ($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }

        $category = Categories::find($data['category']);

        if(!$category){
            return response()->json(['message' => 'Category not found'], ResponseAlias::HTTP_NOT_FOUND);
        }

        $materials = new Materials();
        $materials->status = $data['status'];
        $materials->name = $data['name'];
        $materials->description = $data['description'];
        $materials->min_stock = $data['min_stock'];
        $materials->category_id = $data['category'];

        $materials->save();

        return response()->json($materials,ResponseAlias::HTTP_CREATED);
    }

    public function update(Request $request,$id){
        $material = Materials::find($id);

        if (!$material){
            return response()->json(['message' => 'Material not found'], ResponseAlias::HTTP_NOT_FOUND);
        }

        $material->update($request->all());

        return response()->json($material);
    }

    public function destroy($id){
        $material = Materials::find($id);

        if (!$material){
            return response()->json(['message' => 'Material not found'], ResponseAlias::HTTP_NOT_FOUND);
        }

        $material->delete();

        return response()->json(['message' => 'Material deleted']);
    }

    public function show($id){
        $material = Materials::find($id);

        if(!$material){
            return response()->json(['message' => 'Material not found']);
        }

        return response()->json($material);
    }
}
