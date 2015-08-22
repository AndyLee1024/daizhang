# -*- coding: utf-8 -*-
__author__ = 'AndyLee'

import requests
import shutil


req = requests.get('http://www.jsgsj.gov.cn:58888/province/')

cookies = requests.utils.dict_from_cookiejar(req.cookies)

req_get_image = requests.get('http://www.jsgsj.gov.cn:58888/province/rand_img.jsp?type=7', stream=True, cookies=cookies)

with open('verify.png', 'wb') as f:
    req_get_image.raw.decode_content = True
    shutil.copyfileobj(req_get_image.raw, f)

company_name = raw_input('请输入要查询的公司名称:')
code = raw_input('请输入验证码:')

company_info = {
    'name': company_name,
    'verifyCode': code
}

req_get_company = requests.post('http://www.jsgsj.gov.cn:58888/province/infoQueryServlet.json?queryCinfo=true',
                                data=company_info,
                                cookies=cookies)

print req_get_company.text