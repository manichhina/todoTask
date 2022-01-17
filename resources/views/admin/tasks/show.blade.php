@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taskManagement.title_singular') }}
    </div>
    <!-- <pre>
    <?php 
    print_r($tasks->taskDocs);
    ?>
</pre> -->
 
    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taskManagement.fields.id') }}
                        </th>
                        <td>
                            {{ $tasks->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskManagement.fields.title') }}
                        </th>
                        <td>
                            {{ $tasks->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskManagement.fields.description') }}
                        </th>
                        <td>
                            {{ $tasks->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskManagement.fields.assignee') }}
                        </th>
                        <td>
                            {{ $tasks->assignedBy->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskManagement.fields.assign_to') }}
                        </th>
                        <td>
                            {{ isset($tasks->assignTo->name) ? $tasks->assignTo->name : 'Not Assigned' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taskManagement.fields.status') }}
                        </th>
                        <td>
                            @if($tasks->status == 1)
                                In-Progress
                            @elseif($tasks->status == 2)
                                N/A
                            @elseif($tasks->status == 3)
                                Completed
                            @elseif($tasks->status == 4)
                                Reopen
                            @else
                                Todo
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Start Date & End Date
                        </th>
                        <td>
                            {{ isset($tasks->start_end_date) ? $tasks->start_end_date : '--' }}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">
                            <h5><b>Documents</b></h5>
                        </th> 
                    </tr>
                    <tr>
                        <th colspan="2">
                            @foreach($tasks->taskDocs as $taskDocs)
                                <a href="{{ asset('uploads/'.$taskDocs->doc_path) }}" target="_blank" style="margin-right: 30px;">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            @endforeach
                        </th> 
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">
                            <h5><b>Comments</b></h5>
                        </th> 
                    </tr>
                    @foreach($tasks->taskComments as $taskComments)
                        <tr>
                            <td colspan="2">                                
                                <h5 class="label label-info label-many">
                                     {{ $taskComments->comment }}
                                </h5>
                                <p class="pull-right">
                                    <b>By : </b> {{ $taskComments->commentUser->name }} 
                                        <br>
                                    <b>Date : </b> {{ $taskComments->created_at }} 
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
     
</div> 
@endsection