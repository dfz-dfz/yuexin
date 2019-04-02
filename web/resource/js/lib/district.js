define(function () {
    function t(t, i, e) {
        if (!t.district) return !1;
        t.district.options.length = 0, e.withTitle && t.district.options.add(new Option("区/县", ""));
        var c = t.province.options[t.province.options.selectedIndex], l = $(c).attr("pid"),
            c = t.city.options[t.city.options.selectedIndex], r = $(c).attr("cid");
        l && r && ($(t.district).show(), $.each(s[l].cities[r].districts, function (i, s) {
            var e = new Option(s, s);
            t.district.options.add(e)
        })), i.district && $(t.district).val(i.district)
    }

    function i(i, e, c) {
        if (!i.city) return !1;
        i.city.options.length = 0;
        var l = i.province.options[i.province.options.selectedIndex], r = $(l).attr("pid");
        r && $.each(s[r].cities, function (t, s) {
            if ("北京市" != s.title && "上海市" != s.title && "天津市" != s.title && "重庆市" != s.title || !c.wechat) {
                if (c.wechat) {
                    var e = s.title.indexOf("市");
                    e > -1 && (s.title = s.title.substr(0, e))
                }
                var l = new Option(s.title, s.title);
                $(l).attr("cid", t), i.city.options.add(l)
            } else $.each(s.districts, function (t, e) {
                var c = e.indexOf("区");
                c > -1 && (e = e.substr(0, c)), (c = e.indexOf("县")) > -1 && "蓟县" != e && "忠县" != e && "开县" != e && (e = e.substr(0, c)), "重庆市" == s.title && e.length > 3 && (e = e.substr(0, 2));
                var l = new Option(e, e);
                $(l).attr("cid", t), i.city.options.add(l)
            })
        }), e.city && $(i.city).val(e.city), i.district && ($(i.city).on("change", function () {
            t(i, e, c)
        }), $(i.city).trigger("change"))
    }

    var s = {
        820000: {
            title: "澳门特别行政区",
            cities: {
                820100: {title: "澳门半岛", districts: []},
                820200: {title: "氹仔", districts: []},
                820300: {title: "路環", districts: []}
            }
        }
    }, e = {};
    return e.render = function (t, e, c) {
        if (!t.province) return !1;
        t.province.options.length = 0, $.each(s, function (i, s) {
            if (c.wechat) {
                var e = s.title.indexOf("省");
                e > -1 && (s.title = s.title.substr(0, e)), s.title.length > 2 && ("内蒙古自治区" == s.title ? s.title = "内蒙古" : "黑龙江" == s.title ? s.title = "黑龙江" : s.title = s.title.substr(0, 2))
            }
            var l = new Option(s.title, s.title);
            $(l).attr("pid", i), t.province.options.add(l)
        }), e.province && $(t.province).val(e.province), t.city && ($(t.province).on("change", function () {
            i(t, e, c)
        }), $(t.province).trigger("change"))
    }, e
});