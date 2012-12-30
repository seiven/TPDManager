<?php
/**
 * 
 * 用户组关系列表
 * @author seiven
 *
 */
class manager_role_userModel extends RelationModel { 
	protected $_link = array(
		'role'=>array(
			'mapping_type'=>BELONGS_TO,
			'class_name'=>'manager_role',
			'foreign_key'=>'role_id'
		),
		'user'=>array(
			'mapping_type'=>BELONGS_TO,
			'class_name'=>'manager_user',
			'foreign_key'=>'user_id'
		)
	);
}