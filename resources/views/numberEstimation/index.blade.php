@extends('layouts.main')
@section('title')
    <title>UU数見積もり</title>
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
                <div class="col-lg-4"><h4><b>UU数見積もり</b></h4></div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="main-contents" class="main-contests col-xs-12">
            <div class="col-xs-12 form-category-top">
                <div class="form-group col-sm-12 form-group-custom">
                    <div class="alert alert-danger col-sm-6 alert-danger-custom hidden">
                    </div>
                </div>
                <div class="form-group col-sm-12 form-group-custom">
                    <div class="form-group col-sm-2 form-group-custom">
                        <input type="tel" class="col-sm-4 input_category_bottom" id="input_category_date">
                        <label class="col-sm-1 label_category_date"> 日</label>
                    </div>
                    <div class="form-group col-sm-1 form-group-custom">
                        <button class="btn btn-orange btn-custom-category" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading..." id="call_api_category"> 見積もり</button>
                    </div>
                    <div class="form-group col-sm-2 form-group-custom">
                    </div>
                    <div class="form-group col-sm-3 form-group-custom">
                        <label class="col-sm-5 label_category_bottom label_custom"> ユーザー数</label>
                        <input type="text" class="col-sm-7 input_category_bottom" readonly id="category_number">
                    </div>
                    <div class="form-group col-sm-3 div_right_category form-group-custom">
                        <label class="col-sm-5 label_category_bottom label_custom"> 見積もり日時</label>
                        <input type="text" class="col-sm-7 input_category_bottom" readonly id="category_date">
                    </div>
                </div>
                <div class="form-group col-sm-12 form-group-custom">
                    <div class="form-group col-sm-8 form-group-custom">
                        <button class="btn btn-custom-table btn-custom-table-selected" value="category"> カテゴリ</button>
                        <button class="btn btn-custom-table" value="segment"> ウェブセグメント</button>
                    </div>
                </div>
            </div>
            <div id="table_contents_category"></div>
            <div id="table_contents_segment" class="table_hidden"></div>
        </div>
    </div>
