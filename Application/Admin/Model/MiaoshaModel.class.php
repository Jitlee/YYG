<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class MiaoshaModel extends RelationModel{
    protected $_link = array(
        'Category'=>array(
            'mapping_type'      		=> self::BELONGS_TO,
            'class_name'        		=> 'Category',
            'mapping_name'			=> 'category',
            'foreign_key'			=> 'cid',
            'parent_key' 			=> 'cid',
        ),
        'brand'=>array(
            'mapping_type'      		=> self::BELONGS_TO,
            'class_name'        		=> 'brand',
            'mapping_name'			=> 'brand',
            'foreign_key'			=> 'bid',
            'parent_key' 			=> 'bid',
		),
//      'GoodsImages'=>array(
//          'mapping_type'      		=> self::HAS_MANY,
//          'class_name'        		=> 'GoodsImages',
//          'mapping_name'			=> 'images',
//          'foreign_key'			=> 'gid',
//          'parent_key' 			=> 'gid',
//  			'mapping_order' 			=> 'id asc',
//		),
    );
}