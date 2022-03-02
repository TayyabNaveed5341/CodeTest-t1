{{--[
    "modalId"
    "modalTitle"
    "actionBtn"=>[
        "text",
        "class"
        ]
]--}}
<div class="modal fade" id="{{$modalId}}" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">{{$modalTitle}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="project-name" class="col-form-label"></label>
                    <input type="text" class="form-control" id="project-name">
                    <span class="error text-danger"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="{{$actionBtn['class']}} btn btn-primary">{{$actionBtn['text']}}</button>
            </div>
        </div>
    </div>
</div>