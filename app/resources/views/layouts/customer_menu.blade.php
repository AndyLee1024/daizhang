<div class="list-group">

    <a href="{{action('CustomerController@getCustomerCompanyInfo', $customer_id)}}" class="list-group-item @if(Request::segment(3) == '') active @endif">
        <i class="ion fa fa fa-bars"></i>  <span class="tab">概览</span>
    </a>
    <a href="{{action('ContactController@getContact' , $customer_id)}}" class="list-group-item @if(Request::segment(3) == 'contact') active @endif">
        <i class="ion fa fa-user"></i> <span class="tab">联系人</span>
    </a>
    <a href="{{action('PartnerController@getPartner' , $customer_id)}}" class="list-group-item @if(Request::segment(3) == 'partner') active @endif">
        <i class="ion fa fa-users"></i> <span class="tab">股东</span>
    </a>
    <a href="{{action('TaskController@getTaskList', $customer_id)}}" class="list-group-item @if(Request::segment(3) == 'task') active @endif">
        <i class="ion fa fa-check"></i> <span class="tab">待办事项</span>
        @if(get_task($customer_id) > 0)
           <span class="badge badge-sm right circle badge-info">{{ get_task($customer_id)}}</span>
        @endif
    </a>
    <a href="{{action('BankAccountController@getBankAccount', $customer_id)}}" class="list-group-item @if(Request::segment(3) == 'bank_account') active @endif">
        <i class="ion fa fa-credit-card"></i> <span class="tab">银行账号</span>
    </a>
    <a href="{{action('CertificateController@getCertificates', $customer_id)}}" class="list-group-item @if(Request::segment(3) == 'certificate') active @endif">
        <i class="ion fa fa-certificate"></i> <span class="tab">证件证照</span>
    </a>
    <a href="{{action('PasswordController@getPassword', $customer_id)}}" class="list-group-item @if(Request::segment(3) == 'password') active @endif">
        <i class="ion fa fa-unlock-alt"></i> <span class="tab">账号密码</span>
    </a>
    <a href="{{action('TaxController@getTaxList', $customer_id)}}" class="list-group-item @if(Request::segment(3) == 'tax') active @endif">
        <i class="ion fa fa-tasks"></i> <span class="tab">税务申报</span>
    </a>
    <a href="{{action('CompanyBillController@getAllBills',$customer_id)}}" class="list-group-item @if(Request::segment(3) == 'bill') active @endif">
        <i class="ion fa fa-money"></i> <span class="tab">收款</span>
        <span class="badge badge-sm right circle badge-danger">{{\App\CompanyBill::countUnpaid(Session::get('company_id'),$customer_id)}}</span>

    </a>
</div>