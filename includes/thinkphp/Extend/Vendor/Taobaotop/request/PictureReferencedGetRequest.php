<?php
/**
 * TOP API: taobao.picture.referenced.get request
 *
 * @author auto create
 * @since 1.0, 2012-02-07 12:35:56
 */
class PictureReferencedGetRequest
{
	/**
	 * 图片id
	 **/
	private $pictureId;

	private $apiParas = array();

	public function setPictureId($pictureId)
	{
		$this->pictureId = $pictureId;
		$this->apiParas["picture_id"] = $pictureId;
	}

	public function getPictureId()
	{
		return $this->pictureId;
	}

	public function getApiMethodName()
	{
		return "taobao.picture.referenced.get";
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}

	public function check()
	{

		RequestCheckUtil::checkNotNull($this->pictureId,"pictureId");
	}
}
