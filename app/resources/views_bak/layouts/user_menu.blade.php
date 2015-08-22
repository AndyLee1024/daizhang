<ul class="list-unstyled mailbox-nav">
    <li @if(Request::segment(2) == '') class="active" @endif><a href="{{action('CompanyController@getCompanyInfo')}}"><i class="fa fa-sitemap"></i>代账公司设置</a></li>
    <li @if(Request::segment(2) == 'invite') class="active" @endif><a href="{{action('CompanyController@getInviteInfo')}}"><i class="fa fa-user-plus"></i>邀请成员</a></li>
    <li @if(Request::segment(2) == 'contact') class="active" @endif><a href="{{action('ContactController@getContact')}}"><i class="fa fa-user"></i>联系人</a></li>
    <li @if(Request::segment(2) == 'bank_account') class="active" @endif><a href="{{action('BankAccountController@getBankAccount')}}"><i class="fa fa-credit-card"></i>银行账户</a></li>
    <li @if(Request::segment(2) == 'task') class="active" @endif><a href="{{action('TaskController@getTaskList')}}"><i class="fa fa-check"></i>待办事项</a></li>
    <li @if(Request::segment(2) == 'certificate') class="active" @endif><a href="{{action('CertificateController@getCertificates')}}"><i class="fa fa-certificate"></i>证照</a></li>
    <li @if(Request::segment(2) == 'password') class="active" @endif><a href="{{action('PasswordController@getPassword')}}"><i class="fa fa-unlock-alt"></i>账户与密码</a></li>
    <li @if(Request::segment(2) == 'tax') class="active" @endif><a href="{{action('TaxController@getTaxList')}}"><i class="fa fa-tasks"></i>税务申报</a></li>

    {{--<li><a href="#"><i class="fa fa-trash"></i>公积金与社保</a></li>--}}
    {{--<li><a href="#"><i class="fa fa-trash"></i>业务备忘</a></li>--}}
    {{--<li><a href="#"><i class="fa fa-trash"></i>账单</a></li>--}}
</ul>
