<div class="media post">

        <div class="media-body" >
            <div class="d-flex align-items-center">
                    <h3 class="mt-0">
                        <a href="{{ $todo->url }}">{{ $todo->title }}</a>
                    </h3>
                    <div class="ml-auto">
                        @auth
                            @if(\Auth::user()->can('update-todo', $todo))
                                <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                            @endif
                            @if(\Auth::user()->can('delete-todo', $todo))
                                <form class="form-delete" method="post" action="{{ route('todo.destroy',  $todo->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>
            </div>

            <p class="lead">Created 
            <small class="text-muted">{{ $todo->created_date }}</small>
            </p>
            <div class="excerpt">
                {{ $todo->excerpt(250) }}
            </div>
        </div>
    </div>
