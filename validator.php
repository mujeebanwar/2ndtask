<?php

class validator{

	//------Constructor-----//

	protected $handler;

	protected $errors=[];

	public $massages=[
	'required'=>'This  field is Required',
	'minlength'=>'This field must be minimum of :satisfy length',
	'maxlength'=>'This field must be maximum of :satisfy length',
	'email'=>'This is not Valid Email',
	'alnum'=>'This field must contain latters & numbers',
	'phone'=>'This field only contain number & xxx-xxx-xxxx this format'
	];


protected $rules=['required','maxlength','minlength','email','alnum','phone'];
	
	public function check($items,$rules){


		foreach ($items as $item=>$value) {
			
			if (in_array($item, array_keys($rules))) {
				
				$this->validate([

					'field'=>$item,
					'value'=>$value,
					'rules'=>$rules[$item]

				]);				

			}
		}
		return $this;


	}

	public function fails(){
		return $this->hasError();
	}
	

	protected function validate($item){

		$field=$item['field'];

		$value=$item['value'];


		foreach ($item['rules'] as $rule => $satisfied) {
			if (in_array($rule, $this->rules)) {
				
			if (!call_user_func_array([$this,$rule], [$field,$value,$satisfied])) {
			$error_fields=str_replace([':satisfy'], [$satisfied], 
			$this->massages[$rule]);
			
			$this->addErrors($error_fields,$field);
				}
				
			}
			
		}
		

	}

public function addErrors($errors,$key=null){

if ($key) {
	$this->errors[$key][]=$errors;
	}else{
		$this->errors[]=$errors;
	}

}

public function all($key=null){
	return isset($this->errors[$key]) ? $this->errors[$key] : $this->errors;
}
public function hasError(){

	return count($this->all()) ? true: false;
}

public function first($key){

	return isset($this->all()[$key][0]) ? $this->all()[$key][0] : '';
}

protected function required($field,$value,$satisfy){
		if (empty($_REQUEST[$field])) {
			return false;
		}else{
			return true;
		}
	}

	// protected function required($field,$value,$satisfy){

	// 	return !empty(trim($value));
	// }

	protected function minlength($field,$value,$satisfy){

		return mb_strlen($value)>=$satisfy;
	}

	protected function maxlength($field,$value,$satisfy){

		return mb_strlen($value)<=$satisfy;
	}

	protected function email($field,$value,$satisfy){
	if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/",$_REQUEST[$field]))
		 {
			return true;
		 }
		else{
			return false;
		}
		
	}

	protected function alnum($field,$value,$satisfy){
		if (preg_match('/^[a-zA-Z]+[\d]*$/', $value)) {
			return true;
		}else{
			return false;
		}
	}
protected function phone($field,$value,$satisfy){
	if (preg_match('/^[\d]{3}+-[\d]{3}+-[\d]{4}$/', $value)) {
		return true;
	}else{
		return false;
	}
}
}


?>