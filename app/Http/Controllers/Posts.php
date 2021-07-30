<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Blog;
use Validator;
use DB;
use Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 

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
        $data = new Blog;
        $data->name = Request::get('name');
        $data->detail = Request::get('detail');
        $data->save();
        $token = $data->createToken('APIToken')->accessToken;
        return response()->json(['token' => $token], 200);
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