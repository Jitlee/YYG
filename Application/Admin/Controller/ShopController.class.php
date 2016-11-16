<?php
namespace Admin\Controller;
use Think\Controller;
class ShopController extends CommonController {
    public function index($pageSize = 10, $pageNum = 1){
        $db=M('shop');
        $count = $db->where($filter)->count();
        if(!$pageSize) {
            $pageSize = 10;
        }
        $pageSize = 10;
        $pageNum = intval($pageNum);
        $pageCount = ceil($count / $pageSize);
        if($pageNum > $pageCount) {
            $pageNum = $pageCount;
        }
        $this->assign('pageSize', $pageSize);
        $this->assign('pageNum', $pageNum);
        $this->assign('count', $count);
        $this->assign('pageCount', $pageCount);
        $this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
        $this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
        
        $list = $db->where()->page($pageNum, $pageSize)->order("shop_id asc ")->select();
        $add_db=M('add');
        foreach ($list as $key => $value) {
            $list[$key]['province_name']=$add_db->where(array('addid'=>$value['province'],'addtype'=>0))->getField('addname');
            $list[$key]['city_name']=$add_db->where(array('addid'=>$value['city'],'addtype'=>1))->getField('addname');
            $list[$key]['area_name']=$add_db->where(array('addid'=>$value['area'],'addtype'=>2))->getField('addname');
            $list[$key]['address']=$list[$key]['province_name'].$list[$key]['city_name'].$list[$key]['area_name'].$list[$key]['address'];
        }
//      $this->shop_yongjinbili=M('config')->where(array('name'=>'shop_yongjinbili'))->getField('value');
        $this->shop_list=$list;
        $this->count=$count;
    	$this->assign('pid','shopmgr');
    	$this->assign('mid','shopmgr #index');
    	$this->display();
    }
    /*生成二维码页面*/
    public function qrcode($pageSize = 10, $pageNum = 1){
    	// 分页
		$db = M('qrcode');
		$count = $db->where($map)->count();
		if(!$pageSize) {
			$pageSize = 10;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));

