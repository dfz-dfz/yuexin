<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/swipe_min.js"></script>
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<script src="../addons/str_takeout/template/resource/js/iscroll-probe.js"></script>
<script src="../addons/str_takeout/template/resource/js/main.js?t=<?php echo time();?>"></script>
<script src="../addons/str_takeout/template/resource/js/menu.js?t=<?php echo time();?>"></script>
<script src="../addons/str_takeout/template/resource/js/common.js"></script>
<style type="text/css">
    <?php  if($store['comment_status'] == 1) { ?>
    .nav a{width:33.333%;}
    <?php  } ?>
</style>
<div class="container" onselectstart="return true;" ondragstart="return false;">
    <header class="top_nav"><a href="<?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&&do=index&m=<?php  echo $_W['current_module']['name'];?>"><img src="../addons/str_takeout/template/resource/images/close.png" alt=""></a>越新科技</header>
    <header class="nav menu">
        <div class="title_message">
            <div style="margin-bottom: 6px;">
                <span style="font-size: 12px;margin-right: 5px;"><a style="margin: 0;" href="<?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&&do=index&m=<?php  echo $_W['current_module']['name'];?>">[換門店]</a></span>
                <span style="margin-right:5px;font-size: 14px;color:#0f0f0f;"><?php echo $store['title'];?></span>
                <span style="font-size: 11px;"><?php echo $store['address'];?></span>
            </div>
            <div>
                <span style="font-size: 11px;margin-right: 5px;">聯繫電話：<?php echo $store['telephone'];?></span>
                <span style="font-size: 11px;">營業時間：<?php echo $store['business_hours'][0]['s'];?>-<?php echo $store['business_hours'][0]['e'];?></span>
            </div>
        </div>
        <div>
            <a href="javascript:void(0);" id="nav_btn1" class="on">點菜</a>
            <?php  if($store['comment_status'] == 1) { ?>
                <a href="javascript:void(0);" id="nav_btn2">評價</a>
            <?php  } ?>
            <!-- <a href="<?php  echo murl('mc/home');?>">会员中心</a> -->
        </div>
    </header>
    <section>
        <?php  if(!empty($store['thumbs']) && $store['slide_status'] == 1) { ?>
            <div id="imgSwipe" class="img_swipe" style="visibility: visible;">
                <ul style="width: 0px;">
                    <?php  if(is_array($store['thumbs'])) { foreach($store['thumbs'] as $li) { ?>
                        <li><a href="<?php  echo $li['url'];?>"><img src="<?php  echo tomedia($li['image']);?>" /></a></li>
                    <?php  } } ?>
                </ul>
                <ol id="swipeNum">
                    <?php  if(is_array($store['thumbs'])) { foreach($store['thumbs'] as $li) { ?>
                        <li class=""></li>
                    <?php  } } ?>
                </ol>
            </div>
        <?php  } ?>
    </section>
    <?php  if(!empty($store['notice'])) { ?>
        <div class="notice">
            <div class="notice-box">
                <div class="scrollNotice">
                <span class="js-scroll-notice">
                    公告: <?php  echo $store['notice'];?>
                </span>
                </div>
            </div>
        </div>
    <?php  } ?>
    <form name="cart_form" id="cart_form" action="<?php  echo $this->createMobileUrl('order', array('sid' => $sid, 'mode' => $mode), true);?>" method="post">
        <input type="hidden" name="more" value="<?php  echo $_GPC['more'];?>">
        <input type="hidden" name="dish_str" value="<?php  echo $dish_str;?>">
        <section class="menu_wrap <?php  if($store['dish_style'] == 1) { ?>skin1<?php  } ?>" id="menuWrap">
            <?php  if(!$store['business_hours_flag']) { ?>
                <div class="tips">本店休息中，<?php  echo $hour_str;?>营业</div>
            <?php  } ?>
            <?php  if($mode == 1 && !empty($table)) { ?>
                <div class="tips">您在 <?php  echo $table['ctitle'];?>-<?php  echo $table['title'];?> 点餐</div>
            <?php  } ?>
            <div id="menuNav" class="menu_nav">
                <div class="ico_menu_wrap clearfix"><span class="ico_menu" id="icoMenu"><i></i></span></div>
                <div class="side_nav" id="sideNav">
                    <ul>
                        <?php  if(is_array($category)) { foreach($category as $cate) { ?>
                            <?php  $i++;?>
                            <li><a href="javascript:void(0);" data-cid="<?php  echo $cate['id'];?>"><?php  echo $cate['title'];?></a></li>
                        <?php  } } ?>
                    </ul>
                </div>
            </div>
            <div class="menu_container">

                <?php  if(is_array($category)) { foreach($category as $cate_row) { ?>
                    <div class="menu_tt" id="cate-<?php  echo $cate_row['id'];?>"><h2><?php  echo $cate_row['title'];?></h2></div>
                    <ul class="menu_list">
                        <?php  if(is_array($cate_dish[$cate_row['id']])) { foreach($cate_dish[$cate_row['id']] as $ds) { ?>
                            <li id="<?php  echo $ds['id'];?>" class="xian" <?php  if($ds['total'] != 0 && $ds['spec']) { ?> onclick="showDetail(this)" <?php  } ?>>
                                <div class="top">
                                    <div>
                                        <?php  if(!empty($ds['label'])) { ?>
                                            <div class="dish_label"><?php  echo $ds['label'];?></div>
                                        <?php  } ?>
                                        <?php  if($ds['thumb']) { ?>
                                            <div><img src="<?php  echo tomedia($ds['thumb']);?>" alt=""></div>
                                        <?php  } else { ?>
                                            <div class="nopic"></div>
                                        <?php  } ?>
                                    </div>
                                    <div>
                                        <h3 style="font-size: 14px;color:#333;"><?php  echo $ds['title'];?></h3>
                                        <p style="font-size: 12px;color:#898989;">
                                            已售<span class="sale_num" style="font-size:12px;"><?php  echo $ds['sailed'];?></span><span class="sale_unit" style="font-size:12px;"><?php  echo $ds['unitname'];?></span>
                                            <?php  if($ds['total'] == 0) { ?>
                                                <span class="text-danger" style="font-size:12px;">已售完</span>
                                            <?php  } ?>
                                            <!-- 赠<?php  echo $ds['grant_credit'];?>积分 -->
                                        </p>
                                        <div class="info"><?php  echo $ds['description'];?></div>
                                        <?php  $i=0;?>
                                        <?php  if($ds['show_group_price'] == 1) { ?>
                                            <div>
                                                <?php  if(is_array($ds['price'])) { foreach($ds['price'] as $k => $v) { ?>
                                                    <?php  $i++;?>
                                                    <?php  if($i < 4) { ?>
                                                        <?php  if(!$k) { ?>
                                                            <span style="font-size: 18px;color:#333;">$<?php  echo $v;?></span>
                                                        <?php  } else { ?>
                                                            <span style="font-size: 14px;color:#c3c3c3;text-decoration: line-through;"><?php  //echo $groups[$k]['title'];?>$<?php  echo $v;?></span>
                                                        <?php  } ?>
                                                    <?php  } ?>
                                                <?php  } } ?>
                                            </div>
                                        <?php  } ?>
                                    </div>
                                    <div class="price_wrap" <?php if(!$ds['spec']){ ?> style="width: 22px;" onclick="addCart(<?php echo $ds['id']; ?>,'<?php echo $this->createMobileUrl('addCart', array('sid' => $sid, 'mode' => 2));?>')"<?php } ?>>
                                        <!-- <strong style="display: none;">$<span class="unit_price"><?php  echo $ds['member_price'];?></span></strong>
                                        <?php  if($store['business_hours_flag']) { ?>
                                            <?php  if($ds['total'] == -1 || $ds['total'] > 0) { ?>
                                            <div class="fr" max="<?php  echo $ds['total'];?>" data-first-order-limit="<?php  echo $ds['first_order_limit'];?>" data-buy-limit="<?php  echo $ds['buy_limit'];?>" data-first-order="<?php  echo $is_first_order;?>">
                                                <a href="javascript:void(0);" style="display: none;" class="btn_n add" data-num="<?php  echo $cart['data'][$ds['id']];?>"></a>
                                                <input autocomplete="off" class="h_num" type="hidden" name="dish[<?php  echo $ds['id'];?>]" value="<?php  echo $cart['data'][$ds['id']];?>">
                                                選規格
                                            </div>
                                            <?php  } ?>
                                        <?php  } ?> -->
                                        <?php  if($ds['total'] == 0) { ?>
                                            已售罄
                                        <?php  }else if($ds['spec']){ ?>
                                            選規格
                                        <?php  }else{ ?>
                                            +
                                        <?php  }?>
                                    </div>
                                </div>
                            </li>
                        <?php  } } ?>
                    </ul>
                <?php  } } ?>
            </div>
        </section>
        <?php  if(!$store['business_hours_flag']) { ?>
            <footer class="shopping_cart" id="shopping_box">
                <div class="fixeds" style="position: fixed;bottom: 49px;z-index: 999;">
                    本店已打烊
                </div>
            </footer>
        <?php  } else { ?>
            <?php  if($_GPC['mode'] == 2) { ?>
                <footer class="shopping_cart" id="shopping_box" style="display: none;">
                    <!-- 購物車詳情 -->
                    <div class="shopp_cat_details" id="shopp_cat_details" style="display: none;">
                        <div class="head">
                            <span class="hadchoes">已選商品</span>
                            <span class="empty" id="comfir_empty">清空</span>
                        </div>
                        <div>
                            <div class="details_box" id="details_box"></div>
                        </div>
                    </div>
                    <!-- 購物車詳情end -->
                    <div class="fixed">
                        <div class="cart_bgs" id="cart_bgs">
                            <div class="cart_nums">
                                <img src="../addons/str_takeout/template/resource/images/gouwuche.png" alt="">
                                購物車
                            </div>
                            <span id="cartNum"></span>
                        </div>
                        <div>$<span id="totalPrice">0</span></div>
                        <div>
                            <!-- <span class="comm_btn disabled">還差<span id="sendCondition"><?php  echo $store['send_price'];?></span>起送</span> -->
                            <a id="settlement" href="javascript:document.cart_form.submit();" class="comm_btn" style="">結算</a>
                        </div>
                    </div>
                </footer>
            <?php  } else { ?>
                <footer class="shopping_cart" id="shopping_box" style="display: none;">
                    <div class="fixed">
                        <div class="cart_bgs" id="cart_bgs">
                            <div class="cart_nums">
                                <img src="../addons/str_takeout/template/resource/images/gouwuche.png" alt="">
                                購物車
                            </div>
                            <span id="cartNum"></span>
                        </div>
                        <div>$<span id="totalPrice">0</span></div>
                        <div>
                            <?php  if($mode == 3) { ?>
                                <span class="comm_btn disabled"><span id="sendCondition" class="hide">0元</span>点餐</span>
                                <a id="assignSubmit" href="javascript:;" class="comm_btn" style="display: none;">选好了</a>
                            <?php  } else if($mode == 4) { ?>
                                <span class="comm_btn disabled">还差<span id="sendCondition"><?php  echo $table_category['limit_price'];?>元</span>起送</span>
                                <a id="reserveSubmit" href="javascript:;" class="comm_btn" style="display: none;">选好了</a>
                            <?php  } else { ?>
                                <a id="settlement" href="javascript:document.cart_form.submit();" class="comm_btn" style="">結算</a>
                            <?php  } ?>
                        </div>
                    </div>
                </footer>
            <?php  } ?>
        <?php  } ?>
    </form>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('comment_list', TEMPLATE_INCLUDEPATH)) : (include template('comment_list', TEMPLATE_INCLUDEPATH));?>

    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
    <div class="menu_detail" id="menuDetail" data-url="<?php echo $this->createMobileUrl('addCart', array('sid' => $sid, 'mode' => 2));?>" data-href="<?php echo $this->createMobileUrl('getspec', array('sid' => $sid, 'mode' => 2));?>">
        <div class="checkBox">

        </div>
        <div class="dialogBox">
            <div class="highlight">$<span class="price" id="total"></span></div>
            <div class="choices">
                <span class="choices1"></span>
                <span class="choices2"></span>
                <span class="choices3"></span>
            </div>
            <a href="javascript:void(0);" onclick="addCart()" class="comm_btn" id="detailBtn">加入購物車</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(".comment-container").hide();
        $('#assignSubmit').click(function(){
            var action = "<?php  echo $this->createMobileUrl('assign', array('sid' => $sid, 'op' =>'index', 'mode' => $mode, 'f' => 'dish'), true);?>";
            $('#cart_form').attr('action', action);
            $('#cart_form').submit();
        });

        $('#reserveSubmit').click(function(){
            var action = "<?php  echo $this->createMobileUrl('reserve', array('sid' => $sid, 'op' =>'post', 'mode' => 4, 'f' => 'dish', 'date' => $_GPC['date'], 'time' => $_GPC['time'], 'cid' => $_GPC['cid']), true);?>";
            $('#cart_form').attr('action', action);
            $('#cart_form').submit();
        });
        showCart();
    });

    //點菜、評價
    $('#nav_btn1').click(function() {
        $('#cart_form').show();
        $(".comment-container").hide();
        $(this).addClass('on');
        $('#nav_btn2').removeClass('on');
    });

    $('#nav_btn2').click(function() {
        $('#cart_form').hide();
        $(".comment-container").show();
        $(this).addClass('on');
        $('#nav_btn1').removeClass('on');
    });

    //選擇套餐
    $('.fr').click(function(){
        var text1 = $('.types1 .isChecked').text();
        var text2 = $('.types2 .isChecked').text();
        var text3 = $('.types3 .isChecked').text();
        $('.choices1').html(text1);
        $('.choices2').html("，"+text2);
        $('.choices3').html("，"+text3);
    });

    $('.choice1 label').click(function(){
        $('.types1 label').removeClass('isChecked')
        $(this).attr('class','isChecked');
        $('.choices1').html($(this).text());
    });

    $('.choice2 label').click(function(){
        $('.types2 label').removeClass('isChecked')
        $(this).attr('class','isChecked');
        $('.choices2').html('，'+$(this).text());
    });

    $('.choice3 label').click(function(){
        $('.types3 label').removeClass('isChecked')
        $(this).attr('class','isChecked');
        $('.choices3').html('，'+$(this).text());
    });
    //選擇套餐end

    function showCart(){
        $.ajax({
            type: "GET",
            url: "<?php echo $this->createMobileUrl('getCart', array('sid' => $sid, 'mode' => 2));?>",
            success: function(res){
                var res = JSON.parse(res);
                var data = res.data;
                var hmtls = '';
                var totalPrice = 0;
                if(data.length){
                    $("#shopping_box").css('display','block');
                }
                for (var i = 0; i < data.length; i++) {
                    totalPrice += parseFloat(data[i].amount);
                    var spec = data[i].spec?data[i].spec:'';
                    hmtls += '<div class="goods_list">';
                    hmtls += '<div class="list_top">';
                    hmtls += '<span>'+data[i].title+'</span>';
                    hmtls += '<span>';
                    hmtls += '<div class="fr">';
                    hmtls += '<a href="javascript:void(0);" class="btn_n reduce" id="reduce" onclick="reduce('+data[i].id+')"><div></div></a>';
                    hmtls += '<input autocomplete="off" class="h_num" name="" value="'+data[i].quantity+'">';
                    hmtls += '<a href="javascript:void(0);" class="btn_n add" id="add" onclick="addNum('+data[i].id+')"><div></div><div></div></a>';
                    hmtls += '</div>';
                    hmtls += '</span>';
                    hmtls += '<span>$'+data[i].amount+'</span>';
                    hmtls += '</div>';
                    hmtls += '<div>'+spec+'</div>';
                    hmtls += '</div>';
                }
                $('#details_box').html(hmtls);
                $('#cartNum').text(data.length);
                $('#totalPrice').text(totalPrice);
            }
        })
    }

    function reduce(id){
        $.ajax({
            type: "GET",
            url: "<?php echo $this->createMobileUrl('Reduce', array('sid' => $sid, 'mode' => 2));?>&cart_id="+id,
            success: function(res){
                var res = JSON.parse(res);
                alert(res.msg);
                console.log(res);
                showCart();
            }
        })
    }

    function addNum(id){
        $.ajax({
            type: "GET",
            url: "<?php echo $this->createMobileUrl('addNum', array('sid' => $sid, 'mode' => 2));?>&cart_id="+id,
            success: function(res){
                var res = JSON.parse(res);
                alert(res.msg);
                console.log(res);
                showCart();
            }
        })
    }

    // //加入到購物車
    // $('#detailBtn').click(function(){
    //     if(!$(this).hasClass('detail')){
    //         dialogTarget.find('.add ').click();
    //     }
    //     var choices = $('.choices').text();
    //     var price = $('.price').text();
    //     var dialog_tt = $('.dialog_tt').text();

    //     var hmtls = '';
    //     hmtls += '<div class="goods_list">';
    //     hmtls += '<div class="list_top">';
    //     hmtls += '<span>'+dialog_tt+'</span>';
    //     hmtls += '<span>';
    //     hmtls += '<div class="fr">';
    //     hmtls += '<a href="javascript:void(0);" class="btn_n reduce" id="reduce"><div></div></a>';
    //     hmtls += '<input autocomplete="off" class="h_num" name="" value="1">';
    //     hmtls += '<a href="javascript:void(0);" onclick="alert(123);" class="btn_n add" id="add"><div></div><div></div></a>';
    //     hmtls += '</div>';
    //     hmtls += '</span>';
    //     hmtls += '<span>$'+price+'</span>';
    //     hmtls += '</div>';
    //     hmtls += '<div>'+choices+'</div>';
    //     hmtls += '</div>';
    //     $('.details_box').append(hmtls);
    //     var detalisBox = $('.details_box').html();
    // });
    //加入到購物車end

