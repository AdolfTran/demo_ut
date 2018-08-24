@extends('layouts.main')
@section('title')
    <title>セグメント期間別UU数</title>
@stop
@section ('css')
    <link type="text/css" href="{{ url('') }}/webix/codebase/webix.css"  rel="stylesheet">
    <link type="text/css" href="{{ url('') }}/webix/codebase/webix_custom.css"  rel="stylesheet">
@show

@section('content')
    <div class="row">
        <!-- メインコンテンツ -->
        <div class="page-header">
            <div class="row">
                <div class="col-lg-4"><h4><b>セグメント期間別UU数</b></h4></div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="main-contests" class="main-contests col-xs-12">
            <div id="table_segment"></div>
        </div>
    </div>
@stop
@section('script')
    <script type='text/javascript' src="{{{ url('') }}}/webix/codebase/webix.js"></script>
    <script type="text/javascript" charset="utf-8">
        var dataSegment = <?php echo json_encode($dataSegment) ?>;
        webix.ready(function(){
            grida = webix.ui({
                container:"table_segment",
                view:"treetable",
                columns:[
                    { id:"segment_id",	header:"ID", width:70, css:{"text-align":"right"}, sort:"int"},
                    { id:"name",	header:["セグメント名",{content:"textFilter"}],	width:400,
                        template:"{common.space()}{common.icon()}#name#", sort:"string" },
                    { id:"uu30",	header:"30日UU数",	width:100, css:{"text-align":"right"}, sort:"int", format:webix.i18n.intFormat},
                    { id:"uu60",	header:"60日UU数",	width:100, css:{"text-align":"right"}, sort:"int", format:webix.i18n.intFormat},
                    { id:"uu90",	header:"90日UU数",	width:100, css:{"text-align":"right"}, sort:"int", format:webix.i18n.intFormat},
                    { id:"uu120",	header:"120日UU数",	width:100, css:{"text-align":"right"}, sort:"int", format:webix.i18n.intFormat},
                    { id:"uu150",	header:"150日UU数",	width:100, css:{"text-align":"right"}, sort:"int", format:webix.i18n.intFormat},
                    { id:"uu180",	header:"180日UU数",	width:100, css:{"text-align":"right"}, sort:"int", format:webix.i18n.intFormat},
                    { id:"import_datetime",	header:"連携日時",	width:170, css:{"text-align":"center"}, sort:"string"}
                ],
                filterMode:{
                    level:false,
                    showSubItems:false
                },
                autoheight:true,
                autowidth:true,
                rowHeight: 25,
                headerRowHeight: 25,
                data: dataSegment
            });
        });
    </script>
@stop