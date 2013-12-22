<?php


class EntityTest extends TestCase {
	
	public function setUp()
	{
		parent::setUp();
		
		Artisan::call('migrate', array(
			'--bench' => 'entityinator/entityapi',
		));
	}
	
	public function testEntitySTIRelationship()
	{
		$main_entity = new Entityinator\Entityapi\Models\Entity;
		$main_entity->name = 'Hello Kitty';
		
		$this->assertTrue($main_entity->save());
		
		$child_entity = new Entityinator\Entityapi\Models\Entity;
		$child_entity->name = 'Hello Pussy';
		
		$child_entity = $main_entity->siblings()->save($child_entity);

		$this->assertEquals($main_entity->name, $child_entity->parent->name);
	}
	
	public function testEntityHasManyFields()
	{
		$entity = new Entityinator\Entityapi\Models\Entity;
		$entity->name = 'Hello Kitty';
		
		$this->assertTrue($entity->save());

		foreach (range(1, 10) as $id) {
			$field = new Entityinator\Entityapi\Models\Field;
			$field->name = 'Super Field '. $id;
			$field->field_type = 'integer';
			$field->save();
			
			$entity->fields()->attach(array(
				$field->id => array(
					'entity_field_value' => '1 + 1',
				)
			));
		}
		
		$this->assertEquals(10, count($entity->fields));
	}
	
	public function testEntityFieldValueRender()
	{
		$entity = new Entityinator\Entityapi\Models\Entity;
		$entity->name = 'Hello Kitty';
		
		$this->assertTrue($entity->save());
		
		foreach (range(1, 10) as $id) {
			$field = new Entityinator\Entityapi\Models\Field;
			$field->name = 'Super Field '. $id;
			$field->field_type = 'integer';
			$field->save();
			
			$entity->fields()->save($field, ['entity_field_value' => 1 + $id, 'sort_order' => $id]);
		}
		
		$field = $entity->fields->last();
		
		$this->assertTrue(is_int($entity->entity_field_value($field)));
	}
	
}