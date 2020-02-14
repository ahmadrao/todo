@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Create Todo</h2>
                        <div class="ml-auto">
                        <a href="{{ route('todo.index') }}" class="btn btn-outline-secondary">Back to all Todos</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                   <form action="{{ route('todo.store') }}" method="post">
                    @include("_form", ['buttonText' => "Add"])
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
