<?php namespace Entityinator\Entityapi\Models;

class Field extends \Eloquent {
	
	public static $INTEGER = 'integer';
	// Fields have no need for timestamps
	public $timestamps = false;
	
	public function entities()
	{
		return $this->belongsToMany('Entityinator\Entityapi\Models\Entity')
			->withPivot('entity_field_value', 'entity_id', 'field_id', 'sort_order')
			->orderBy('sort_order');
	}
	
	public static function make(\Entityinator\Entityapi\Models\Field $field)
	{
		$value = $field->pivot->entity_field_value;
		$field_type = $field->field_type;
		
		switch ($field_type) {
			default:
			case 'string':
				return $field_value;
			case 'integer':
				return intval($value);
		}
	}
}