<?php
namespace app\Classes;

class Validate {
    private $_passed = false;
    private $_errors = array();
    private $_db = null;

    public function __construct() {
        // $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()) {

 
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = $source[$item];
                $item = htmlentities($item, ENT_QUOTES, 'UTF-8');

                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required");
                } elseif (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                            break;

                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                            }
                            break;

                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError("{$item} must match {$rule_value}.");
                            }
                            break;

                        case 'unique':
                            // Assuming you have a database class and method to check uniqueness.
                            // $check = $this->_db->get($rule_value, array($item, '=', $value));

                            if ($check->count()) {
                                $this->addError("{$item} already exists.");
                            }
                            break;
                    }
                }
            }
        }

        if(empty($this->_errors)) {
            $this->_passed = true;
        }
    }

    private function addError($error) {
        $this->_errors[] = $error;
    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }
}