@stop
@section('script')
    <script type='text/javascript' src="{{{ url('') }}}/webix/codebase/webix.js"></script>
    <script type="text/javascript" charset="utf-8">
        var count = <?php echo json_encode($count); ?>;
        var grida, gridb;
        webix.ready(function(){
            grida = webix.ui({
                container:"table_contents_category",
                view:"treetable",
                id: 'category_webix',
                width:1260,
                scroll: false,
                height: count*25 + 52,

                columns:[
                    { id:"category_id",	header:"ID", width:70, css:{"text-align":"right"}, sort:"int"},
                    { id:"name",	header:["カテゴリ/セグメント名",{content:"textFilter"}], width:400,
                        template:"{common.space()}{common.icon()}{common.treecheckbox()}#name#", sort:"string" },
                    { id:"uu30",	header:"30日UU数",	width:100, css:{"text-align":"right"}, sort:"int", format:webix.i18n.intFormat},
                    { id:"uu60",	header:"60日UU数",	width:100, css:{"text-align":"right"}, sort:"int",  format:webix.i18n.intFormat},
                    { id:"uu90",	header:"90日UU数",	width:100, css:{"text-align":"right"}, sort:"int",  format:webix.i18n.intFormat},
                    { id:"uu120",	header:"120日UU数",	width:100, css:{"text-align":"right"}, sort:"int",  format:webix.i18n.intFormat},
                    { id:"uu150",	header:"150日UU数",	width:100, css:{"text-align":"right"}, sort:"int",  format:webix.i18n.intFormat},
                    { id:"uu180",	header:"180日UU数",	width:100, css:{"text-align":"right"}, sort:"int",  format:webix.i18n.intFormat},
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
                threeState: true,
                rowHeight: 25,
                headerRowHeight: 25,
                url: '/category/getDataCategory'
            });

            gridb = webix.ui({
                container:"table_contents_segment",
                view:"treetable",
                columns:[
                    { id:"segment_id",	header:"ID", width:70, css:{"text-align":"right"}, sort:"int"},
                    { id:"name",	header:["カテゴリ/セグメント名",{content:"textFilter"}],	width:400,
                        template:"{common.space()}{common.icon()}{common.treecheckbox()}#name#", sort:"string" },
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
                url: '/segment/getDataSegment'
            });
        });
        $('#call_api_category').on('click', function(){
            var apiData = getDataForApi();
            // call Api
            var token = $('[name="csrf-token"]').attr('content');
            $(this).button('loading');
            if(apiData.category == '' && apiData.segment == ''){
                $('.alert-danger-custom').html("カテゴリ/セグメントが選択されていません。");
                $('.alert-danger-custom').removeClass('hidden');
                setTimeout(function(){
                    $('.alert-danger-custom').addClass('hidden');
                }, 3000);
                $('#call_api_category').button('reset');
                return false;
            } else if(apiData.date <= 0 || apiData.date > 180 || isNaN(apiData.date)){
                $('.alert-danger-custom').html("見積もり日数は、1〜180日を指定してください。");
                $('.alert-danger-custom').removeClass('hidden');
                setTimeout(function(){
                    $('.alert-danger-custom').addClass('hidden');
                }, 3000);
                $('#call_api_category').button('reset');
                return false;
            }

            $.ajax({
                url: '/callApi',
                type: 'post',
                dataType: 'json',
                data: {
                    _token: token,
                    catid: apiData.category,
                    secid: apiData.segment,
                    period: apiData.date
                },
                success: function(data){
                    if(data['status'] == 'success'){
                        $('#category_number').val(number_format(data['uu']));
                        $('#category_date').val(data['datetime']);
                    } else {
                        $('.alert-danger-custom').html("<strong>ERROR! </strong>" + data['message']);
                        $('.alert-danger-custom').removeClass('hidden');
                        setTimeout(function(){
                            $('.alert-danger-custom').addClass('hidden');
                        }, 3000);
                    }
                    $('#call_api_category').button('reset');
                },
                error: function(){
                    $('#call_api_category').button('reset');
                }
            });
        });

        function getDataForApi(){
            var date = $('#input_category_date').val();
            var dataCategoryChecked = '';
            var dataSegmentChecked = '';
            var checked = grida.getChecked();
            checked.forEach(function(index){
                var category_id = grida.getItem(index).category_id;
                if(dataCategoryChecked == ''){
                    dataCategoryChecked += category_id;
                } else {
                    dataCategoryChecked += ',' + category_id;
                }
            });

            var checked = gridb.getChecked();
            checked.forEach(function(index){
                var segment_id = gridb.getItem(index).segment_id;
                if(dataSegmentChecked == ''){
                    dataSegmentChecked += segment_id;
                } else {
                    dataSegmentChecked += ',' + segment_id;
                }
            });
            var results = new Array();
            results['date'] = date;
            results['category'] = dataCategoryChecked;
            results['segment'] = dataSegmentChecked;
            return results;
        }

        $('.btn-custom-table').on('click', function(){
            var key = $(this).val();
            $('.btn-custom-table').removeClass('btn-custom-table-selected');
            $(this).addClass('btn-custom-table-selected');
            if(key == "segment"){
                $('#table_contents_segment').removeClass("table_hidden");
                $('#table_contents_category').addClass("table_hidden");
            } else {
                $('#table_contents_category').removeClass("table_hidden");
                $('#table_contents_segment').addClass("table_hidden");
            }
        });
        /*
        * number format function
        * input: n = 123    decimal = 2 => output: 123.00
        * input: n = 12345    decimal = 2 => output: 12,345.00
        *
        */
        function number_format(n, decimal) {
            return n.toFixed(decimal).replace(/./g, function(c, i, a) {
                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
            });
        }

    </script>
@stop