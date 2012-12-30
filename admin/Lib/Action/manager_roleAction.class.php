<?php
// 角色模块
class manager_roleAction extends CommonAction {
	function _filter(&$map){
		$map['name'] = array('like',"%".$_POST['name']."%");
	}
	function _before_edit(){
		$Group = D('manager_role');
		//查找满足条件的列表数据
		$list     = $Group->field('id,name')->select();
		$this->assign('list',$list);

	}
	function _before_add(){
		$Group = D('manager_role');
		//查找满足条件的列表数据
		$list     = $Group->field('id,name')->select();
		$this->assign('list',$list);

	}
	function select()
	{
		$map = $this->_search();
		//创建数据对象
		$Group = D('manager_role');
		//查找满足条件的列表数据
		$list     = $Group->field('id,name')->select();
		$this->assign('list',$list);
		$this->display();
		return;
	}
	/**
	 * 
	 * 管理 角色用户分配
	 */
	function user()
	{
		$roleid = $this->_request('roleid','intval',0);
		$role = M('manager_role')->field('id,name')->find($roleid);
		if ($role){
			if ($this->ispost())
			{
				// 提交数据处理
				$select_user = $_POST['user'];
				// 删除现有所有用户关系
				M('manager_role_user')->where(array('role_id'=>$role['id']))->delete();
				// 新增新用户关系
				foreach ($select_user as $u)
				{
					M('manager_role_user')->data(array('role_id'=>$role['id'],
						'user_id'=>$u
						))->add();
				}
				$this->success('更新分组用户列表成功!');
			}
			// 读取系统的用户列表
			$user_list = D('manager_user')->field('id,account,nickname')->select();
			foreach ($user_list as $k=>$v){
				// 检测每个用户是否在当前组
				$user_list[$k]['status'] = 0;
				if(M('manager_role_user')->where(array('role_id'=>$role['id'],'user_id'=>$v['id']))->count()){
					// 存在用户
					$user_list[$k]['status'] = 1;
				}
			}
			//dump($user_list);
			$this->assign('user_list',$user_list);
			$this->assign('role',$role);
			$this->display();
		}else{
			$this->error('读取错误请重试!','',true);
		}
	}
	/**
	 *
	 * 获取所有可分配权限
	 */
	function set_access()
	{
		// 如果是提交数据则保存数据
		if ($this->isPost() && $this->_post('isajax','intval',0) == 1)
		{
			$role_id = $this->_post('role_id','intval',0);
			if ($role_id)
			{
				$_post_roles = $_POST['role'];
				if ($_post_roles){
					// 先删除现在的所有权限配置
					M('manager_access')->where("role_id='$role_id' AND level != 1" )->delete();
					// 组合数据新增新的权限配置
					$_parent = array();
					// 增加action
					foreach ($_post_roles as $r)
					{
						$_ = explode('_', $r);
						$_role = array(
							'role_id'=>$role_id,
							'node_id'=>$_[0],
							'level'=>$_[1],
							'pid'=>$_[2]
						);
						$_parent[] = $_[2];
						M('manager_access')->data($_role)->add();
					}
					// 增加controller
					$_parent = array_unique($_parent);
					foreach ($_parent as $v)
					{
						$_role = array(
							'role_id'=>$role_id,
							'node_id'=>$v,
							'level'=>2,
							'pid'=>1
						);
						M('manager_access')->data($_role)->add();
					}
					$this->success('授权成功','',true);
				}
			}
		}
		// 获取要授权的角色信息
		$roleid = $this->_request('roleid','intval',0);
		$role = M('manager_role')->find($roleid);
		$this->assign('role',$role);
		// 获取当前角色的现有权限列表
		$access = array();
		if ($role){
			$_tmp_access = M('manager_access')->field('node_id')->where('role_id='.$role['id'])->select();
			foreach ($_tmp_access as $_titem )
			{
				$access[] = $_titem['node_id'];
			}
		}
		// 获取所有需要权限管理的操作列表
		$manager_node = D('manager_node')->where(array(
			'level'=>2,'ismenu'=>1,
			'status'=>1))->field('name,title,id,pid,level')->relation(true)->select();
		// 检测权限是否有权限
		foreach ($manager_node as $k=>$node)// controller
		{
			// action
			foreach ($node['child'] as $i=>$chole_node)
			{
				$manager_node[$k]['child'][$i]['access'] = 0;
				if (in_array($chole_node['id'], $access)) $manager_node[$k]['child'][$i]['access'] = 1;
			}
		}
		//dump($manager_node);
		$this->assign('nodes',$manager_node);
		$this->display();
	}
}