
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

var dishPrice = 0;
var _postUrl = '';
var did = 0;
function showDetail(obj) {
	var id = obj.id;
	did = id;
	var _wraper = $('#menuDetail');
	var _url = _wraper.attr('data-href');
	_postUrl = _wraper.attr('data-url');
	$.get(_url+'&did='+id+'', function(ret) {
		var ret = JSON.parse(ret);
		if(ret.status == 1){
			if(ret.data == ''){
				
			}else{
				var datas = ret.data['datalist'];
				dishPrice = parseFloat(ret.data['dishInfo']['price']);
					html = '';
				for(var i in datas){
					html += '<div class="choice_box choice1">';
						html += '<div class="title">'+datas[i].cateName+'</div>';
						html += '<div class="types types1" id="menu'+datas[i].id+'">';
							for(var list in datas[i].list){
                				var price = '';
                                if(Number(datas[i].list[list].price)){
                                    price = '￥'+datas[i].list[list].price;
                                }
								html += '<label for="" data-price="'+Number(datas[i].list[list].price)+'" id="item'+datas[i].list[list].id+'" onclick="chose('+datas[i].id+','+datas[i].list[list].id+')" data-id="'+datas[i].list[list].id+'" class="">'+datas[i].list[list].specName+' '+price+'</label>';
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
			total();
		}else{
			alert('網絡請求失敗!')
			return false;
		}
	});

}

function chose(menuid,itemid){
	$('#menu'+menuid+' label').removeClass('isChecked');
	$('#item'+itemid).addClass('isChecked');
	total();
}

function total(){
	var amount = 0;
	var item = $('.isChecked');
	var dataPrice = 0;
    for (var i = 0; i < item.length; i++) {
        var data = item[i].attributes['data-price'].value;
        dataPrice += parseFloat(data);
    }
    amount = dishPrice + dataPrice;
    $("#total").text(amount);
}

function addCart(d = '',u = ''){
	if(u){
		_postUrl = u;
	}
	if(d){
		did = d;
	}
	if(!_postUrl){
	    alert('參數錯誤');
    }
	var arr = new Array();
    var item = $('.isChecked');
    if(!d){
    	for (var i = 0; i < item.length; i++) {
	        var data = item[i].attributes['data-id'].value;
	        arr.push(data);
	    }
    }
   
    var data = {};
    data.did = did;
    data.spec = arr;
    $.ajax({
        type: "POST",
        url: _postUrl,
        data: data,
        success: function(msg){
            showCart();
        }

    })
}