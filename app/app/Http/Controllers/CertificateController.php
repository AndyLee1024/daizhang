<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\CustomerCompany;
use Illuminate\Support\Facades\Validator;
use Input;
use Auth;
use Session;
use Config;
use App\Http\Requests;
use App\Certificate;
use App\Http\Controllers\BaseController;

/**
 * 证件上传
 * @package App\Http\Controllers
 * @version 1.0
 * @author  AndyLee <root@lostman.org>
 */
class CertificateController extends BaseController
{
    /**
     * 下载证件
     * @param Request $request
     * @return redirect
     * @author AndyLee <root@lostman.org>
     */
    public function getDownloadCertificate(Request $request)
    {
        $url = $request->get('url');
        $url_info = parse_url($url);

        /**
         * TODO 防止尝试下载别的公司文件
         */
        if(!file_exists(public_path($url_info['path']))){
            return \App::abort(404);
        }
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename(public_path($url_info['path'])));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize(public_path($url_info['path'])));

    }
    /**
     * 列出证件
     * @author AndyLee <root@lostman.org>
     */
    public function getCertificates()
    {
        $result = [];

        $certs = Certificate::where('company_id', Session::get('customer_id'))->get();

        $type = Config::get('customer.certificate');

        foreach($type as $k => $v){

            foreach($certs as $cert){
                if($cert->certificate_type == $k){
                    $result[$k][] = $cert->toArray();
                }
            }
        }


        return view('customer.certificate.index')->with('result', $result);
    }

    /**
     * 增加证件
     * @return \Illuminate\View\View
     * @author AndyLee <root@lostman.org>
     */
    public function getCreateCertificate()
    {
        return view('customer.certificate.create');
    }

    /**
     * 增加证件操作
     * @author AndyLee <root@lostman.org>
     */
    public function postCreateCertificate(Request $request)
    {
        /**
         * 处理验证类型，要求传入的证照类型必须与配置文件相同
         */
        $type = '';

        $cert_config = Config::get('customer.certificate');
        $count = count($cert_config);
        $i = 0;
        foreach($cert_config as $k =>$v){
            if($i+1 === $count) {
                $type = $type.$k;
            }else{
                $type = $type.$k.',';
            }
            $i++;
        }

        $input = $request->only('name', 'type', 'number', 'remarks', 'path');
        $rules = [

            'name' => 'required',
            'type' => 'required|in:'.$type,
            'path' => 'required'
        ];

        $v = Validator::make($input, $rules);
        if($v->fails()){
            Session::flash('error', $v->messages()->first());
            return redirect()->back();
        }

        $certificate = new Certificate();
        $certificate->company_id = Session::get('customer_id');
        $certificate->name = $input['name'];
        $certificate->operator_id = Auth::user()->id;
        $certificate->certificate_type = $input['type'];
        $certificate->certificate_number = $input['number'];
        $certificate->certificate_path = serialize($input['path']);
        $certificate->remarks = $input['remarks'];
        $certificate->save();

        Session::flash('success', '增加证照完成');

        return redirect()->to(action('CertificateController@getCertificates', Session::get('customer_id')));


    }

    /**
     * 获取证照详细信息
     * @param string $id
     * @para, string $Pid 证件id
     * @return view
     * @author AndyLee <root@lostman.org>
     */
    public function getCertificateDetail($id, $pid)
    {
        $map = [
            'id' =>        $pid,
            'company_id' => Session::get('customer_id')
        ];

        try{
            $cert = Certificate::where($map)->firstOrFail();
        }catch (ModelNotFoundException $e){
            Session::flash('error', '纪录不存在！');
            return redirect()->back();
        }

        return view('customer.certificate.detail')->with('cert', $cert);
    }

    /**
     * 删除证件
     * @return mixed
     * @param Request $request
     * @author AndyLee <root@lostman.org>
     */
    public function getDeleteCertificate(Request $request)
    {
        $input = $request->only('certificate_id');

        $map = [
            'id'         => $input['certificate_id'],
            'company_id' => Session::get('customer_id')
        ];

        $certificate = Certificate::where($map)->first();
        if(!$certificate){
            Session::flash('error', '记录不存在,无法删除!');
            return redirect()->back();
        }

        //TODO 删除完成之后是否要删除文件呢?
        $certificate->delete();
        Session::flash('success', '删除证件成功');
        return redirect()->back();
    }

    /**
     * 上传证件
     * @param Request $request
     * @return mixed
     * @author AndyLee <root@lostman.org>
     */
    public function postUploadCertificate(Request $request)
    {
        $input = $request->file('file');

        $param = $request->only('name', 'id');

        $rules = array(
            'file' => 'image|max:3000',
        );

        $validation = \Validator::make([
            'file' => $input,
        ], $rules);

        if ($validation->fails()) {
            return \Response::make($validation->errors->first(), 400);
        }

        $extension = $input->getClientOriginalExtension();

        /**
         * 获取公司信息
         */
        $customer = CustomerCompany::find(Session::get('customer_id'));

        /**
         * 设置存储目录
         * 存储目录结构 ＝  uploads / sha1加密的公司id /客户公司uuid
         */

        $directory = public_path('uploads') . '/'.sha1(Session::get('company_id')).'/'.$customer->uuid;
        $filename = sha1(time() . time()) . ".{$extension}";

        $upload_success = $input->move($directory, $filename);

        $message = [
            'file_path' => asset('uploads/'.sha1(Session::get('company_id')).'/'.$customer->uuid).'/'.$filename
        ];

        /**
         * 用户相关证件一键上传
         */
        if(!empty($param['name']) and !empty($param['id'])){
            $param['company_id'] = Session::get('customer_id');
            try{
                $certificate = Certificate::where($param)->firstOrFail();
            }catch (ModelNotFoundException $e){
                return \Response::json(['state'=>'denied'], 200);
            }

            $certificate->certificate_path = serialize([$message['file_path']]);
            $certificate->save();

        }

        if ($upload_success) {
            $message['status'] = 'success';
            return \Response::json($message, 200);
        } else {
            $message['status'] = 'error';
            return \Response::json($message, 400);
        }
    }
}
