@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Todo</h2>
                        <div class="ml-auto">
                        <a href="{{ route('todo.create') }}" class="btn btn-outline-secondary">Add todo</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include ('layouts._messages')
                    @forelse ($todos as $todo)
                        @include('_excerpt')
                        <hr>
                    @empty
                        <div class="alert alert-warning">
                            <strong>Sorry</strong> There are no todo available.
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