//     $('#reduce').click(function(){
//      $.ajax({
//          type: "GET",
//          url: "<?php echo $this->createMobileUrl('Reduce', array('sid' => $sid, 'mode' => 2));?>",
//          success: function(res){
//              var res = JSON.parse(res);
//              var data = res.data;
//              var hmtls = '';
//              if(data){
//                  $("#shopping_box").css('display','block');
//              }
//              for (var i = 0; i < data.length; i++) {
//                  var spec = data[i].spec?data[i].spec:'';
//                  hmtls += '<div class="goods_list">';
//                  hmtls += '<div class="list_top">';
//                  hmtls += '<span>'+data[i].title+'</span>';
//                  hmtls += '<span>';
//                  hmtls += '<div class="fr">';
//                  hmtls += '<a href="javascript:void(0);" class="btn_n reduce" id="reduce"><div></div></a>';
//                  hmtls += '<input autocomplete="off" class="h_num" name="" value="'+data[i].quantity+'">';
//                  hmtls += '<a href="javascript:void(0);" onclick="alert(123);" class="btn_n add" id="add"><div></div><div></div></a>';
//                  hmtls += '</div>';
//                  hmtls += '</span>';
//                  hmtls += '<span>$'+data[i].amount+'</span>';
//                  hmtls += '</div>';
//                  hmtls += '<div>'+spec+'</div>';
//                  hmtls += '</div>';
//              }
//              $('#details_box').html(hmtls);
//              $('#cartNum').text(data.length);
//          }
//      })
// //    alert(1);
//     });

