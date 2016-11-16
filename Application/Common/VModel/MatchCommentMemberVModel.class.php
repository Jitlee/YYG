<?php
namespace Common\VModel;
use Think\Model\ViewModel;
class MatchCommentMemberVModel extends ViewModel{
    public $viewFields=array(
        'jc_comment'=>array('*','_type'=>'left'),
        'member'=>array('uid,username,mobile,img','_on'=>'jc_comment.uid=member.uid','_type'=>'left'),
        'jc_project'=>array('id,number,match_name,team1,team2,type','_on'=>'jc_comment.jcp_id=jc_project.jcp_id'),
    );   
}
?>