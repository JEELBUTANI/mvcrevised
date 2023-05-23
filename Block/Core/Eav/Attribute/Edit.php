<?php

class Block_Core_Eav_Attribute_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/eav/attribute/edit.phtml');
	}
	
	public function getCollection()
	{
		$attribute = $this->getData('attribute');	
		return $attribute;
	}


	public function getAttributeOption()
	{
		$attributeId = Ccc::getModel('Core_Request')->getParams('id');
		if (!$attributeId) {
			return Ccc::getModel('Core_Eav_Attribute_Option');
		}
		$sql = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = {$attributeId}";
		$attributeOptions = Ccc::getModel('Core_Eav_Attribute_Option')->fetchAll($sql);
		return $attributeOptions;
	}
}

?>