//     $('.add').click(function(){
// //    alert(2);
//     });

    //清空購物車
    $('#comfir_empty').click(function() {
        location.href="./index.php?i=6&c=entry&sid=13&f=1&mode=2&do=dish&m=str_takeout";
        $.ajax({
            type: "GET",
            url: "<?php echo $this->createMobileUrl('ClearCart', array('sid' => $sid, 'mode' => 2));?>",
            success: function(res){
                $("#shopping_box").css('display','none');
                location.href = "<?php echo $this->createMobileUrl('dish', array('sid' => $sid, 'mode' => 2));?>";
            }
        })
        return false;
    });

    //显示购物车详情
    $('#cart_bgs').click(function() {
        $('.shopp_cat_details').show();
        return false;
    });
    $("#shopp_cat_details").click(function(event){
        return false;
    });
    //显示购物车详情end
    var menu = {
        offsetAry: [0],
        _is_left_menu_addclass:true,
        init: function(id){
            var winH = $(window).height(),
                _this = this,
                _icoMenu = $('#icoMenu'),
                _sideNav = $('#sideNav'),
                maxH = winH - (_icoMenu.parent().is(':visible') ? _icoMenu.outerHeight(true) : 0) - 45;

            this.el =  $(id);

            _sideNav.height(maxH);

            if(_sideNav.find('ul').height() > maxH)  new IScroll('#sideNav', { probeType: 3, mouseWheel: true ,click:true});

            $(window).bind('scroll', function(){
                _this.scroll.call(_this);
            });

            $('#icoMenu').click(function(){
                if(_sideNav.css('display') != 'none') {
                    _sideNav.show();
                } else {
                    _sideNav.hide();
                }
                if(_sideNav.find('ul').height() > maxH)  new IScroll('#sideNav', { probeType: 3, mouseWheel: true ,click:true});
            });

            $('.menu_tt h2').each(function(){
                _this.offsetAry.push($(this).offset().top);
            });

            this.el.find('a').click(function(){
                $(this).addClass('on').parent().siblings().find('a').removeClass('on');
                _this._is_left_menu_addclass=false;
                var t = $(window).scrollTop();
                var t1= _this.offsetAry[_this.el.find('a').index(this) + 1];
                var _t =Math.abs(t1-t);
                var _time =parseInt( Math.round(_t/3));
                $('html,body').animate({scrollTop: t1}, _time,"linear",function(){_this._is_left_menu_addclass=true;});
            });

            _this.offsetT = this.el.offset().top;
        },
        getIndex: function(ary, value){
            var i = 0;
            for(; i < ary.length; i++){
                if(value >= ary[i] && value < ary[i + 1]){
                    return i;
                }
            }
            return ary.length -1;
        },
        scroll: function(){
            var st = $(document).scrollTop(),
                index = this.getIndex(this.offsetAry, st),
                i = index - 1;

            if(this.curIndex !== index){ // 判断分类是否切换

                $('.menu_tt h2').removeClass('menu_fixed');
                if(this._is_left_menu_addclass==true)
                    this.el.find('a').removeClass('on');
                if(i >= 0){
                    this.el.addClass('menu_fixed');
                    $('.menu_tt').eq(i).find('h2').addClass('menu_fixed');
                    if(this._is_left_menu_addclass==true)
                        this.el.find('a').eq(i).addClass('on');
                }else{
                    this.el.removeClass('menu_fixed');
                }
                this.curIndex = index;
            }
        }
    }
    $(function(){
        menu.init('#menuNav');
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
