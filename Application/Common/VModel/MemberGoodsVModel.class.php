<?php
namespace Common\VModel;
use Think\Model\ViewModel;
class MemberGoodsVModel extends ViewModel{
    public $viewFields=array(
        'member_miaosha'=>array('*','_type'=>'left'),
        'miaosha'=>array('*','_on'=>'member_miaosha.gid=miaosha.gid')
    );   
}
?>