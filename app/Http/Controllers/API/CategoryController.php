<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        if ($category->isEmpty()) {
            $response['message'] = 'Tidak ada Pemesanan yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        $response['success'] = true;
        $response['message'] = 'Category ditemukan.';
        $response['data'] = $category;
        return response()->json($response, Response::HTTP_OK);
        // atau
        // return response()->json($response, 200);
    }
    public function store(Request $request)
{
    $validate = $request->validate([
        'name' => 'required',
            'singkatan' => 'required',
            'harga' => 'required'
    ]);

    $category = Category::create($validate);
    if($category){
        $response['success'] = true;
        $response['message'] = 'Category berhasil ditambahkan.';
        return response()->json($response, Response::HTTP_CREATED);
    }
}
public function update(Request $request, $id)
{
    $validate = $request->validate([
        'name' => 'required',
            'singkatan' => 'required',
            'harga' => 'required'
    ]);

    Category::where('id', $id)->update($validate);
    $response['success'] = true;
    $response['message'] = 'Pemesanan berhasil diperbarui.';
    return response()->json($response, Response::HTTP_OK);
}
public function destroy($id)
{
    $category = Category::where('id', $id);
    if(count($category->get())){
        $category->delete();
        $response['success'] = true;
        $response['message'] = 'Category berhasil dihapus.';
        return response()->json($response, Response::HTTP_OK);
    } else {
        $response['success'] = false;
        $response['message'] = 'CAtegory tidak ditemukan.';
        return response()->json($response, Response::HTTP_NOT_FOUND);
    } 
}
}