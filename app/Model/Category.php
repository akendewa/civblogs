<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Blog $Blog
 */
class Category extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

  public $actsAs = array('Utils.Sluggable' =>
        array(
            'label' => 'name',
            'separator' => '-',
            'method' => 'multibyteSlug'
        )
   );
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Blog' => array(
			'className' => 'Blog',
			'joinTable' => 'blogs_categories',
			'foreignKey' => 'category_id',
			'associationForeignKey' => 'blog_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
