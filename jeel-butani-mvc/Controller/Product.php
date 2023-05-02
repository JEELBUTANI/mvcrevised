<?php 
class Controller_Product extends Controller_Core_Action 
{
	public function gridAction()
	{
			$query = "SELECT * FROM `product` WHERE 1";
			$adapter = $this->getAdapter();
			$products = $adapter->fetchAll($query);
			if (!$products) {
				throw new Exception("products not found.", 1);
			}
			require_once 'view/product/grid.phtml';
	}

	public function addAction()
	{
			require_once 'view/product/add.phtml';
	}

	public function insertAction()
	{
			$request = $this->getRequest();
			$postData = $request->getPost('product');
			$query = "INSERT INTO `product`(`name`, `cost`, `price`, `sku`, `status`, `description`) VALUES ('$postData[name]','$postData[cost]','$postData[price]','$postData[sku]','$postData[status]','$postData[description]')";
			$adapter = $this->getAdapter();
			$adapter->insert($query);
			header("Location:index.php?c=Product&a=grid");
	}

	public function editAction()
	{
			$request = $this->getRequest();
			$id = $request->getParams('id');
			$query = "SELECT * FROM `product` WHERE `product_id`={$id}";
			$adapter = $this->getAdapter();
			$productRow = $adapter->fetchRow($query);
			require_once 'view/product/edit.phtml';
	}

	public function updateAction()
	{
			$request = $this->getRequest();
			$postData = $request->getPost('Product');
			$id = $request->getParams('id');
			$query  = "UPDATE `product` SET 
								 `name`='$postData[name]',
								 `sku`='$postData[sku]',
								 `created_at`='$postData[created_at]',
								 `updated_at`='$postData[updated_at]',
								 `description`='$postData[description]',
								 `cost`='$postData[cost]',
								 `price`='$postData[price]',
								 `status`='$postData[status]'
								 WHERE `product_id` = {$id}";
			$adapter = $this->getAdapter();
			$adapter->update($query);
			header("Location:index.php?c=Product&a=grid");
	}

	public function deleteAction()
	{
		$request = $this->getRequest();
		$id = $request->getParams('id');
		$query = "DELETE FROM `product` WHERE `product_id` = {$id}";
		$adapter = $this->getAdapter();
		$adapter->update($query);
		header("Location:index.php?c=Product&a=grid");
	}

}
?>