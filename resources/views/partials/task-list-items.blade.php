@foreach($tasks as $task)
    @include('partials.task-list-item',compact('task'))
@endforeach