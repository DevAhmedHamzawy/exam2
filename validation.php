<?php 
class Validation{
	
    public $required_fields;
    public $fields_with_max_length;
    public static $errors = array();
    
    // get field name 
    public function fieldname_as_text($field_name){
      $field_name = str_replace("_"," ",$field_name);
      $field_name = ucfirst($field_name);
      return $field_name;
    }


    // * presence
    // use trim() so empty spaces don't count
    // use === to avoid false positives
    // empty() would condsider "0" to be empty
    public static function has_presence($value){
      return isset($value) && $value !== "";  
    }


    public static function validate_presence($required_fields){
      foreach($required_fields as $field => $value){
        $value = trim($value);
        if(!self::has_presence($value)){
          self::$errors[$field] = self::fieldname_as_text($field)." can't be blank";
          echo self::$errors[$field];
        }
      }
    }
 
  
    // validate email
    public static function validate_email($required_fields){
      foreach($required_fields as $field => $value){
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) { return true; } else { return false; }
      }
    }
}  