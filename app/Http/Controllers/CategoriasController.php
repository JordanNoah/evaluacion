<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CategoriasController extends Controller
{
    public function index(){
        $categories = Categories::all();
        return response()->json($categories);
    }

    public function store(Request $request){
        $allowedStatuses = implode(',', Categories::getAllowedStatuses());

        $data = $request->all();

        $validator = Validator::make($data,[
            'name' => 'required|string',
            'status' => 'required|in:' . $allowedStatuses
        ]);

        if ($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }

        $category = new Categories();
        $category->name = $data['name'];
        $category->status = $data['status'];

        $category->save();

        return response()->json($category, ResponseAlias::HTTP_CREATED);
    }

    public function update(Request $request,$id){
        $category = Categories::find($id);

        if (!$category){
            return response()->json(['message' => 'Category not found'], ResponseAlias::HTTP_NOT_FOUND);
        }

        $category->update($request->all());

        return response()->json($category);
    }

    public function destroy($id){
        $category = Categories::find($id);

        if (!$category){
            return response()->json(['message' => 'Category not found'], ResponseAlias::HTTP_NOT_FOUND);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }

    public function show($id){
        $category = Categories::find($id);

        if (!$category){
            return response()->json(['message' => 'Category not found'], ResponseAlias::HTTP_NOT_FOUND);
        }

        return response()->json($category);
    }
}
