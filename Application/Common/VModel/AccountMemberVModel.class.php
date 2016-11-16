<?php
namespace Common\VModel;
use Think\Model\ViewModel;
class AccountMemberVModel extends ViewModel{
    public $viewFields=array(
        'account'=>array('*','_type'=>'left'),
        'member'=>array('*','_on'=>'account.uid=member.uid')
    );   
}
?>