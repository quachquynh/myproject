<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Validator;
use DB;

class Posts extends Controller
{
    public function index()
    {
        $data = DB::table('blogs')->get();
        var_dump($data);
    }

    public function show($id)
    {
        $data = Blog::all();
        return response([ 'data' => Blog::collection($data), 'message' => 'Retrieved successfully'], 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'detail' => 'required|max:255'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $result = Blog::create($data);
        return response()->json(['result' => $result], 200);
    }

    public function update(Request $request, $id)
    {
        $data = Blog::find($id);
        $data->name = $request->name;
        $data->detail = $request->detail;
        $data->save();
        return response($data, 200);
    }

    public function destroy($id)
    {
        Blog::where('id',$id)->delete();
        return response(['message' => 'Deleted']);
    }
 
}