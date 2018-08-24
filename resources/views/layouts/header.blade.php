<div class="navbar navbar-origin navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{!! url('') !!}/"><h3>AudienceOne UU数見積もりツール</h3></a>
        </div>
        <div class="collapse navbar-collapse">
            @if(Auth::check())
            <div class="navbar-info navbar-right">
                {{ Auth::user()->email }}
                &nbsp;
                ({{ Session::has('role_name') ? Session::get('role_name') : '' }})
                <button type="button" class="btn btn-default navbar-btn logout-btn"
                        onClick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="glyphicon glyphicon-user"></span> ログアウト
                </button>

                {{ Form::open(array('url' => URL::to('logout'),'id' => 'logout-form', 'method' => 'POST')) }}
                {{ csrf_field() }}
                {{ Form::close() }}
            </div>
            @endif
        </div>
    </div>
</div>