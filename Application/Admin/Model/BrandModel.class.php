<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class BrandModel extends RelationModel{
    protected $_link = array(
        'Category'=>array(
            'mapping_type'      		=> self::MANY_TO_MANY,
            'class_name'        		=> 'Category',
            'mapping_name'			=> 'categories',
            'foreign_key'			=> 'bid',
            'relation_foreign_key' 	=> 'cid',
            'relation_table'			=> 'yyg_category_has_brand',
        ),
    );
}