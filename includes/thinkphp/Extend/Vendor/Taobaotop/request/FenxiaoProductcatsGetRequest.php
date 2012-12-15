<?php
/**
 * TOP API: taobao.fenxiao.productcats.get request
 *
 * @author auto create
 * @since 1.0, 2012-02-07 12:35:56
 */
class FenxiaoProductcatsGetRequest
{
	/**
	 * 返回字段列表
	 **/
	private $fields;

	private $apiParas = array();

	public function setFields($fields)
	{
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields()
	{
		return $this->fields;
	}

	public function getApiMethodName()
	{
		return "taobao.fenxiao.productcats.get";
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}

	public function check()
	{

	}
}
