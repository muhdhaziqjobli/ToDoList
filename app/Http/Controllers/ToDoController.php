<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ToDo;

class ToDoController extends Controller
{
    public function show($id = 0)
    {
        if($id==0){ 
           $todos = ToDo::orderby('id','asc')->select('*')->get(); 
        }else{   
           $todos = ToDo::select('*')->where('id', $id)->get(); 
        }
        // Fetch all records
        $response['data'] = $todos;

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $todo = new ToDo();

        $todo->content = $request->content;

        $todo->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }

    public function destroy($id)
    {
        $todo = ToDo::find($id);
 
        $todo->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully'
            ]
        );
    }
}
