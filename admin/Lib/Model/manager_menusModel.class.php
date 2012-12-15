<?php
// 后台菜单管理
class manager_menusModel extends RelationModel {
	public $_link = array(
		'child'=>array(
			'mapping_type'=>HAS_MANY,
			'class_name'=>'manager_menus',
			'parent_key'=>'pid'
		)
	);
}