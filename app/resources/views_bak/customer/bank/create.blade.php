@extends('layouts.master')

@section('title', '添加银行账户')
@section('customer', 'active')

@section('nav', '添加银行账户')
    @section('css_link')
        <link rel="stylesheet" href="http://bootstrap-chinese-region.coding.io/lib/bootstrap-chinese-region/bootstrap-chinese-region.css">
    @endsection

@section('content')
    <div class="col-md-2">
        @include('layouts.customer_menu')
    </div>
    <div class="col-md-10">

        <div class="panel panel-white">

            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active"><a href="#tab1" role="tab" data-toggle="tab" aria-expanded="true">基础信息</a></li>
                    <li role="presentation" class=""><a href="#tab2" role="tab" data-toggle="tab" aria-expanded="false">拓展信息</a></li>
                </ul>
                <!-- Tab panes -->
                <form action="" method="post" name="queryForm">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="tab-content">


                    <div role="tabpanel" class="tab-pane active" id="tab1">

                        <div class="row">

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="card_name">卡片名称</label>
                                    <input type="text" name="card_name" class="form-control" id="card_name"
                                           placeholder="请输入卡片名称">
                                    <br/>
                                    <label><span class="label account label-danger">公司账户</span> &nbsp; <span class="label account label-success">社保账户</span> &nbsp; <span class="label account label-primary">一般户</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="account">银行账户</label>
                                    <input type="text" name="account" class="form-control" id="account"
                                           placeholder="请输入银行账户">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="partner_type">账户所属行别</label>
                                    <select name="bank" id="bank" class="form-control m-b-sm">
                                        <option value="">--请选择--</option>
                                        <option value="中国工商银行">中国工商银行</option>
                                        <option value="中国农业银行">中国农业银行</option>
                                        <option value="中国银行">中国银行</option>
                                        <option value="中国建设银行">中国建设银行</option>
                                        <option value="国家开发银行">国家开发银行</option>
                                        <option value="交通银行">交通银行</option>
                                        <option value="中信银行">中信银行</option>
                                        <option value="中国光大银行">中国光大银行</option>
                                        <option value="华夏银行">华夏银行</option>
                                        <option value="中国民生银行">中国民生银行</option>
                                        <option value="广发银行">广发银行</option>
                                        <option value="平安银行">平安银行</option>
                                        <option value="招商银行">招商银行</option>
                                        <option value="兴业银行">兴业银行</option>
                                        <option value="上海浦东发展银行">上海浦东发展银行</option>
                                        <option value="中国进出口银行">中国进出口银行</option>
                                        <option value="中国农业发展银行">中国农业发展银行</option>
                                        <option value="城市商业银行">城市商业银行</option>
                                        <option value="农村商业银行">农村商业银行</option>
                                        <option value="恒丰银行">恒丰银行</option>
                                        <option value="农村合作银行">农村合作银行</option>
                                        <option value="渤海银行">渤海银行</option>
                                        <option value="徽商银行">徽商银行</option>
                                        <option value="村镇银行">村镇银行</option>
                                        <option value="重庆三峡银行">重庆三峡银行</option>
                                        <option value="上海农村商业银行">上海农村商业银行</option>
                                        <option value="城市信用社">城市信用社</option>
                                        <option value="农村信用联社">农村信用联社</option>
                                        <option value="中国邮政储蓄银行">中国邮政储蓄银行</option>
                                        <option value="香港上海汇丰银行">香港上海汇丰银行</option>
                                        <option value="东亚银行">东亚银行</option>
                                        <option value="南洋商业银行">南洋商业银行</option>
                                        <option value="恒生银行">恒生银行</option>
                                        <option value="中国银行（香港）">中国银行（香港）</option>
                                        <option value="集友银行">集友银行</option>
                                        <option value="星展银行（香港）">星展银行（香港）</option>
                                        <option value="永亨银行">永亨银行</option>
                                        <option value="美国花旗银行">美国花旗银行</option>
                                        <option value="美国银行">美国银行</option>
                                        <option value="美国摩根大通银行">美国摩根大通银行</option>
                                        <option value="日本三菱东京日联银行">日本三菱东京日联银行</option>
                                        <option value="日本日联银行">日本日联银行</option>
                                        <option value="日本三井住友银行">日本三井住友银行</option>
                                        <option value="日本瑞穗实业银行">日本瑞穗实业银行</option>
                                        <option value="日本山口银行">日本山口银行</option>
                                        <option value="韩国外换银行">韩国外换银行</option>
                                        <option value="韩国友利银行">韩国友利银行</option>
                                        <option value="韩国产业银行">韩国产业银行</option>
                                        <option value="新韩银行">新韩银行</option>
                                        <option value="国民银行">国民银行</option>
                                        <option value="韩国中小企业银行">韩国中小企业银行</option>
                                        <option value="华侨银行">华侨银行</option>
                                        <option value="大华银行">大华银行</option>
                                        <option value="新加坡星展银行">新加坡星展银行</option>
                                        <option value="奥地利中央合作银行">奥地利中央合作银行</option>
                                        <option value="比利时联合银行">比利时联合银行</option>
                                        <option value="荷兰银行">荷兰银行</option>
                                        <option value="荷兰商业银行">荷兰商业银行</option>
                                        <option value="渣打银行">渣打银行</option>
                                        <option value="法国兴业银行">法国兴业银行</option>
                                        <option value="法国巴黎银行">法国巴黎银行</option>
                                        <option value="法国东方汇理银行">法国东方汇理银行</option>
                                        <option value="德国德累斯登银行">德国德累斯登银行</option>
                                        <option value="德意志银行">德意志银行</option>
                                        <option value="德国商业银行">德国商业银行</option>
                                        <option value="德国西德银行">德国西德银行</option>
                                        <option value="德国巴伐利亚州银行">德国巴伐利亚州银行</option>
                                        <option value="瑞士信贷银行">瑞士信贷银行</option>
                                        <option value="加拿大蒙特利尔银行">加拿大蒙特利尔银行</option>
                                        <option value="澳大利亚和新西兰银行集团">澳大利亚和新西兰银行集团</option>
                                        <option value="德富泰银行">德富泰银行</option>
                                        <option value="厦门国际银行">厦门国际银行</option>
                                        <option value="法国巴黎银行（中国）">法国巴黎银行（中国）</option>
                                        <option value="华商银行">华商银行</option>
                                        <option value="青岛国际银行">青岛国际银行</option>
                                        <option value="华一银行">华一银行</option>
                                        <option value="中央结算公司">中央结算公司</option>
                                        <option value="银行间清算所">银行间清算所</option>

                                    </select>

                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">提交</button>



                    </div>


                    <div role="tabpanel" class="tab-pane" id="tab2">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">地区</label>
                                    <div class="bs-chinese-region flat dropdown" data-submit-type="id" data-min-level="1" data-max-level="3">
                                        <input type="text" class="form-control" name="address" id="address" placeholder="选择你的地区" data-toggle="dropdown" readonly="" value="">
                                        <div class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <div>
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li role="presentation" class="active"><a href="#province" data-next="city" role="tab" data-toggle="tab">省份</a></li>
                                                    <li role="presentation"><a href="#city" data-next="district" role="tab" data-toggle="tab">城市</a></li>
                                                    <li role="presentation"><a href="#district" data-next="street" role="tab" data-toggle="tab">县区</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="province">--</div>
                                                    <div role="tabpanel" class="tab-pane" id="city">--</div>
                                                    <div role="tabpanel" class="tab-pane" id="district">--</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="province_h" name="province">
                        <input type="hidden" id="city_h" name="city">
                        <input type="hidden" id="town_h" name="town">


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account">支行名称</label>
                                    <input type="text" name="bank_branch" class="form-control" id="bank_branch"
                                           placeholder="请输入支行名称">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="bank_url">银行网址</label>
                                    <input type="text" name="bank_url" class="form-control" id="bank_url"
                                           placeholder="请输入银行网址">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="bank_address">网点详细地址</label>
                                    <input type="text" name="bank_address" class="form-control" id="bank_address"
                                           placeholder="请输入网点详细地址">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="certificate_number">备注</label>
                                    <textarea class="form-control input-lg" rows="3" name="remarks" id="remarks"></textarea>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
    <script type="text/javascript" src="http://bootstrap-chinese-region.coding.io/lib/bootstrap-chinese-region/bootstrap-chinese-region.js"></script  >
    <script type="text/javascript">
        $(document).ready(function () {

            $('.account').click(function(){
                var account = $(this).html();
                $('#card_name').val(account);
            });


            $('#bank').change(function(){
                var bank = this.value;

                var json_list = {
                    '中国工商银行': 'http://www.icbc.com',
                    '中国农业银行': 'http://www.abcchina.com',
                    '中国银行': 'http://www.boc.cn',
                    '中国建设银行': 'http://www.ccb.com',
                    '国家开发银行': 'http://www.cdb.com.cn/web/',
                            '国家开发银行': 'http://www.cdb.com.cn',
                            '中国进出口银行': 'http://www.eximbank.gov.cn',
                            '中国农业发展银行': 'http://www.adbc.com.cn/',
                            '交通银行': 'http://www.bankcomm.com',
                            '中信银行': 'http://bank.ecitic.com',
                            '中国光大银行': 'http://www.cebbank.com',
                            '华夏银行': 'http://www.hxb.com.cn',
                            '中国民生银行': 'http://www.cmbc.com.cn',
                            '广发银行': 'http://www.cgbchina.com.cn',
                            '平安银行': 'http://bank.pingan.com',
                            '招商银行': 'http://www.cmbchina.com',
                            '兴业银行': 'http://www.cib.com.cn',
                            '上海浦东发展银行': 'http://www.spdb.com.cn/'
                };

                var lookup = function(obj, key) {
                    var type = typeof key;
                    if (type == 'string' || type == "number") key = ("" + key).replace(/\[(.*?)\]/, function(m, key){//handle case where [1] may occur
                        return '.' + key;
                    }).split('.');
                    for (var i = 0, l = key.length, currentkey; i < l; i++) {
                        if (obj.hasOwnProperty(key[i])) obj = obj[key[i]];
                        else return undefined;
                    }
                    return obj;
                }

                var url = lookup(json_list, bank);

                if (typeof url != 'undefined')
                {
                    $('#bank_url').val(url)
                }

            })

            $.getJSON('{{asset('assets/js/sql_areas.json')}}',function(data){
                for (var i = 0; i < data.length; i++) {
                    var area = {id:data[i].id,name:data[i].cname,level:data[i].level,parentId:data[i].upid};
                    data[i] = area;
                }
                $('.bs-chinese-region').chineseRegion('source',data).on('changed.bs.chinese-region',function(e,areas){

                    var address = '';

                    $.each(areas, function(key, val){

                        address = address+val.name;

                        if(val.level == 1 ){
                            $('#province_h').val(val.name)
                        }else if(val.level == 2){
                            $('#city_h').val(val.name)
                        }else{
                            $('#town_h').val(val.name);
                            $('#bank_address').val(address)
                        }

                     });
                });;
            });

            @if(Session::has('success'))
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut',
                    timeOut: 5000
                };
                toastr.success('{{Session::get('success')}}', '操作成功');
            }, 1800);
            @endif
             @if(Session::has('error'))
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut',
                    timeOut: 5000
                };
                toastr.error('{{Session::get('error')}}', '发生错误');
            }, 1800);
            @endif



        })

    </script>
@endsection