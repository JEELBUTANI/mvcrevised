<?php

class Controller_Core_Front
{
	protected $request=null;
	public function setRequest(Model_Core_Request $request)
	{
		$this->request=$request;
		return $this;
	}
	public function getRequest(){
		if($this->request){
			return $this->request;
		}
		$request=new Model_Core_Request();
		$this->setRequest($request);
		return $request;
	}
	public function init(){
		// echo 111; die();
		$request= new Model_Core_Request();
		$controller = $request->getControllerName();

		if($controller=='index'){
			header('location: http://localhost/1-5/Index.php?c=product&a=grid');
		}
		
		$controller='Controller_'.ucwords($controller,'_');
		$controllerClassPath=str_replace('_','/',$controller);
		require_once "{$controllerClassPath}.php";
		$controllernew=new $controller();
		$actionName=$request->getActionName()."Action";
		$controllernew->$actionName();
		
	}
}

?>