{{--[
    "modalId"
    "modalTitle"
    "actionBtn"=>[
        "text",
        "class"
    ]
]--}}
<div class="modal fade" id="{{$modalId}}" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">{{$modalTitle}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <label for="task-name" class="col-form-label"></label>
                    <input class="form-control task-name-input" placeholder="Task Name" type="text" />
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
@push('scripts')
    <script>
        
    </script>
@endpush