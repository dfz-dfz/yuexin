
$(function(){
	$('#icoMenu').click(function(){
		$('#sideNav').toggle();
	});

	$('#menuWrap .add').each(function(){
		$(this).amount(0, $.amountCb());
		for(var i = 0, num = parseInt($(this).data('num')); i < num; i++){
			$(this).click();
		}
	});

	var dialogTarget;
	$(document).on('click', '#menuWrap .price_wrap', function(e){
		e.stopPropagation();
	});
});

function showDetail(obj) {
	var id = obj.id;
	var _wraper = $('#menuDetail');

	$.get('http://122.152.226.249/app/index.php?i=6&c=entry&sid=13&do=GetSpec&m=str_takeout&did='+id+'', function(ret) {
		var ret = JSON.parse(ret);
		if(ret.status == 1){
			if(ret.data == ''){
				
			}else{
				var datas = ret.data,
					html = '';
				for(var i in datas){
					html += '<div class="choice_box choice1">';
						html += '<div class="title">'+datas[i].cateName+'</div>';
						html += '<div class="types types1">';
							for(var list in datas[i].list){
								html += '<label for="1" class="">'+datas[i].list[list].specName+'</label>';
							}
						html += '</div>';
					html += '</div>';
				}

				$('.checkBox').html(html)
				$('.types label:first-child').addClass('isChecked');
				// <div class="choice_box choice1">
				// 	<div class="title">主食</div>
				// 	<div class="types types1">
				// 		<label for="1" class="isChecked">羊排</label>
				// 		<label for="2">牛排</label>
				// 	</div>
				// </div>

				// <div class="choice_box choice2">
				// 	<div class="title">飲料</div>
				// 	<div class="types types2">
				// 		<label class="isChecked">牛奶</label>
				// 		<label>咖啡</label>
				// 		<label>奶茶</label>
				// 		<label>湯</label>
				// 	</div>
				// </div>
						
				// <div class="choice_box choice3">
				// 	<div class="title">溫度</div>
				// 	<div class="types types3">
				// 		<label class="isChecked">正常冰</label>
				// 		<label>少冰</label>
				// 		<label>常溫</label>
				// 		<label>熱<span>$5</span></label>
				// 	</div>
				// </div>

				var _this = $(obj),
					F = function(str){return _this.find(str);},
					title = F('h3').text(),
					imgUrl = F('img').attr('src'),
					price = F('.unit_price').text(),
					sales = F('.sales strong').attr('class'),
					saleNum = F('.sale_num').text(),
					info = F('.info').text(),
					_detailImg = _wraper.find('img');
				saleunit=F('.sale_unit').text();

				_wraper.find('.price').text(price).end()
					.find('.sales strong').attr('class', sales).end()
					.find('.sale_num').text(saleNum).end()
					.find('.info').text(info);

				_wraper.parents('.dialog').find('.dialog_tt').text(title);

				if(F('.add').length){
					$('#detailBtn').removeClass('disabled').text('加入購物車');
				}else{
					$('#detailBtn').addClass('disabled').text('已售完');
				}

				if(imgUrl){
					_detailImg.attr('src', imgUrl).show().next().hide();
				}else{
					_detailImg.hide().next().show();
				}

				dialogTarget = _this;
				// $('#detailBtn').unbind();
			//	$('#detailBtn').click(function(){
			//		if(!$(this).hasClass('detail')){
			//			dialogTarget.find('.add ').click();
			//		}
			//	});
				_wraper.dialog({title: title, closeBtn: true});
			}
		}else{
			alert('網絡請求失敗!')
			return false;
		}
	});
}
