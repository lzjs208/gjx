window.onload = function() {
	$('#vvcode').bind('keypress', function(event) {
		if (event.keyCode == "13") {
			$("#submit").click();
		}
	});
	// 统计图数据全局
	var chartData;

	// 用户信息下拉
	$("#u_info").click(function() {
		$("#u_list").slideToggle();
	});
	$("#u_list").children("li").on('click', function() {
		$("#u_list").slideToggle();
	});
	// 选择语言下拉
	$("#checkLang").click(function() {
		$("#checkLang").css('display', 'none');
		$("#dropdownul").slideToggle();
	});
	$("#dropdownul").children("li").on('click', function() {
		$("#dropdownul").slideToggle();
	});
	// banner下面的切换效果
	var quotation = document.getElementsByClassName('quotation')[0],
		qLi = quotation.getElementsByTagName('li'),
		index = 0;


	for (var i = 0; i < qLi.length; i++) {
		qLi[i].onmouseover = function() {
				for (var i = 0; i < qLi.length; i++) {
					qLi[i].x = i;
					qLi[i].className = '';
					qLi[i].onclick = function() {
						this.className = 'active';
						index = this.x;
					}
				}
			}
			// 离开时
		qLi[i].onmouseout = function() {
			qLi[index].className = 'active';
		}
	}
	var all = new Vue({
		el: '#all',
		username: '', // 账户名
		password: '', // 密码
		vcode: '', // 验证码

		data: {
			language: localStorage.langue,
			isLogin: 0, // 是否登录
//			pageData: lang,
//			error: error,
			price: {
				'close': 0, // 当前价
				'low': 0, // 最低价
				'high': 0, // 最高价
				'increase': 0, // 平均价
				'vol': 0 // 成交价
			}
		},
		verification: 'http://www.gggtrade.com/common/GetVerificationCode',
		methods: {
			// 登陆
			login: function() {
				var _this = this;
				var res = this.checkLog();
				if (res) {
					$.post(
						'http://www.gggtrade.com/Login/Login', {
							"username": _this.username,
							"password": _this.password,
							"VerificationCode": _this.vcode
						},
						function(data) {
							if (data.status == "success") {
								localStorage.isLogin = 1;
								localStorage.loginTime = Date.parse(new Date());
								_this.isLogin = localStorage.isLogin;

								layer.msg(error['100105'], {
									icon: 1
								});
								setTimeout(function() {
									location.href = "/pc/uc";
								}, 1000);
							} else if (data.status == "failed") {
								layer.msg(error[data.errorcode], {
									icon: 2
								});
								_this.refreshVerification();
							} else {
								layer.msg(error['100104'], {
									icon: 2
								});
								_thisthis.refreshVerification();
							}
						},
						'json'
					);
				} else {
					layer.msg(error['100103'], {
						icon: 2
					});
				}
			},
			checkLog: function() {
				var reg_name = /^[0-9a-zA-Z]{6,16}$/i;
				if (!this.username || !this.password || !this.vcode) {
					return false;
				}
				if (!reg_name.test(this.username)) {
					return false;
				}
				if (this.password.length < 6 || this.password.length > 16) {
					return false;
				}
				if (this.vcode.length != 4) {
					return false;
				}
				return true;
			},
			//LTC/GC
			LTC: function() {
				this.getPriceInfo("LTC");
				this.loadLineData("LTC");
			},
			CNY: function() {
				this.getPriceInfo("CNY");
				this.loadLineData("CNY");
			},
			BTC: function() {
				this.getPriceInfo("BTC");
				this.loadLineData("BTC");
			},
			getPriceInfo: function(type) {
				var _this = this;
				$.post('http://www.gggtrade.com/market/getpriceinfo', {
					'type': type
				}, function(data) {
					if (data.status == "success") {
						_this.$set('price', data.data);
					} else {
						layer.msg(error[data.errorcode]);
					}
				}, 'json')
			},
			refreshVerification: function() {
				$("#verify_code").attr("src",
					"http://www.gggtrade.com/common/GetVerificationCode?r=" + Math.random()
				);
			},
			loadLineData: function(type) {
				$.post(
					'http://www.gggtrade.com/market/indexQuote', {
						'type': type,
					},
					function(data) {
						if (data.status == "success") {
							chartData = data.data;
							console.log(chartData);
							var chart = AmCharts.makeChart("chartdiv", {

								type: "stock",

								categoryAxesSettings: {
									minPeriod: "mm"
								},

								dataSets: [{
									color: "#d73240",
									fieldMappings: [{
										fromField: "value",
										toField: "value"
									}, {
										fromField: "volume",
										toField: "volume"
									}],

									dataProvider: chartData,
									categoryField: "date"
								}],


								panels: [{
										showCategoryAxis: false,
										title: "Value",
										percentHeight: 70,

										valueAxes: [{
											id: "v1"
										}],

										stockGraphs: [{
											id: "g1",
											valueField: "value",
											type: "smoothedLine",
											lineThickness: 2,
											bullet: "round"
										}],

										stockLegend: {
											valueTextRegular: " ",
											markerType: "none"
										}
									},



									{
										title: "Volume",
										percentHeight: 30,

										stockGraphs: [{
											valueField: "volume",
											type: "column",
											cornerRadiusTop: 2,
											fillAlphas: 1
										}],

										stockLegend: {
											valueTextRegular: " ",
											markerType: "none"
										}
									}
								],

								chartScrollbarSettings: {
									graph: "g1",
									usePeriod: "10mm",
									position: "top",
									updateOnReleaseOnly: false
								},

								chartCursorSettings: {
									valueBalloonsEnabled: true,
									valueLineBalloonEnabled: true,
									valueLineEnabled: true
								},

								 periodSelector: {
								 	position: "bottom",
								 	dateFormat: "YYYY-MM-DD HH:NN",
								 	inputFieldWidth: 150,
								 	periods: [{
								 		period: "hh",
								 		count: 1,
								 		label: "1 hour",
								 		selected: true
								
								 	}, {
								 		period: "hh",
								 		count: 2,
								 		label: "2 hours"
								 	}, {
								 		period: "hh",
								 		count: 5,
								 		label: "5 hour"
								 	}, {
								 		period: "hh",
								 		count: 12,
								 		label: "12 hours"
								 	}, {
								 		period: "MAX",
								 		label: "MAX"
								 	}]
								 },

								panelsSettings: {
									usePrefixes: true
								}
							});

						} else {
							layer.msg(error[data.errorcode]);
						}
					},
					'json'
				)
			}

		},
		ready: function() {
			this.refreshVerification();
			this.getPriceInfo("CNY");
			this.loadLineData("CNY");
			console.log(lang);
		}
	})
}
