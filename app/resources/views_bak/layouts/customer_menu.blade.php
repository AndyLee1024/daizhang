<ul class="list-unstyled mailbox-nav">
    <li @if(Request::segment(3) == '') class="active" @endif><a href="{{action('CustomerController@getCustomerCompanyInfo', $customer_id)}}"><i class="fa fa-bars"></i>概览</a></li>
    <li @if(Request::segment(3) == 'partner') class="active" @endif><a href="{{action('PartnerController@getPartner' , $customer_id)}}"><i class="fa fa-users"></i>股东信息</a></li>
    <li @if(Request::segment(3) == 'contact') class="active" @endif><a href="{{action('ContactController@getContact' , $customer_id)}}"><i class="fa fa-user"></i>联系人</a></li>
    <li @if(Request::segment(3) == 'bank_account') class="active" @endif><a href="{{action('BankAccountController@getBankAccount', $customer_id)}}"><i class="fa fa-credit-card"></i>银行账户</a></li>
    <li @if(Request::segment(3) == 'task') class="active" @endif><a href="{{action('TaskController@getTaskList', $customer_id)}}"><i class="fa fa-check"></i>待办事项</a></li>
    <li @if(Request::segment(3) == 'certificate') class="active" @endif><a href="{{action('CertificateController@getCertificates', $customer_id)}}"><i class="fa fa-certificate"></i>证照</a></li>
    <li @if(Request::segment(3) == 'password') class="active" @endif><a href="{{action('PasswordController@getPassword', $customer_id)}}"><i class="fa fa-unlock-alt"></i>账户与密码</a></li>
    <li @if(Request::segment(3) == 'tax') class="active" @endif><a href="{{action('TaxController@getTaxList', $customer_id)}}"><i class="fa fa-tasks"></i>税务申报</a></li>
    <li @if(Request::segment(3) == 'bill') class="active" @endif><a href="{{action('CompanyBillController@getAllBills')}}"><i class="fa fa-money"></i>待收款</a></li>


    {{--<li><a href="#"><i class="fa fa-trash"></i>公积金与社保</a></li>--}}
    {{--<li><a href="#"><i class="fa fa-trash"></i>业务备忘</a></li>--}}
    {{--<li><a href="#"><i class="fa fa-trash"></i>账单</a></li>--}}
</ul>
