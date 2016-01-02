<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="/Public/P/css/Comm.css" />
		<style type="text/css">
			body {
				padding:0 10px;
			}
			.yyg-record-table{
				width: 100%;
				border: 0;
				font-size: 12px;
				table-layout: fixed;
				text-align: left;
			}
			
			.yyg-record-table th {
				background-color: #eee;
				color: #666;
				border: 0;
				margin: 0;
				height: 30px;
				line-height: 30px;
			    padding-left: 10px;
			}
			.yyg-record-table td{
				height: 45px;
				line-height: 45px;
			    border-bottom:1px dashed #eee;
			    color: #333;
			    padding-left: 10px;
			}
			
		</style>
	</head>
	<body>
		<table class="yyg-record-table" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<th style="width:40px"></th>
					<th>会员</th>
					<th>云购次数</th>
					<th>时间</th>
				</tr>
				<?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
					<td><img src="<?php echo ((isset($item["img"]) && ($item["img"] !== ""))?($item["img"]):'/Public/P/images/member.png'); ?>" height="20" width="20" alt=""/></td>
					<td><?php echo ($item["username"]); ?></td>
					<td><?php echo ($item["count"]); ?></td>
					<td><?php echo ($item["time"]); ?></td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<?php if($num < $total): ?><div class="pagesx">
				<ul id="Page_Ul">
					<li id="Page_Total"><?php echo ($total); ?>条</li>
					<li id="Page_One"><a href="<?php echo U('Index/record', '', '');?>/<?php echo ($gid); ?>/<?php echo ($qishu); ?>/1">首页</a></li>
					<?php if($pageNo > 1): ?><li id="Page_Prev"><a href="<?php echo U('Index/record', '', '');?>/<?php echo ($gid); ?>/<?php echo ($qishu); ?>/<?php echo ($pageNo - 1); ?>">上一页</a></li><?php endif; ?>
					<?php if($pageNo > 1): $__FOR_START_394795707__=$minPageNo;$__FOR_END_394795707__=$pageNo;for($i=$__FOR_START_394795707__;$i < $__FOR_END_394795707__;$i+=1){ ?><li class="Page_Num"><a href="<?php echo U('Index/record', '', '');?>/<?php echo ($gid); ?>/<?php echo ($qishu); ?>/<?php echo ($i); ?>"><?php echo ($i); ?></a></li><?php } endif; ?>
					<li class="Page_This"><?php echo ($pageNo); ?></li>
					<?php $__FOR_START_700839518__=$pageNo+1;$__FOR_END_700839518__=$maxPageNo+1;for($i=$__FOR_START_700839518__;$i < $__FOR_END_700839518__;$i+=1){ ?><li class="Page_Num"><a href="<?php echo U('Index/record', '', '');?>/<?php echo ($gid); ?>/<?php echo ($qishu); ?>/<?php echo ($i); ?>"><?php echo ($i); ?></a></li><?php } ?>
					<?php if($pageNo < $pageCount): ?><li id="Page_Next"><a href="<?php echo U('Index/record', '', '');?>/<?php echo ($gid); ?>/<?php echo ($qishu); ?>/<?php echo ($pageNo + 1); ?>">下一页</a></li><?php endif; ?>
					<li id="Page_End"><a href="<?php echo U('Index/record', '', '');?>/<?php echo ($gid); ?>/<?php echo ($qishu); ?>/<?php echo ($pageCount); ?>">尾页</a></li>
				</ul>
			</div><?php endif; ?>
	</body>
</html>