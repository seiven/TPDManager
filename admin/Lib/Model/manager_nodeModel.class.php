<?php
// 节点模型
class manager_nodeModel extends CommonModel {
	
	protected $_validate	=	array(
		array('name','checkNode','节点已经存在',0,'callback'),
	);
	
	public $_link =	array(
		'child'=>array(
			'mapping_type'=>HAS_MANY,
			'class_name'=>'manager_node',
			'parent_key'=>'pid',
			'mapping_fields'=>'id,pid,name,title,level',
			'condition'=>'status = 1 AND level = 3 AND ismenu = 1'
		),
	);
	public function checkNode() {
		$map['name']	 =	 $_POST['name'];
		$map['pid']	=	isset($_POST['pid'])?$_POST['pid']:0;
        $map['status'] = 1;
        if(!empty($_POST['id'])) {
			$map['id']	=	array('neq',$_POST['id']);
        }
		$result	=	$this->where($map)->field('id')->find();
        if($result) {
        	return false;
        }else{
			return true;
		}
	}
}