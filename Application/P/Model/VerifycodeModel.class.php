<?php
namespace P\Model;


class VerifycodeModel extends BaseModel{
	
 
	
	//http://localhost:505/index.php/M/Verifycode/Check/mobile/18617097726/code/7843
	public function Check($mobile,$code)
	{
		$sql="select * from yyg_verifycode
where mobile='$mobile' and createTime > date_add(now(),interval -50 minute) and `code`='$code'  and codestatus=0
order by createTime desc limit 1 ";

		$rd = array('status'=>-1);
		$num= M()->query($sql);
 		if($num) {
 			$id=(int)$num[0]["codeid"];
			if($id>0)
			{
				$m = M('verifycode');
				$data["codestatus"] = 1;
				$m->where("codeid=".$id)->save($data);				 
				$rd['status']= 1;
			}
		}
		return $rd;
	}
	
	
   
}