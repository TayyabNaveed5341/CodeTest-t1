<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    //

    public function index(Request $r){
        $v = $r->validate([// no need to write a form request for something like this
            'project-id'=>'integer|exists:projects,id'
        ]);

        $clauses = [];
        if(array_key_exists('project-id', $v))  $clauses[] = ['project_id', $v['project-id']];

        return response()->json([
            'status'=>'success',
            'message'=>'Tasks Retreived',
            'html'=>View::make('partials.task-list-items',[
                'tasks'=>Task::where($clauses)->get()
            ])->render()
        ]);
    }

    public function update(Task $task, Request $r){
        $v = $r->validate([
            'project_id'=>['required', 'exists:projects,id'],
            'name'=>[
                'required',
                Rule::unique('tasks')->where(function($q)use($r){
                    return $q->where('project_id',$r->project_id);
                })->ignore($task->id)
            ]
        ],[
            'name.unique'=>"Task with same name already exists in selected Project"
        ]);

        $task->name=$v['name'];
        $task->project_id=$v['project_id'];
        $task->save();

        $res['status'] = "success";
        $res['message'] = "Task details updated";
        $res['data'] = [
            'taskName'=>$task->name,
            'html'=>View::make('partials.task-list-item',['task'=>$task])->render()
        ];
        return $res;
    }

    public function updatePriority(Request $r){
        $v = $r->validate([
            'id'=>['required','array'],
            'id.*'=>['integer']
        ]);
        foreach($v['id'] as $priority => $id){
            Task::where('id', $id)->update(['priority'=>$priority]);
        }
        
        $res = [];
        $res['status'] = "success";
        $res['message'] = "Tast Priority Updated";
        return $res;
    }

    public function destroy(Task $task){
        $res = [];
        $res['status'] = "success";
        $res['message'] = "Deleted Successfully";
        $res['data'] = $task->delete();
        return $res;

    }
}
