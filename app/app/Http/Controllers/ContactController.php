<?php

namespace App\Http\Controllers;

use Auth;
use Input;
use Session;
use Redirect;
use Validator;
use App\Contact;
use App\Http\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
/**
 * 客户 - 联系人模块
 * @package App\Http\Controllers
 * @version 1.0
 * @author  AndyLee <root@lostman.org>
 */
class ContactController extends BaseController
{

    /**
     * 公司联系人
     * @author AndyLee <root@lostman.org>
     */
    public function getContact()
    {
        $map = [
            'company_id' => Session::get('customer_id'),
            'operator_id' => Auth::user()->id
        ];
        $contacts = Contact::where($map)->get();

        return view('customer.contact.index')->with('contacts', $contacts);
    }

    /**
     * 设置默认联系人
     * @param int $id 客户公司id
     * @param int $pid 联系人ID
     * @return mixed
     * @author AndyLee <root@lostman.org>
     */
    public function getSetDefaultContact($id, $pid)
    {
        $map = [
            'id' => $pid,
            'company_id' => Session::get('customer_id')
        ];

        try {
            $record = Contact::where($map)->findOrFail($pid);
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '记录不存在');
            return redirect()->back();
        }

        $contacts = Contact::where('company_id', Session::get('customer_id'))->get();

        foreach ($contacts as $contact) {
            $contact->is_default = 0;
            $contact->save();
        }

        $record->is_default = 1;
        $record->save();
        Session::flash('success', '设置默认联系人成功');
        return redirect()->back();

    }

    /**
     * 创建联系人
     * @return mixed
     * @author AndyLee <root@lostman.org>
     */
    public function getCreateContact()
    {
        return view('customer.contact.create');
    }

    /**
     * 创建联系人 action
     * @return mixed
     * @author AndyLee <root@lostman.org>
     */
    public function postCreateContact()
    {
        $input = Input::Only('name', 'post', 'mobile', 'email', 'remarks');
        $rules = [
            'name' => 'required',
            'post' => 'required',
            'mobile' => 'required|Regex:/^1[0-9]{10}$/|unique:company_contacts,mobile',
            'email' => 'email|unique:company_contacts',
        ];

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Session::flash('error', $v->messages()->first());
            return Redirect::back();
        }

        $contact = new Contact();
        $contact->company_id = Session::get('customer_id');
        $contact->operator_id = Auth::user()->id;
        $contact->name = $input['name'];
        $contact->post = $input['post'];
        $contact->mobile = $input['mobile'];
        $contact->email = $input['email'];
        $contact->remarks = $input['remarks'];
        $contact->save();

        Session::flash('success', '添加联系人成功');
        return Redirect::back();
    }

    /**
     * 编辑联系人
     * @param integer $id 联系人ID
     * @param integer $cid 公司id
     * @return mixed
     * @author AndyLee <root@lostman.org>
     */
    public function getModifyContact($cid, $id)
    {
        try {
            $contact = Contact::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '操作不存在,联系人不存在!');
            return Redirect::back();
        }

        if ($contact->company_id == Session::get('customer_id')) {

            return view('customer.contact.modify')->with('contact', $contact);
        } else {
            Session::flash('error', '操作失败, 您没有权限访问');
            return Redirect::back();
        }
    }

    /**
     * 编辑联系人Action
     * @param $cid integer 公司id
     * @param $id integer 联系人ID
     * @return mixed
     * @author AndyLee <root@lostman.org>
     */
    public function postModifyContact($cid, $id)
    {
        $input = Input::Only('name', 'post', 'mobile', 'email', 'remarks');
        $rules = [
            'name' => 'required',
            'post' => 'required',
            'mobile' => 'required|Regex:/^1[0-9]{10}$/',
            'email' => 'required|email',
        ];

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Session::flash('error', $v->messages()->first());
            return Redirect::to(action('ContactController@getModifyContact', [Session::get('customer_id'),$id]));
        }

        try {
            $contact = Contact::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '操作不存在,联系人不存在!');
            return Redirect::to(action('ContactController@getContact', Session::get('customer_id')));
        }

        if ($contact->company_id == Session::get('customer_id')) {

            $contact->name = $input['name'];
            $contact->post = $input['post'];
            $contact->mobile = $input['mobile'];
            $contact->email = $input['email'];
            $contact->remarks = $input['remarks'];
            $contact->save();

            Session::flash('success', '操作成功, 编辑联系人成功');
            return Redirect::to(action('ContactController@getContact', Session::get('customer_id')));

        } else {
            Session::flash('error', '操作失败, 您没有权限访问');
            return Redirect::to(action('ContactController@getContact', Session::get('customer_id')));
        }
    }


    /**
     * 删除联系人
     * @param integer $cid
     * @return mixed
     * @param $id
     * @author AndyLee <root@lostman.org>
     */
    public function getDeleteContact($cid, $id)
    {
        try {
            $contact = Contact::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '操作不存在,联系人不存在!');
            return Redirect::to(action('ContactController@getContact', Session::get('customer_id')));
        }

        if ($contact->company_id == Session::get('customer_id')) {

            if ($contact->is_default == 1) {
                Session::flash('error', '操作失败, 无法删除默认联系人');
                return Redirect::to(action('ContactController@getContact', Session::get('customer_id')));

            }

            $contact->delete();

            Session::flash('success', '删除联系人成功');
            return Redirect::to(action('ContactController@getContact', Session::get('customer_id')));

        } else {
            Session::flash('error', '操作失败, 您没有权限访问');
            return Redirect::to(action('ContactController@getContact', Session::get('customer_id')));
        }


    }
}
