<div
    class="
        @if(isset($loop) && $loop->first)
            active
        @endif
        align-items-center
        d-flex
        justify-content-between
        list-group-item
        list-group-item-action
        project-list-item
    "
    
    data-project-id="{{$project->id}}"
>
    <span class="me-auto project-name">{{$project->name}}</span>
    <button
        title="Rename Project"
        
        data-bs-target="#projectUpdateModal"
        data-bs-toggle="modal"
        type="button"
        class="action-rename btn btn-sm ms-2"
    ><i class="bi bi-pencil-square"></i></button>
    <button title="Delete Project" type="button" class="action-delete btn btn-sm">X</button>
</div>

