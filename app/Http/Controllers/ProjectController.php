<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    //
    public function destroy(Project $project){
        $res=[];
        try{
            $project->tasks()->delete();
            $res['status'] = "success";
            $res['message'] = "Deleted Successfully";
            $res['data'] = $project->delete();
        }catch(\Exception $e){
            $res['status'] = "error";
            $res['message'] = "There was an error";
            $res['data'] = [];
        }
        return $res;

    }

    public function update(Project $project, Request $r){
        $v = $r->validate([
            'name'=>['required',Rule::unique('projects')->ignore($project->id)]
        ],[
            'name.unique'=>"Project with same name already exists"
        ]);

        $project->name=$v['name'];
        $project->save();

        $res['status'] = "success";
        $res['message'] = "Project details updated";
        $res['data'] = [
            'projectName'=>$project->name,
            'html'=>View::make('partials.project-list-items',['project'=>$project])->render()
        ];
        return $res;
    }
}
