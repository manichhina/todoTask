@extends('layouts.admin')
@section('content')
@can('task_add')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.tasks.create") }}">
            {{ trans('global.add') }} {{ trans('cruds.taskManagement.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taskManagement.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-taskManagement">
                <thead>
                    <tr> 
                        <th>
                            {{ trans('cruds.taskManagement.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.taskManagement.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.taskManagement.fields.description') }}
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $key => $task)
                        <tr data-entry-id="{{ $task->id }}"> 
                            <td>
                                {{ $task->id ?? '' }}
                            </td>
                            <td>
                                {{ $task->title ?? '' }}
                            </td>
                            <td>
                               {{ $task->description ?? '' }}
                            </td>
                            <td>                                
                                @if($task->status == 1)
                                In-Progress
                                @elseif($task->status == 2)
                                    N/A
                                @elseif($task->status == 3)
                                    Completed
                                @elseif($task->status == 4)
                                    Reopen
                                @else
                                    Todo
                                @endif                                 
                            </td>
                            <td>
                                @can('task_view')
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.tasks.show', $task->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                                @endcan
                                @can('task_update')
                                <a class="btn btn-xs btn-info" href="{{ route('admin.tasks.edit', $task->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                                @endcan
                                @can('task_delete')
                                <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
 <script>
  $(function () {
    $(".datatable").DataTable();
    
  });
</script>
@endsection