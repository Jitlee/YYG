<?php
namespace Home\Model;
use Think\Model\RelationModel;
class CartModel extends RelationModel{
    protected $_link = array(
        'Miaosha'=>array(
            'mapping_type'      		=> self::BELONGS_TO,
            'class_name'        		=> 'Miaosha',
            'mapping_name'			=> 'good',
            'mapping_fields'			=> 'title,qishu,thumb,shengyurenshu,danjia',
            'foreign_key'			=> 'gid',
            'parent_key'				=> 'gid',
            ),
        );
}