		$list=$db->where()->order('qr_create_time asc')->page($pageNum, $pageSize)->select();
    	$this->list=$list;
    	$this->assign('title','生成二维码');
    	$this->assign('pid','shopmgr');
    	$this->assign('mid','shopmgr #qrcode');
    	$this->display();
    }

    /*生成二维码操作*/
    public function create_qrcode(){
    	if(!IS_AJAX)$this->error('非法操作');
    	$dianpu_zhanghao_arr=M('qrcode')->getField('dianpu_zhanghao',true);
    	$n=I('post.n');
    	if(empty($n)){
    		$n=1;
    	}
    	for ($i=0; $i < $n; $i++) { 
    		$name=$this->qr_rand(6);
    		$dianpu_zhanghao=$this->qr_rand2(6);
    		while(in_array($dianpu_zhanghao, $dianpu_zhanghao)){
    			$dianpu_zhanghao=$this->qr_rand2(6);
    		}
    		//生成二维码
			vendor("phpqrcode.phpqrcode");
            $data = C('ZDY').U('Home/Public/reg')."/?shop_id=".$name;
            // 纠错级别：L、M、Q、H
            $level = 'H';
            // 点的大小：1到10,用于手机端4就可以了
            $size = 10;
            // 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
            $path = "Uploads/qrcode/";
            // 生成的文件名
            $fileName = $path.$name.'.png';
            if(file_exists($fileName)){
            	continue;
            }
            $QRcode=new \QRcode();
            $QRcode::png($data, $fileName, $level, $size);
            $logo ='Public/images/logo.jpg';//准备好的logo图片 
			$QR = $fileName;//已经生成的原始二维码图   
            if ($logo !== FALSE) {   
			    $QR = imagecreatefromstring(file_get_contents($QR));   
			    $logo = imagecreatefromstring(file_get_contents($logo));   
			    $QR_width = imagesx($QR);//二维码图片宽度   
			    $QR_height = imagesy($QR);//二维码图片高度   
			    $logo_width = imagesx($logo);//logo图片宽度   
			    $logo_height = imagesy($logo);//logo图片高度   
			    $logo_qr_width = $QR_width / 5;   
			    $scale = $logo_width/$logo_qr_width;   
			    $logo_qr_height = $logo_height/$scale;   
			    $from_width = ($QR_width - $logo_qr_width) / 2;   
			    //重新组合图片并调整大小   
			    imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,   
			    $logo_qr_height, $logo_width, $logo_height);   
			}   
			//输出图片   
			imagepng($QR, $fileName);
			//保存信息到数据库
			$map[]=array(
				'qr_code'=>$name,
				'qr_link'=>$data,
				'qr_src'=>$fileName,
				'qr_create_time'=>time(),
				'dianpu_zhanghao'=>$dianpu_zhanghao,
				);
    	}
    	M('qrcode')->addAll($map);
    	$this->ajaxReturn(array('status'=>1,'info'=>'生成完毕'));
    }
    /*随机生成*/
    public function qr_rand($num){
    	$arr="abcdefghijklmnopqrstuvwxyz0123456789";
    	$len=strlen($arr);
    	for ($i=0; $i < $num ; $i++) { 
    		$rand=mt_rand(0,$len-1);
    		$str.=$arr[$rand];
    	}
    	return $str;
    }
    /*随机生成*/
    public function qr_rand2($num){
    	$arr="0123456789";
    	$len=strlen($arr);
    	for ($i=0; $i < $num ; $i++) { 
    		$rand=mt_rand(0,$len-1);
    		$str.=$arr[$rand];
    	}
    	return $str;
    }

    /*下载图片*/
    public function download(){
    	$src=I('get.src');
    	$name=I('get.name');
    	if(!empty($src)){
    		$filename = $src; 
			//文件的类型 
			header('Content-type: application/png'); 
			//下载显示的名字 
			header('Content-Disposition: attachment; filename="'.$name.'.png"'); 
			readfile("$filename"); 
			exit();    
    	}
    }

    /*查看店铺详情*/
    public function shop_detail(){
        $shop_id=I('get.shop_id');
        if(empty($shop_id)){
            $this->error('操作错误');
        }
        $shop_info=M('shop')->where(array('shop_id'=>$shop_id))->find();
        $add_db=M('add');
        $shop_info['province_name']=$add_db->where(array('addid'=>$shop_info['province'],'addtype'=>0))->getField('addname');
        $shop_info['city_name']=$add_db->where(array('addid'=>$shop_info['city'],'addtype'=>1))->getField('addname');
        $shop_info['area_name']=$add_db->where(array('addid'=>$shop_info['area'],'addtype'=>2))->getField('addname');
        $shop_info['address']=$shop_info['province_name'].$shop_info['city_name'].$shop_info['area_name'].$shop_info['address'];
        //账户明细
        $yongjin_info=M('shop_pay_record')->join('yyg_member ON yyg_shop_pay_record.uid=yyg_member.uid')->where(array('yyg_shop_pay_record.shop_id'=>$shop_id))->field('mobile,pay_time,pay_money,yyg_shop_pay_record.yongjin')->select();
        $this->yongjin_info=$yongjin_info;
        $this->info=$shop_info;
    	$this->assign('pid','shopmgr');
    	$this->assign('mid','shopmgr #index');
    	$this->display();
    }


    public function save_bili(){
        if(!IS_POST)$this->error('非法操作');
        $yongjinlibi=I('post.');
//      $rs=M('config')->where(array('name'=>'shop_yongjinbili'))->setField('value',$yongjinlibi['yongjinbili']);
        if($rs!==false){
            $this->ajaxReturn(array('status'=>1,'info'=>'保存成功'));
        }
        $this->ajaxReturn(array('status'=>0,'info'=>'保存失败'));
    }

    /*银行列表*/
    public function bank($pageSize = 10, $pageNum = 1){
        $db=M('bank');
        $count = $db->where($filter)->count();
        if(!$pageSize) {
            $pageSize = 10;
        }
        $pageSize = 10;
        $pageNum = intval($pageNum);
        $pageCount = ceil($count / $pageSize);
        if($pageNum > $pageCount) {
            $pageNum = $pageCount;
        }
        $this->assign('pageSize', $pageSize);
        $this->assign('pageNum', $pageNum);
        $this->assign('count', $count);
        $this->assign('pageCount', $pageCount);
        $this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
        $this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
        
        $list = $db->where()->page($pageNum, $pageSize)->select();
        $this->assign('list',$list);
        $this->assign('title','银行列表');
        $this->assign('pid','shopmgr');
        $this->assign('mid','shopmgr #bank');
        $this->display();
    }
    //添加银行卡
    public function bank_add(){
        if(!IS_POST)$this->error('非法操作');
        $data=I('post.');
        $rs=M('bank')->add($data);
        if($rs!==false)$this->ajaxReturn(array('status'=>1,'info'=>'添加成功'));
        $this->ajaxReturn(array('status'=>0,'info'=>'添加失败，请刷新候重试'));
    }
    //删除银行卡
    public function bank_del(){
        if(!IS_POST)$this->error('非法操作');
        $data=I('post.');
        $rs=M('bank')->where(array('bank_id'=>$data['id']))->delete();
        if($rs!==false)$this->ajaxReturn(array('status'=>1,'info'=>'删除成功'));
        $this->ajaxReturn(array('status'=>0,'info'=>'删除失败，请刷新候重试'));
    }
}