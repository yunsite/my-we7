<?php defined('IN_IA') or exit('Access Denied');?><?php  include template('common/header', TEMPLATE_INCLUDEPATH);?>
	<div class="main">
		<form action="" method="post" class="form-horizontal form" onsubmit="return formcheck(this)" id="form">
			<h4>全局设置</h4>
			<table class="tb">
				<tr>
					<th>授权地址安全模式</th>
					<td>
						<label for="radio_1" class="radio inline"><input type="radio" name="authmode" id="radio_1" value="1" <?php  if(empty($_W['setting']['authmode']) || $_W['setting']['authmode'] == 1) { ?> checked<?php  } ?> /> 宽松</label>
						<label for="radio_0" class="radio inline"><input type="radio" name="authmode" id="radio_0" value="2" <?php  if(!empty($_W['setting']['authmode']) && $_W['setting']['authmode'] == 2) { ?> checked<?php  } ?> /> 严格</label>
						<div class="help-block">设置严格模式时，系统提供给用户的授权地址时效为3分钟，在这个时间内用户没有点击则失效。并且在严格模式下，授权地址为一次性地址，用户点击后该地址自动失效。但不会影响已授权过的用户。</div>
					</td>
				</tr>
			</table>
			<table class="tb">
				<tr>
					<th></th>
					<td>
						<button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					</td>
				</tr>
			</table>
			<h4>邮件设置</h4>
			<table class="tb">
				<tr>
					<th>SMTP服务器</th>
					<td>
						<label for="radio_3" class="radio inline"><input type="radio" name="smtp[type]" id="radio_3" value="1" <?php  if($_W['setting']['mail']['smtp']['type'] == 1 || empty($_W['setting']['mail']['smtp']['type'])) { ?> checked<?php  } ?> onclick="$('#smtp').hide();"/> QQ服务器（建议使用，需要SSL）</label>
						<label for="radio_5" class="radio inline"><input type="radio" name="smtp[type]" id="radio_5" value="3" <?php  if($_W['setting']['mail']['smtp']['type'] == 3 || empty($_W['setting']['mail']['smtp']['type'])) { ?> checked<?php  } ?> onclick="$('#smtp').hide();"/> 163服务器</label>
						<label for="radio_4" class="radio inline"><input type="radio" name="smtp[type]" id="radio_4" value="2" <?php  if($_W['setting']['mail']['smtp']['type'] == 2) { ?> checked<?php  } ?> onclick="$('#smtp').show();" /> 自定义</label>
						<div class="help-block">SMTP服务器为发送邮件的服务器，微擎程序内置了QQ的邮件服务器的信息，可直接使用。如果有特殊需要请自定义SMTP服务器</div>	
					</td>
				</tr>
			</table>
			<table class="tb" id="smtp" style="display:none;">
				<tr>
					<th>SMTP服务器地址</th>
					<td>
						<input type="text" name="smtp[server]" class="span6" value="<?php  echo $_W['setting']['mail']['smtp']['server'];?>" />
						<div class="help-block">指定SMTP服务器的地址</div>	
					</td>
				</tr>
				<tr>
					<th>SMTP服务器端口</th>
					<td>
						<input type="text" name="smtp[port]" class="span2" value="<?php  echo $_W['setting']['mail']['smtp']['port'];?>" />
						<div class="help-block">指定SMTP服务器的端口</div>	
					</td>
				</tr>
				<tr>
					<th>使用SSL加密</th>
					<td>
						<label for="radio_5" class="radio inline"><input type="radio" name="smtp[authmode]" id="radio_5" value="1" <?php  if(!empty($_W['setting']['mail']['smtp']['qq'])) { ?> checked<?php  } ?> /> 是</label>
						<label for="radio_6" class="radio inline"><input type="radio" name="smtp[authmode]" id="radio_6" value="0" <?php  if(empty($_W['setting']['mail']['smtp']['authmode'])) { ?> checked<?php  } ?> /> 否</label>
						<div class="help-block">开启此项后，连接将用SSL的形式，此项需要SMTP服务器支持</div>	
					</td>
				</tr>
			</table>
			<table class="tb">
				<tr>
					<th>发送帐号用户名</th>
					<td>
						<input type="text" name="username" class="span6" value="<?php  echo $_W['setting']['mail']['username'];?>" />
						<div class="help-block">指定发送邮件的用户名，例如：123456@qq.com</div>	
					</td>
				</tr>
				<tr>
					<th>发送帐号密码</th>
					<td>
						<input type="password" name="password" class="span6" value="<?php  echo $_W['setting']['mail']['password'];?>" />
						<div class="help-block">指定发送邮件的密码</div>	
					</td>
				</tr>
				<tr>
					<th>发件人名称</th>
					<td>
						<input type="text" name="sender" class="span6" value="<?php  echo $_W['setting']['mail']['sender'];?>" />
						<div class="help-block">指定发送邮件发信人名称</div>
					</td>
				</tr>
				<tr>
					<th>邮件签名</th>
					<td>
						<textarea id="signature" style="height:150px;" name="signature" class="span7" cols="60"><?php  echo $_W['setting']['mail']['signature'];?></textarea>
						<div class="help-block">指定邮件末尾添加的签名信息</div>
					</td>
				</tr>
				<tr>
					<th>测试接收人</th>
					<td>
						<input type="text" name="receiver" class="span6" value="" />
						<div class="help-block"></div>
					</td>
				</tr>
			</table>
			<table class="tb">
				<tr>
					<th></th>
					<td>
						<button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
						<label for="radio_7" class="checkbox inline" style=" margin-left:10px;"><input type="checkbox" name="testsend" id="radio_7" value="1" checked /> 保存后发信给测试接收人</label>
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					</td>
				</tr>
			</table>
			<h4>系统锁操作</h4>
			<table class="tb">
				<tr>
					<th>删除升级锁</th>
					<td>
						<input name="bae_delete_update" type="submit" value="删除" class="btn" />
						<div class="help-block">升级“微擎”系统时，需要先删除升级锁，确保升级正常进行。</div>
					</td>
				</tr>
				<tr>
					<th>删除安装锁</th>
					<td>
						<input name="bae_delete_install" type="submit" value="删除" class="btn" />
						<div class="help-block">重新安装“微擎”系统时，需要先删除安装锁。</div>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<script type="text/javascript">
	kindeditor($('#signature'));
	</script>
<?php  include template('common/footer', TEMPLATE_INCLUDEPATH);?>
