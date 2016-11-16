<?php
namespace Common\VModel;
use Think\Model\ViewModel;
class BangkanUserVModel extends ViewModel{
    public $viewFields=array(
        'bangkan'=>array('*','_type'=>'left'),
        'wx_user'=>array('*','_on'=>'wx_user.wx_id=bangkan.wx_id'),
        'member'=>array('mobile','username','_on'=>'member.uid=bangkan.uid')
    );   
}
?>