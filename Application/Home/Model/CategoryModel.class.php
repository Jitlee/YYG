<?php
namespace Home\Model;
use Think\Model\RelationModel;
class CategoryModel extends RelationModel{
    protected $_link = array(
        'Brand'=>array(
            'mapping_type'      		=> self::MANY_TO_MANY,
            'class_name'        		=> 'Brand',
            'mapping_name'			=> 'brands',
            'foreign_key'			=> 'cid',
            'relation_foreign_key' 	=> 'bid',
            'relation_table'			=> 'yyg_category_has_brand',
            ),
        );
}