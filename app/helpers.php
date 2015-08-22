<?php
/**
 * 助手函数
 * @version 1.0
 * @author  AndyLee <root@lostman.org>
 */

/**
 * 获取静态资源地址
 */
if (!function_exists('get_static')) {
    function get_static($path)
    {
        $cdn = Config::get('app.cdn');
        if (!$cdn) {
            return '/' . $path;
        } else {
            return $cdn . '/' . $path;
        }

    }
}

/**
 * 获取文件尺寸
 * @param string $url 文件网址(仅限于自己的server)
 * @param string $size_type 文件尺寸单位 B,K,M
 */
if(!function_exists('get_file_size')){
    function get_file_size($url, $size_type='K'){

        if($size_type == 'B'){
            return filesize(public_path(parse_url($url)['path']));
        }
        if($size_type == 'K'){
            return round(filesize(public_path(parse_url($url)['path']))/1024);
        }
        if($size_type == 'M'){
            return round(filesize(public_path(parse_url($url)['path']))/1048576);
        }


    }
}
/**
 * 获取银行logo css
 * @param string $bank 银行名称
 */
if (!function_exists('get_bank_logo')) {
    function get_bank_logo($bank)
    {
        switch ($bank) {
            case '中国工商银行':
                return ['name' => 'bank_icbc', 'state' => 'found'];
                break;
            case '中国农业银行':
                return ['name' => 'bank_abc', 'state'=> 'found'];
                break;
            case '中国银行':
                return ['name' => 'bank_boc', 'state'=> 'found'];
                break;
            case '中国建设银行':
                return ['name' => 'bank_ccb', 'state'=> 'found'];
            break;
            case '国家开发银行':
                return ['name' => '国家开发银行', 'state' => 'failed'];
            break;
            case '中国农业发展银行':
                return ['name' => '中国农业发展银行', 'state' => 'failed'];
            break;
            case '交通银行':
                return ['name' => 'bank_bcom', 'state' => 'found'];
                break;
            case '中信银行':
                return ['name' => 'bank_citic', 'state' => 'found'];
                break;
            case '中国光大银行':
                return ['name' => 'bank_ceb', 'state' => 'found'];
                break;
            case '华夏银行':
                return ['name' => 'bank_hxb', 'state' => 'found'];
                break;
            case '中国民生银行':
                return ['name' => 'bank_cmbc', 'state' => 'found'];
                break;
            case '广发银行':
                return ['name' => 'bank_gdb', 'state' => 'found'];
                break;
            case '平安银行':
                return ['name' => 'bank_pab', 'state' => 'found'];
                break;
            case '招商银行':
                return ['name' => 'bank_cmb', 'state' => 'found'];
                break;
            case '兴业银行':
                return ['name' => 'bank_cib', 'state' => 'found'];
                break;
            case '上海浦东发展银行':
                return ['name' => 'bank_spdb', 'state' => 'found'];
                break;
            default:
                return ['name' =>$bank, 'state'=> 'failed'];
            break;
        }
    }
}
/**
 * 获取代账公司名称
 * @param integer $id 公司id
 */

if (!function_exists('get_company_name')) {
    function get_company_name($id)
    {

        try {
            $company = Company::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return '未知公司';
        }

        return $company->name;

    }
}
/**
 * 获取网站icon
 */
if (!function_exists('getFavicon')) {
    function getFavicon($url)
    {

        $request = new App\Library\Requests();

        $elems = parse_url($url);
        if (!isset($elems['scheme'])) {
            $elems['scheme'] = 'http';
        }
        if (!isset($elems['host'])) {
            $elems['host'] = $elems['path'];
        }
        $url = $elems['scheme'] . '://' . $elems['host'];

        # load site
        $output = $request->getRequest($url);

        # look for the shortcut icon inside the loaded page
        $regex_pattern = "/rel=\"shortcut icon\" (?:href=[\'\"]([^\'\"]+)[\'\"])?/";
        preg_match_all($regex_pattern, $output, $matches);

        if (isset($matches[1][0])) {
            $favicon = $matches[1][0];

            # check if absolute url or relative path
            $favicon_elems = parse_url($favicon);


            # if relative
            if (!isset($favicon_elems['host'])) {
                $favicon = $url . $favicon;
            }

            $ext = pathinfo($favicon, PATHINFO_EXTENSION);
            $image = 'icon/' . str_random(16) . '.' . $ext;

            $request->saveImage($favicon, $image);

            return asset($image);
        }

        return false;
    }
}
/**
 *
 * 输出客户首字母排序
 */
