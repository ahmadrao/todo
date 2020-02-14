@csrf
<div class="form-group">
    <label for="todo-title">Todo Title</label>
    <input type="text" name="title" value="{{ old('title', $todo->title) }}" id="todo-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

    @if ($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="todo-body">Description</label>
    <textarea name="body" id="todo-body" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">{{ old('body', $todo->body) }}</textarea>
    @if ($errors->has('body'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('body') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg"> {{ $buttonText }} </button>
</div>
