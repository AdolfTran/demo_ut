@extends('layouts.main')
@section('title')
    <title>カテゴリ期間別UU数</title>
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
                    <div class="col-lg-4"><h4><b>カテゴリ期間別UU数</b></h4></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div id="main-contests" class="main-contests col-xs-12">
            <div id="table_category"></div>
        </div>
    </div>
@stop
@section('script')
    <script type='text/javascript' src="{{{ url('') }}}/webix/codebase/webix.js"></script>
    <script type="text/javascript" charset="utf-8">
        var count = <?php echo json_encode($count); ?>;
        webix.ready(function(){
            grida = webix.ui({
                container:"table_category",
                view:"treetable",
                columns:[
                    { id:"category_id",	header:"ID", width:70, css:{"text-align":"right"}, sort:"int"},
                    { id:"name",	header:["カテゴリ名",{content:"textFilter"}],	width:400,
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
                on: {
                    onBeforeLoad:function(){
                        this.showOverlay("Loading data ...");
                    },
                    onAfterLoad:function(){
                        this.hideOverlay();
                    },
                    onAfterRender:function(){
                        var count = this.count() < 3 ? 3 : this.count();
                        this.$view.style.height = String(count * 25 + 52) + "px";
                    }
                },
                width:1260,
                height: count*25 + 52,
                rowHeight: 25,
                headerRowHeight: 25,
                url: '/category/getDataCategory'
            });
        });
    </script>
@stop