if (!function_exists('alphabeticaly')) {
    function alphabeticaly()
    {
        $aplha = [
            "A" => action('CustomerController@getOrderCustomer', 'a'),
            "B" => action('CustomerController@getOrderCustomer', 'b'),
            "C" => action('CustomerController@getOrderCustomer', 'c'),
            "D" => action('CustomerController@getOrderCustomer', 'd'),
            "E" => action('CustomerController@getOrderCustomer', 'e'),
            "F" => action('CustomerController@getOrderCustomer', 'f'),
            "G" => action('CustomerController@getOrderCustomer', 'g'),
            "H" => action('CustomerController@getOrderCustomer', 'h'),
            "I" => action('CustomerController@getOrderCustomer', 'i'),
            "J" => action('CustomerController@getOrderCustomer', 'j'),
            "K" => action('CustomerController@getOrderCustomer', 'k'),
            "L" => action('CustomerController@getOrderCustomer', 'l'),
            "M" => action('CustomerController@getOrderCustomer', 'm'),
            "N" => action('CustomerController@getOrderCustomer', 'n'),
            "O" => action('CustomerController@getOrderCustomer', 'o'),
            "P" => action('CustomerController@getOrderCustomer', 'p'),
            "Q" => action('CustomerController@getOrderCustomer', 'q'),
            "R" => action('CustomerController@getOrderCustomer', 'r'),
            "S" => action('CustomerController@getOrderCustomer', 's'),
            "T" => action('CustomerController@getOrderCustomer', 't'),
            "U" => action('CustomerController@getOrderCustomer', 'u'),
            "V" => action('CustomerController@getOrderCustomer', 'v'),
            "W" => action('CustomerController@getOrderCustomer', 'w'),
            "X" => action('CustomerController@getOrderCustomer', 'x'),
            "Y" => action('CustomerController@getOrderCustomer', 'y'),
            "Z" => action('CustomerController@getOrderCustomer', 'z'),
        ];

        return $aplha;
    }
}


/**
 *
 * Description 友好显示时间
 * @param int $time 要格式化的时间戳 默认为当前时间
 * @return string $text 格式化后的时间戳
 * @author yijianqing
 */

if(!function_exists('mdate')){

    function mdate($time = NULL) {
        $text = '';
        $time = $time === NULL || $time > time() ? time() : intval($time);
        $t = time() - $time; //时间差 （秒）
        if ($t == 0)
            $text = '刚刚';
        elseif ($t < 60)
            $text = $t . '秒前'; // 一分钟内
        elseif ($t < 60 * 60)
            $text = floor($t / 60) . '分钟前'; //一小时内
        elseif ($t < 60 * 60 * 24)
            $text = floor($t / (60 * 60)) . '小时前'; // 一天内
        elseif ($t < 60 * 60 * 24 * 3)
            $text = floor($time/(60*60*24)) ==1 ?'昨天 ' . date('H:i', $time) : '前天 ' . date('H:i', $time) ; //昨天和前天
        elseif ($t < 60 * 60 * 24 * 30)
            $text = date('m月d日 H:i', $time); //一个月内
        elseif ($t < 60 * 60 * 24 * 365)
            $text = date('m月d日', $time); //一年内
        else
            $text = date('Y年m月d日', $time); //一年以前
        return $text;
    }
}

if(!function_exists('get_task')){
    function get_task($company_id){
        $map = [
            'company_id' => $company_id,
            'is_finish'  => 0
        ];
        return App\Task::where($map)->count();
    }
}

