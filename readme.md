1. 配置个人`.env`文件
2. 使用composer安装依赖
3. 导入数据库

判断标准：
1. username：
'username' => 'required|unique:users|min:6|max:40',   注册
'username' => 'required|min:6|max:40', 登录
'username' => 'required|min:6|max:40', 找回密码
非空 字符长度大于2小于40 

2. password
'password' => 'required|confirmed|min:6|max:40|alpha_num', 注册
'password' => 'required|min:6|max:40|alpha_num', 登录
'password' => 'required|confirmed|min:6|max:40|alpha_num', 找回密码
'oldpassword' => 'required|min:6|max:40|alpha_num',
'password' => 'required|confirmed|min:6|max:40|alpha_num' 修改密码
            
非空 长度大于6小于40 

email 20位
 'email' => 'required|email|max:20'
 
 phone 13位
 'phone' => 'nullable|numeric|max:13',
            required
            项目必须 用户不必须

description 
'description' => 'nullable|max:255',

projectName
'projectName' => 'required|max:50',

