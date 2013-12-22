<?php namespace Entityinator\Entityapi\Models;

class Entity extends \Eloquent {
	
	public function parent()
	{
		return $this->belongsTo('Entityinator\Entityapi\Models\Entity', 'parent_id', 'id');
	}
	
	public function siblings()
	{
		return $this->hasMany('Entityinator\Entityapi\Models\Entity', 'parent_id', 'id');
	}
	
	public function fields()
	{
		return $this->belongsToMany('Entityinator\Entityapi\Models\Field')
			->withPivot('entity_field_value', 'entity_id', 'field_id', 'sort_order')
			->orderBy('sort_order');
	}

	public function entity_field_value(\Entityinator\Entityapi\Models\Field $field)
	{
		return Field::make($field);
	}
}