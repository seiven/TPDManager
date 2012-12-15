<?php
/**
 * TOP API: taobao.increment.customer.permit request
 *
 * @author auto create
 * @since 1.0, 2012-02-07 12:35:56
 */
class IncrementCustomerPermitRequest
{
	/**
	 * 用户需要开通的功能。值可为get,notify和syn分别表示增量api取消息，主动发送消息和同步数据功能。这三个值可任意无序组合。应用在为用户开通相应功能前需先订阅相应的功能；get和notify在主动通知界面中订阅，syn在mysql数据同步步界面中订阅。
	 当重复开通时，只会在已经开通的功能上，开通新的功能，不会覆盖旧的开通。例如：在开通get功能后，再次开通notify功能的结果是开通了get和notify功能；而不会只开通notify功能。
	 在开通时，type里面的参数会根据应用订阅的类型进行相应的过虑。如应用只订阅主动通知，则默认值过滤后为get,notify，如果应用只订阅数据同步服务，默认值过滤后为syn。
	 **/
	private $type;

	private $apiParas = array();

	public function setType($type)
	{
		$this->type = $type;
		$this->apiParas["type"] = $type;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getApiMethodName()
	{
		return "taobao.increment.customer.permit";
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}

	public function check()
	{

		RequestCheckUtil::checkMaxListSize($this->type,3,"type");
	}
}
