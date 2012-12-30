<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

class PublicAction extends Action {
	public function index()
	{
		//如果通过认证跳转到首页
		redirect(__APP__);
	}
	// 检查用户是否登录
	protected function _check_login() {
		if(!session(C('USER_AUTH_KEY'))) {
			$this->assign('jumpUrl',C('USER_AUTH_GATEWAY'));
			$this->error('没有登录');
		}
	} 

	// 用户登出
	public function logout()
	{
		if(session(C('USER_AUTH_KEY') )) {
			session(null);
			$this->assign("jumpUrl",__URL__.'/login/');
			$this->success('登出成功！');
		}else {
			$this->error('已经登出！');
		}
	}
	// 用户登录页面
	public function login() {
		if(!session('?'.C('USER_AUTH_KEY'))) {
			if ($this->ispost())
			{
				// 登录处理
				if($this->_post('account','trim') == '') {
					$this->error('帐号错误！');
				}elseif ($this->_post('password','trim') == ''){
					$this->error('密码必须！');
				}elseif ($this->_post('verify','trim') == ''){
					$this->error('验证码必须！');
				}
				//生成认证条件
				$map = array();
				// 支持使用绑定帐号登录
				$map['account']	= $_POST['account'];
				$map["status"] = array('gt',0);
				if(session('verify') != md5($_POST['verify'])) {
					$this->error('验证码错误！');
				}
				import ( '@.ORG.Util.RBAC' );
				$authInfo = RBAC::authenticate($map);
				//使用用户名、密码和状态的方式进行认证
				if(false === $authInfo) {
					$this->error('帐号不存在或已禁用！');
				}else {
					if($authInfo['password'] != md5($_POST['password'])) {
						$this->error('密码错误！');
					}
					session(C('USER_AUTH_KEY') , $authInfo['id']);
					session('email' , $authInfo['email']);
					session('loginUserName' , $authInfo['nickname']);
					session('lastLoginTime' , $authInfo['last_login_time']);
					session('login_count' , $authInfo['login_count']);
					if($authInfo['account'] == C('ADMIN_USER_NAME')) {
						session(C('ADMIN_AUTH_KEY'),true);
					}
					//保存登录信息
					$User =	M('manager_user');  
					$data = array();
					$data['id']	= $authInfo['id'];
					$data['last_login_time'] = time();
					$data['login_count'] = array('exp','login_count+1');
					$data['last_login_ip'] = get_client_ip();
					$User->save($data);

					// 缓存访问权限
					RBAC::saveAccessList();
					$this->success('登录成功！',U('Index/index'));
				}
			}else{
				$this->display();
			}
		}else{
			$this->redirect('Index/index');
		}
	}
	// 更换密码
	public function changePwd()
	{
		$this->_check_login();
		//对表单提交处理进行处理或者增加非表单数据
		if(md5($_POST['verify']) != session('verify')) {
			$this->error('验证码错误！');
		}
		$map = array();
		$map['password']= pwdHash($_POST['oldpassword']);
		if(isset($_POST['account'])) {
			$map['account'] = $_POST['account'];
		}elseif(session(C('USER_AUTH_KEY'))) {
			$map['id'] = session(C('USER_AUTH_KEY'));
		}
		//检查用户
		$User = M('manager_user');
		if(!$User->where($map)->field('id')->find()) {
			$this->error('旧密码不符或者用户名错误！');
		}else {
			$User->password	= pwdHash($_POST['password']);
			$User->save();
			$this->success('密码修改成功！');
		}
	}
	/**
	 *
	 * 修改资料
	 */
	public function profile() {
		$this->_check_login();
		if ($this->ispost())
		{
			// 提交数据处理
			$User = D('manager_user');
			if(!$User->create()) {
				$this->error($User->getError());
			}
			$result	= $User->save();
			if(false !== $result) {
				$this->success('资料修改成功!');
			}else{
				$this->error('资料修改失败!');
			}
		}
		$User = M('manager_user');
		$vo	= $User->getById(session(C('USER_AUTH_KEY')));
		$this->assign('vo',$vo);
		$this->display();
	}
	/**
	 *
	 * 验证码
	 */
	public function verify()
	{
		$type = isset($_GET['type'])?$_GET['type']:'gif';
		import("@.ORG.Util.Image");
		Image::buildImageVerify(4,1,$type);
	}
}