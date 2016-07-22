<{include file="header.tpl" title=GTrade}>

<!--面包屑导航-->
<div class="crumbs">
	<span class="blue-color">当前位置：</span>
	<ul>
		<li><a href="javascript:void(0);" class="blue-color">首页&nbsp;&nbsp;&gt;</a></li>
		<li>&nbsp;&nbsp;参数设置</li>
	</ul>
</div>
<!--面包屑导航-->
<!--参数设置面板-->
<div class="wrapper-panel arg-panel">
	<ul id="args-panel" class="nav nav-tab">
		<li class="active"><a href="#cny" data-toggle="tab" aria-expanded="true">CNY汇率设置</a></li>
		<li><a href="#btc" data-toggle="tab" aria-expanded="true">BTC汇率设置</a></li>
		<li><a href="#ltc" data-toggle="tab" aria-expanded="true">LTC汇率设置</a></li>
		<li><a href="#upcash" data-toggle="tab" aria-expanded="true">单日提现GC</a></li>
		<li><a href="#upamount" data-toggle="tab" aria-expanded="true">提现总额</a></li>
		<li><a href="#cost" data-toggle="tab" aria-expanded="true">提现手续费</a></li>
		<li><a href="#gc" data-toggle="tab" aria-expanded="true">交易GC总额</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane active" id="cny">
			<span class="arg_set">CNY汇率设置</span><input type="hidden" class="args_type" value="cny"><input type="text" name="args_cny" class="form-control args_val" placeholder="CNY汇率设置"><button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">CNY参数设置记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">利率</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<{foreach from=$cny item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.val}></div>
						<div class="col"><{date("Y-m-d H:i:s",$value.times)}></div>
						<div class="col"><button type="button" data-id="<{$value.id}>">删除</button></div>
					</li>
					<{/foreach}>
					<!--data list-->
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="btc">
			<span class="arg_set">BTC汇率设置</span><input type="hidden" class="args_type" value="btc"><input type="text" name="args_btc" class="form-control args_val" placeholder="BTC汇率设置"><button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">BTC参数设置记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">利率</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<{foreach from=$btc item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.val}></div>
						<div class="col"><{date("Y-m-d H:i:s",$value.times)}></div>
						<div class="col"><button type="button" data-id="<{$value.id}>">删除</button></div>
					</li>
					<{/foreach}>
					<!--data list-->
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="ltc">
			<span class="arg_set">LTC汇率设置</span><input type="hidden" class="args_type" value="ltc"><input type="text" name="args_ltc" class="form-control args_val" placeholder="LTC汇率设置"><button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">LTC参数设置记录</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">利率</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<{foreach from=$ltc item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.val}></div>
						<div class="col"><{date("Y-m-d H:i:s",$value.times)}></div>
						<div class="col"><button type="button" data-id="<{$value.id}>">删除</button></div>
					</li>
					<{/foreach}>
					<!--data list-->
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="upcash">
			<span class="arg_set">提现GC设置</span><input type="hidden" class="args_type" value="up"><input type="text" name="args_up" class="form-control args_val" placeholder="单日提现GC"><button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">提现GC</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">金额</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<{foreach from=$up item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.val}></div>
						<div class="col"><{date("Y-m-d H:i:s",$value.times)}></div>
						<div class="col"><button type="button" data-id="<{$value.id}>">删除</button></div>
					</li>
					<{/foreach}>
					<!--data list-->
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="upamount">
			<span class="arg_set">单日提现总额</span><input type="hidden" class="args_type" value="amount"><input type="text" name="args_amount" class="form-control args_val" style="width:80%;" placeholder="单日提现总额">元<button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">提现总额</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">金额</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<{foreach from=$amount item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.val2}>元</div>
						<div class="col"><{date("Y-m-d H:i:s",$value.times)}></div>
						<div class="col"><button type="button" data-id="<{$value.id}>">删除</button></div>
					</li>
					<{/foreach}>
					<!--data list-->
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="cost">
			<span class="arg_set">提现手续费</span><input type="hidden" class="args_type" value="cost"><input type="text" name="args_cost" class="form-control args_val" style="width:80%;" placeholder="提现手续费"> %<button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">提现手续费</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">手续费</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<{foreach from=$cost item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.val2}>%</div>
						<div class="col"><{date("Y-m-d H:i:s",$value.times)}></div>
						<div class="col"><button type="button" data-id="<{$value.id}>">删除</button></div>
					</li>
					<{/foreach}>
					<!--data list-->
				</ul>
			</div>
		</div>
		<div class="tab-pane" id="gc">
			<span class="arg_set">交易GC总额</span><input type="hidden" class="args_type" value="gc"><input type="text" name="args_cost" class="form-control args_val" placeholder="提现手续费"><button type="button" class="btn args_btn">提 交</button>
			<div class="args_record">
				<div class="args_title">交易GC总额</div>
				<ul>
					<li class="rowl row_title">
						<div class="col">编号</div>
						<div class="col">GC总额</div>
						<div class="col">时间</div>
						<div class="col">操作</div>
					</li>
					<!--data list-->
					<{foreach from=$gc item=value}>
					<li class="rowl row_list">
						<div class="col"><{$value.id}></div>
						<div class="col"><{$value.val}></div>
						<div class="col"><{date("Y-m-d H:i:s",$value.times)}></div>
						<div class="col"><button type="button" data-id="<{$value.id}>">删除</button></div>
					</li>
					<{/foreach}>
					<!--data list-->
				</ul>
			</div>
		</div>
	</div>
</div>
<!--参数设置面板-->
<{include file="footer.tpl"}>