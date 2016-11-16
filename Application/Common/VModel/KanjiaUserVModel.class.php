<?php
namespace Common\VModel;
use Think\Model\ViewModel;
class KanjiaUserVModel extends ViewModel{
    public $viewFields=array(
        'kanjia'=>array('*','_type'=>'left'),
        'wx_user'=>array('*','_on'=>'wx_user.wx_id=kanjia.wx_id'),
        'member'=>array('uid','password','mobile','username','time'=>'reg_time','_on'=>'member.uid=kanjia.uid'),
    );   
}
?>