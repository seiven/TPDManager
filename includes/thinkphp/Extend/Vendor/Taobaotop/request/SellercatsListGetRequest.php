<?php
/**
 * TOP API: taobao.sellercats.list.get request
 *
 * @author auto create
 * @since 1.0, 2012-02-07 12:35:56
 */
class SellercatsListGetRequest
{
	/**
	 * 卖家昵称
	 **/
	private $nick;

	private $apiParas = array();

	public function setNick($nick)
	{
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick()
	{
		return $this->nick;
	}

	public function getApiMethodName()
	{
		return "taobao.sellercats.list.get";
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}

	public function check()
	{

		RequestCheckUtil::checkNotNull($this->nick,"nick");
	}
}
