<?php
class IndexAction extends CommonAction {
	// 框架首页
	public function index() {
		if (isset ( $_SESSION [C ( 'USER_AUTH_KEY' )] )) {
			// 获取目前所有的菜单
			$caidan = array();
			$_access_list = session('_ACCESS_LIST');
			$_modle_menus = D('manager_menus');
			$menus = $_modle_menus->where('pid=0')->relation(true)->select();
			foreach($menus as $item)
			{
				$_t = array();
				if ($item['child']) {
					// 有下级菜单
					foreach ($item['child'] as $v)
					{
						$_isaccess = isset($_access_list[strtoupper ( APP_NAME )][strtoupper( $v ['controller'] )][strtoupper($v ['action'])]);
						if (strtolower($v ['action'] == 'index'))
						{
							$_isaccess = isset($_access_list[strtoupper ( APP_NAME )][strtoupper( $v ['controller'] )]);
						}
						if ($_isaccess || session (C('ADMIN_AUTH_KEY'))) {
							$_t[] = $v;
						}
					}
					if ($_t) {
						// 如果下级菜单有权限就显示顶级和二级
						$caidan[] = array(
							'title' => $item['title'],
							'child'=>$_t,
							'pid' => $item['pid'],
							'controller' => $item['controller'],
							'action' => $item['action'],
							'target' => $item['target'],
						);
					}
				}else{
					// 如果无下级菜单
					if ($item ['controller']) {
						// 链接不为空则显示
						$_isaccess = isset($_access_list[strtoupper ( APP_NAME )][strtoupper( $item ['controller'] )][strtoupper($item ['action'])]);
						if (strtolower($item ['action'] == 'index'))
						{
							$_isaccess = isset($_access_list[strtoupper ( APP_NAME )][strtoupper( $item ['controller'] )]);
						}
						if ($_isaccess || session (C('ADMIN_AUTH_KEY'))) {
							$caidan[] = $item;
						}
					}
				}
			}
			$this->assign ( 'navs', $caidan );
		}
		C ( 'SHOW_RUN_TIME', false ); // 运行时间显示
		C ( 'SHOW_PAGE_TRACE', false );
		$this->display ();
	}
}