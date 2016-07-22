function getHighstock(_id, _container, _title, _series, _url){
	$.getJSON(_url + _id, function(data){
		
		$(_container).highcharts('StockChart', {
			chart : {
				animation : true,
				backgroundColor : '#f7f7f7',
				borderColor : '#ff0000'
			},
				
			lang : {
					months : [
						'一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'
					],
					weekdays : [
						'周日','周一','周二','周三','周四','周五','周六'
					],
					
					printChart : '打印图表',
					downloadPNG : '下载PNG图片', 
					downloadJPEG : '下载JPEG图片',
					downloadPDF : '下载PDF文档',
					downloadSVG : '下载SVG矢量图' 
			},
				
			credits : {
					enabled : false	
			},
				
			xAxis : {
					categories : ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
					tickPixelInterval : 1000,
					type : 'datetime',
					title : {
						text : '时间'
					},

					dateTimeLabelFormats : {
						second : '%Y-%b-%e %H:%M:%S.%L'
					}
			},
				
			yAxis : {
					title : {
						text : '汇率'
					}
			},
				
			date : {
					dateformat : 'YYYY-mm-dd'
			},
				
			navigator : {
					enabled : true,
					maskFill : 'rgba(252, 142, 65, 0.85)'
			},
				
			plotOptions : {
					series : {
						animation : {
							duration : 3000
						},
						fillColor : '#ab4c0a'
					}
			},
				
			rangeSelector : {
					selected : 1
       },
				
       title : {
        	text : _title
       },
				
			scrollbar : {
					barBackgroundColor : 'gray',
					barBorderRadius : 0
			},
				
      series : [{
        	      name : _series,
                data : data,
								color : '#fc8e41'
             }],
						 
			tooltip: {
										enabled : true,
										backgroundColor : 'rgba(255, 225, 225, 0.85)',
										borderColor : 'ff0000',
                    valueDecimals: 2
                }
			}, function(chart){
				
						// apply the date pickers
						setTimeout(function () {
                $('input.highcharts-range-selector', $(chart.container).parent())
                    .datepicker();
            }, 0);
			});
			
			$.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText) {
            this.onchange();
            this.onblur();
        }
    });
			
		$.datepicker.regional['zh-CN'] = {
								closeText: '关闭',
                prevText: '<',
                nextText: '>',
                currentText: '今天',
                monthNames: ['一月','二月','三月','四月','五月','六月',
                '七月','八月','九月','十月','十一月','十二月'],
                monthNamesShort: ['一','二','三','四','五','六',
                '七','八','九','十','十一','十二'],
                dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
                dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
                dayNamesMin: ['日','一','二','三','四','五','六'],
                weekHeader: '周',
                showMonthAfterYear: true,
		};
		
		$.datepicker.setDefaults($.datepicker.regional['zh-CN']);
			
		Highcharts.setOptions({
        lang: {
            shortMonths: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            weekdays: ['周日','周一','周二','周三','周四','周五','周六'],
            rangeSelectorFrom: '起始',
            rangeSelectorTo: '终止',
            rangeSelectorZoom: '缩放'
				}
		});
	})
	
}