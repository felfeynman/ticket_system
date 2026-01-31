<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:categories,name'
        ]);

        return Category::create([
            'name' => $request->name,
            'created_by' => null,
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->tickets()->exists()) {
            return response()->json([
                'message' => 'Não é possível deletar categoria com chamados associados'
            ], 422);

        }

        $category->delete(); // banco impede se houver tickets

        return  response()->json(['message' => 'Categoria deletada']);
    }
}
