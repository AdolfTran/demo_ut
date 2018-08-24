<nav class="navbar navbar-menu navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            @foreach($items as $item)
                <li @if($item->prefix == Request::route()->getPrefix()) class="active" @endif>
                    <a href="{{$item->url}}"><span class="glyphicon glyphicon-{{$item->icon}}"></span> {{$item->title}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>