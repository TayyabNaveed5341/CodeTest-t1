<li class="align-items-center d-flex list-group-item task-list-item" data-id="{{$task->id}}">
    <i class="bi bi-arrows-expand cursor-move handle"></i>
    <span class="me-auto ms-2 task-name">{{$task->name}}</span>
    <button
        title="Rename Task"
        
        data-bs-target="#taskUpdateModal"
        data-bs-toggle="modal"
        type="button"
        class="action-rename btn btn-sm ms-2"
    ><i class="bi bi-pencil-square"></i></button>
    <button title="Delete Project" type="button" class="action-delete btn btn-sm">X</button>
</li>
