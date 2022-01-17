@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.taskManagement.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.tasks.update", [$tasks->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
 
            <div class="form-group {{ $errors->has('users') ? 'has-error' : '' }}">
                <label for="assign_to">{{ trans('cruds.taskManagement.fields.assign_to') }}
                     </label>
                <select name="assign_to" id="assign_to" class="form-control">
                    <option value=""  >Select</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ isset($tasks->assignTo->id) && ($tasks->assignTo->id == $user->id) ? 'selected' : '' }} >{{ $user->name }}</option>
                    @endforeach
                </select>                 
                <p class="helper-block">
                    {{ trans('cruds.taskManagement.fields.assign_to_helper') }}
                </p>
            </div>

            <div class="form-group">
                  <label>Start Date & End Date</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-clock"></i></span>
                    </div>
                    <input type="text" value="{{ $tasks->start_end_date }}" class="form-control float-right" id="start_end_date" name="start_end_date">
                  </div>
                  <!-- /.input group -->
                </div>

            <div class="form-group">
                <label for="status">{{ trans('cruds.taskManagement.fields.status') }}
                     </label>
                <select name="status" id="status" class="form-control">
                    <option value="0" {{ isset($tasks->status) && ($tasks->status == 0) ? 'selected' : '' }}>Todo</option>
                    <option value="1" {{ isset($tasks->status) && ($tasks->status == 1) ? 'selected' : '' }}>In-Progress</option>
                    <option value="2" {{ isset($tasks->status) && ($tasks->status == 2) ? 'selected' : '' }}>N/A</option>
                    <option value="3" {{ isset($tasks->status) && ($tasks->status == 3) ? 'selected' : '' }}>Completed</option>
                    <option value="4" {{ isset($tasks->status) && ($tasks->status == 4) ? 'selected' : '' }}>Reopen</option>
                </select>
                 
                <p class="helper-block">
                    {{ trans('cruds.taskManagement.fields.status_helper') }}
                </p>
            </div>

            <div class="form-group ">
                <label for="comment">{{ trans('cruds.taskManagement.fields.comment') }}</label>
                <textarea id="name" name="comment" class="form-control"></textarea>
                 
                <p class="helper-block">
                    {{ trans('cruds.taskManagement.fields.comment_helper') }}
                </p>
            </div>

            <div class="form-group"> 
                <label for="customFile">Upload Files</label>
                <input type="file" multiple class="form-control" id="task_docs" name="task_docs[]">
            </div>
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

    $('#start_end_date').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })  
  });
</script>
@endsection