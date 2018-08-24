@extends('layouts.main')
@section('title')
    <title>ユーザー一覧</title>
@stop

@section('content')
    <div class="row">
        <!-- メインコンテンツ -->
        <div id="main-contests" class="main-contests col-xs-12">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-4"><h4><b>ユーザー一覧</b></h4></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        {{ Form::open(array('url'=>"user", 'method' => 'GET', 'files'=>true, 'style' => 'display:block;')) }}
                        <div class="input-group">
                            @if (isset($inputs['keyword']))
                                {{ Form::text('keyword', $inputs['keyword'] ,array('id'=>'myInput','placeholder'=>trans('user.keyword'))) }}
                            @else
                                {{ Form::text('keyword', \Input::old('keyword') ,array('id'=>'myInput','placeholder'=>trans('user.keyword'))) }}
                            @endif
                            <div class="input-group-btn">
                                <div class="dropdown">
                                    <select name="option" class="form-control" id="dropdown-search"
                                            onchange="this.form.submit()">
                                        <option disabled selected value> {!! trans('user.search_item') !!}</option>
                                        <option value="0">{!! trans('user.all_item') !!}</option>
                                        <option value="1">{!! trans('user.email') !!}</option>
                                        <option value="2">氏名 </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            @if (Session::has('message'))
                <div class="text-center center-block alert alert-success">
                    {{{ Session::get('message') }}}
                </div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    <div class="span-right">ユーザー数： {{ count($users) }}人</div>
                    <div>
                        {{ Form::open(['url' => "user/export", 'method' => 'POST']) }}
                        <button type="submit"
                                class="btn btn-default text-left btn-create">{!! trans('user.export') !!}</button>
                        @if (isset($keyword) && isset($option))
                            <input type="hidden" name="keyword" value="{!! $keyword !!}">
                            <input type="hidden" name="option" value="{{$option}}">
                        @endif
                        {{ Form::close() }}
                    </div>
                </div>
                <div class="col-md-5">
                </div>
                <div class="col-md-3">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <a type="button" class="btn btn-default btn-create" href="{{ url('') }}/user/create">
                            {!! trans('user.sign_up') !!}
                        </a>
                    </div>
                </div>
            </div>

            @if(empty($users))
                <div class="alert alert-info" role="alert">{!! trans('user.not_registered') !!}</div>
            @else
                <table class="table" id="myTable" style="white-space: nowrap;">
                    <thead>
                    <tr>
                        <th width="170">{!! trans('user.role') !!} <i onclick="sortTable(0)" class='fa fa-fw fa-sort'></i></th>
                        <th width="400">{!! trans('user.email') !!} <i onclick="sortTable(1)" class='fa fa-fw fa-sort'></i></th>
                        <th width="250">氏名 <i onclick="sortTable(2)" class='fa fa-fw fa-sort'></i></th>
                        <th width="200"></th>
                        <th></th>
                        <th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ !empty($roles) && $roles[$user->manage_role_id] ? $roles[$user->manage_role_id] : '' }}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->user_last_name}} {{$user->user_first_name}}</td>
                                <td></td>
                                <td>
                                    <button style="margin-right:15px" type="button" class="btn btn-default btn-create updateBtn" data-id="{{{$user->id}}}">
                                        {!! trans('user.edit') !!}
                                    </button>
                                </td>
                                <td>
                                    @if($user->id != Auth::user()->id && $user->manage_role_id != App\Models\ManageRole::ROLE_ADMIN)
                                        <button type="button" class="btn btn-default btn-create deleteBtn" data-toggle="modal"
                                                data-target="#deleteModal" data-targetid="{{{$user->id}}}"
                                                data-targetname="{{{ $user->email }}}">{!! trans('user.delete') !!}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <!-- 更新用フォーム -->
    {{ Form::open(['url' => "/user/edit", 'method' => 'POST', 'id'=>'updateForm']) }}
    <input type="hidden" id="updateId" name="manage_user_id" value="">
    {{ Form::close() }}

    <!-- 削除用用フォーム -->
    {{ Form::open(['url' => "/user/delete", 'method' => 'POST', 'id'=>'deleteForm']) }}
    <input type="hidden" id="deleteId" name="manage_user_id" value="">
    {{ Form::close() }}
@stop

@section('modal')
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <br>
                    <p class="message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('user.cancel_modal') !!}</button>
                    <button type="button" class="btn btn-primary">{!! trans('user.delete_confirm') !!}</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type='text/javascript' src="{{{ url('') }}}/js/user/listuser.js"></script>
@stop
