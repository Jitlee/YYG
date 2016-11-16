<?php
namespace Common\VModel;
use Think\Model\ViewModel;
class MemberRankVModel extends ViewModel{
    public $viewFields=array(
        'member'=>array('*','_type'=>'left'),
        'rank'=>array('sort','_on'=>'member.rank_id=rank.rank_id')
    );   
}
?>