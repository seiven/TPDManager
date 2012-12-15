<?php
/**
 *
 * 后台菜单管理
 * @author seiven
 *
 */
class manager_menusAction extends CommonAction {
	public function _filter(&$map)
	{
		if(!isset($map['pid']) ) {
			$map['pid']	=	0;
		}
		if($_GET['pid']!=''){
			$map['pid'] = $this->_get('pid');
		}
		//获取上级节点
		$_paremt_menu_title = '顶级菜单';
		$_model_menus  = M($this->getActionName());
		if(isset($map['pid'])) {
			if($_model_menus->getById($map['pid'])) {
				$_paremt_menu_title = $node->title;
			}
		}
		$this->assign('parent_menu_title',$_paremt_menu_title);
	}

	public function _before_add()
	{
		// 加载顶级菜单
		$_model_menus  = M($this->getActionName());
		$this->assign('top_menus',$_model_menus->where('pid = 0')->select());
		// 加载节点信息
		$_model_node = M('manager_node');
		$this->assign('controllers',$_model_node->where(array('level'=>2,'pid'=>1,'ismenu'=>1))->select());
	}
	public function _before_edit()
	{
		// 加载顶级菜单
		$_model_menus  = M($this->getActionName());
		$this->assign('top_menus',$_model_menus->where('pid = 0')->select());
		// 加载节点信息
		$_model_node = M('manager_node');
		$this->assign('controllers',$_model_node->where(array('level'=>2,'pid'=>1,'ismenu'=>1))->select());
	}
	/**
	 * ajax查询服务(通过控制器名称获取action)
	 */
	function get_action_by_controllername()
	{
		$_return = array();
		$controller_name = trim($this->_get('controllername'));
		$_model_manager_node = M('manager_node');
		$parent_manager_node = $_model_manager_node->where("name = '$controller_name' and level = 2 and status=1")->find();
		if($parent_manager_node){
			// 获取下级节点
			$_nodes = $_model_manager_node->where(array('status'=>1,'level'=>3,'pid'=>$parent_manager_node['id']))
			->field('name,title')->select();
			if ($_nodes) {
				foreach ($_nodes as $item)
				{
					$_return[] = array($item['name'],$item['title']."({$item['name']})");
				}
			}else{
				$_return[] = array('index','默认节点(index)');
			}
		}else{
			$_return[] = array('index','默认节点(index)');
		}
		echo json_encode($_return);return;
	}
}