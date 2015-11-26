<?php
namespace Home\Model;
use Think\Model\RelationModel;
class CartModel extends RelationModel{
    protected $_link = array(
        'Miaosha'=>array(
            'mapping_type'      		=> self::BELONGS_TO,
            'class_name'        		=> 'Miaosha',
            'mapping_name'			=> 'good',
            'mapping_fields'			=> 'gid,title,qishu,thumb,shengyurenshu,danjia,type',
            'foreign_key'			=> 'gid',
            'parent_key'				=> 'gid',
            'condition'				=> 'type<>3',
            ),
            
    		'Paimai'=>array(
            'mapping_type'      		=> self::BELONGS_TO,
            'class_name'        		=> 'Paimai',
            'mapping_name'			=> 'paimai',
            'mapping_fields'			=> 'gid,title,thumb,qipaijia,lijijia,baozhengjin',
            'foreign_key'			=> 'gid',
            'parent_key'				=> 'gid',
            'condition'				=> 'type=3',
            ),
        );
}