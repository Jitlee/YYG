<?php
namespace P\Model;
use Think\Model;

class SaidanModel extends Model{
	
	 public function GetDataItem($gid,$qishu)
	 {
		$fit['gid'] = $gid;
		$fit['qishu'] = $qishu;
				
		$db=M("miaosha_history");					
		$sdmain= $db->where($fit)->find();
		return $sdmain;
	}
	 
	 
		 

		   	
}
    