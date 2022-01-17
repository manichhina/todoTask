@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.taskManagement.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.tasks.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.taskManagement.fields.title') }}*</label>
                <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($tasks->title) ? $tasks->title : '') }}" required>
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.taskManagement.fields.title_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.taskManagement.fields.description') }}*</label>
                <textarea id="name" name="description" required class="form-control">{{ old('description', isset($tasks->description) ? $tasks->description : '') }}</textarea>
                
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.taskManagement.fields.title_helper') }}
                </p>
            </div>
            @can('task_assign')
            <div class="form-group {{ $errors->has('users') ? 'has-error' : '' }}">
                <label for="assign_to">{{ trans('cruds.taskManagement.fields.assign_to') }}
                     </label>
                <select name="assign_to" id="assign_to" class="form-control">
                    <option value=""  >Select</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"  >{{ $user->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('assign_to'))
                    <em class="invalid-feedback">
                        {{ $errors->first('assign_to') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.taskManagement.fields.assign_to_helper') }}
                </p>
            </div>
            @endcan
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>


@endsection
@section('scripts')
@parent
 <script>
  $(function () {
    $('.select2').select2();    
  });
</script>
@endsection