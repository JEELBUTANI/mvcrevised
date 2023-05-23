<?php

class Block_Core_Eav_Attribute_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->getCollection();
		$this->_prepareColumns();
		$this->_prepareActions();
		$this->_prepareButtons();
		$this->setTitle('Manage Eav Attribute');
	}

	public function getCollection()
	{
		$query = "SELECT count(`attribute_id`) FROM `eav_attribute`";
		$totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($query);

		$this->getPager()->setTotalRecords($totalRecord)->calculate();

		$query = "SELECT EA.* , ET.type_name FROM `eav_attribute` AS EA LEFT JOIN `entity_type` AS ET ON EA.entity_type_id=ET.entity_type_id LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getRecordPerPage()}";
		$data = Ccc::getModel('Core_Eav_Attribute')->fetchAll($query);
		return $data;
	}

	protected function _prepareColumns()
	{
		$this->addColumn('attribute_id',['title' => 'Attribute Id']);
		$this->addColumn('type_name',['title' => 'Type Name']);
		$this->addColumn('code',['title' => 'Code']);
		$this->addColumn('backend_type',['title' => 'Backend Type']);
		$this->addColumn('name',['title' => 'Name']);
		$this->addColumn('status',['title' => 'Status']);
		$this->addColumn('backend_model',['title' => 'Backend Model']);
		$this->addColumn('input_type',['title' => 'Input Type']);
		return parent::_prepareColumns();
	}


	protected function _prepareActions()
	{
		$this->addAction('edit',['title' => 'Edit','method' => 'getEditUrl']);
		$this->addAction('delete',['title' => 'Delete','method' => 'getDeleteUrl']);
		return parent::_prepareActions();
	}


	protected function _prepareButtons()
	{
		$this->addButton('attribute_id',['title' => 'Add New','url' => $this->getUrl('add','eav_attribute')]);
		return parent::_prepareButtons();
	}
}
