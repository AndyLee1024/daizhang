@extends('layouts.master')

@section('title', '请选择一个公司继续')
@section('customer', 'active')


@section('nav', '选择公司')

@section('content')

    <div id="punishResult" style="width: 990px; margin: 0 auto 10px; height:500px;" align="center">
        <dl class="list">
          <?php echo $result['body']['INFO']; ?>
        </dl>
    </div>

@endsection

@section('javascript')
    <script src="{{ get_static('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ get_static('assets/js/pages/notifications.js')}}"></script>
    <script type="text/javascript">

        function queryInfor(url,corp_org,corp_id,seq_id,reg_id,str){
            window.location.replace("{{action('CustomerController@getCompanyDetail')}}?org="+corp_org+"&id="+corp_id+"&seq_id="+seq_id+'&name={{$input['name']}}');
        }

        $(document).ready(function () {
            $('#new_company').click(function(){
                if($('.check_code').is(":visible")){
                    $('.check_code').hide(200);
                }else{
                    $('.check_code').show(200);
                }
            })
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