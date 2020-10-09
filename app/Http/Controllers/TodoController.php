<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Resources\TodoResource;
class TodoController extends Controller
{
    public function index(){
    	$todos=Todo::orderBy('created_at','desc')->get();
    	return TodoResource::collection($todos);
    }


    public function store(Request $request){

    	$todo=Todo::create([
    			'text'=>$request->text,
    			'done'=>0
    	]);
    	return $todo;
    }

    public function delete($id){
    	Todo::destroy($id);
    	return 'success';

    }

    public function changeDoneStatus($id){
    	$todo=Todo::find($id);
    	if($todo->done==1){
    		$update=0;
    	}else{
    		$update=1;
    	}

    	$todo->update([
    		'done'=>$update
    	]);
    	return $todo;
    }


}
