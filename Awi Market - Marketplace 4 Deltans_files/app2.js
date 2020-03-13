var text = "";


function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show"), $(".ham-burger").toggle("slow"), $(".fa-angle-down").toggle("slow")
}

function myFunction2() {}

function myFunction3() {
    "inline-block" == $(".fa-angle-down").css("display") && (document.getElementById("myDropdown").classList.toggle("show"), $(".ham-burger").toggle("slow"), $(".fa-angle-down").toggle("slow"))
}

function filterFunction() {
    var e, a, t;
    for (e = document.getElementById("myInput").value.toUpperCase(), div = document.getElementById("myDropdown"), a = div.getElementsByTagName("a"), t = 0; t < a.length; t++) a[t].innerHTML.toUpperCase().indexOf(e) > -1 ? a[t].style.display = "" : a[t].style.display = "none"
}

function unFixFooter() {
    $(".ff").removeClass("footer1"), $(".ff").addClass("footer2")
}

function unFixHeader() {
    $(".hh").removeClass("header1"), $(".hh").addClass("header2")
}

function htmlEncode(e) {
    return $("<div/>").text(e).html()
}

function register_mobile() {
    sPageURL = decodeURIComponent(window.location.search.substring(1)), option = sPageURL.split("&"), "xx=1" == option[1] && $("#api").val("1"), url2 = "https://www.awimarket.com/", $(".reg-spin").removeClass("hide");
    var e = $("#register-submit"),
        a = e.attr("action");
    $.ajax({
        method: "GET",
        url: '',
        data: e.serialize(),
        success: function(e) {
            redirect2("register_submit", e)
        }
    })
}

function login_mobile() {
    sPageURL = decodeURIComponent(window.location.search.substring(1)), option = sPageURL.split("&"), "xx=1" == option[1] && $("#api1").val("1"), url2 = "https://www.awimarket.com/", $(".login-spin").removeClass("hide");
    var e = $("#login_auth"),
        a = e.attr("action");
    $.ajax({
        method: "GET",
        url: url2 + a,
        data: e.serialize(),
        success: function(e) {
            "S" == e.charAt(0) ? redirect2("dashboard", "dashboard?login_id=Auth-" + e.substring(4, e.length)) : redirect2("login_submit", e)
        }
    })
}

function gencode() {
    $(".gen-spin").removeClass("hide"), $.ajax({
        method: "get",
        url: "gen-code?d=" + (new Date).getTime(),
        data: {
            phone: $("#phone-1").val(),
            email: $("#email").val()
        },
        success: function(e) {
            $(".gen-spin").addClass("hide"), alert(e)
        }
    })
}

function setType(e) {
    1 == e ? $("#type").val("onemonth") : 2 == e ? $("#type").val("threemonth") : 3 == e && $("#type").val("sixmonth")
}

function deleteAdMobile(e) {
    $.ajax({
        method: "GET",
        url: e,
        data: form.serialize(),
        success: function(e) {
            alert("Successful")
        }
    })
}

function chooseAdImages1() {
    $(".create-ad-image-box").click(), $(this).find(".fa-spin").removeClass("hide"), document.getElementById("form22")[0].value, $.ajax({
        method: "post",
        url: "https://awimarket.com/addTemPhoto",
        data: new FormData($("#form22")[0]),
        cache: !1,
        contentType: !1,
        processData: !1,
        success: function(e) {
            alert(e), val = e.split("."), "jpg" == val[1] || "png" == val[1] || "gif" == val[1] || "JPG" == val[1] || "PNG" == val[1] || "GIF" == val[1] ? ($(".ak").css("background-image", "url('https://awimarket.com/temp/" + e + "')"), $(".ak").attr("data-value", e)) : alert("Please select a jpg,png or gif file")
        }
    })
}

function createAdMobile() {
    $("#pic1").val($(".create-ad-image-box:nth-child(1)").attr("data-value")), $("#pic2").val($(".create-ad-image-box:nth-child(2)").attr("data-value")), $("#pic3").val($(".create-ad-image-box:nth-child(3)").attr("data-value")), $("#pic4").val($(".create-ad-image-box:nth-child(4)").attr("data-value")), $("#pic5").val($(".create-ad-image-box:nth-child(5)").attr("data-value")), $(".create-ad-spin").removeClass("hide"), sPageURL = decodeURIComponent(window.location.search.substring(1)), option = sPageURL.split("&"), "xx=1" == option[1] && $(".api11").val("1"), url2 = "https://www.awimarket.com/";
    var e = $("#Ad-form"),
        a = e.attr("action");
    $.ajax({
        method: "GET",
        url: url2 + a,
        data: e.serialize(),
        success: function(e) {
            "Successful" == e.split("<><>")[0] ? alert("Successful") : redirect2("createAdFail", e)
        }
    })
}

function updateProfileDetails() {
    $(".update-1").removeClass("hide"), sPageURL = decodeURIComponent(window.location.search.substring(1)), option = sPageURL.split("&"), "xx=1" == option[1] && $(".api11").val("1"), url2 = "https://www.awimarket.com/";
    var e = $("#init-profile-details"),
        a = e.attr("action");
    $.ajax({
        method: "GET",
        url: url2 + a,
        data: e.serialize(),
        success: function(e) {
            "Successful" == e.split("<><>")[0] ? alert("Successful") : redirect2("userprofileFail", e)
        }
    })
}

function updateNewsletterMobile() {
    $(".update-3").removeClass("hide"), sPageURL = decodeURIComponent(window.location.search.substring(1)), option = sPageURL.split("&"), "xx=1" == option[1] && $(".api11").val("1"), url2 = "https://www.awimarket.com/";
    var e = $("#updateNewsletter"),
        a = e.attr("action");
    $.ajax({
        method: "GET",
        url: url2 + a,
        data: e.serialize(),
        success: function(e) {
            "Successful" == e.split("<><>")[0] ? alert("Successful") : redirect2("userprofileAlertFail", e)
        }
    })
}

function updatePassword() {
    $(".update-2").removeClass("hide"), sPageURL = decodeURIComponent(window.location.search.substring(1)), option = sPageURL.split("&"), "xx=1" == option[1] && $(".api11").val("1"), url2 = "https://www.awimarket.com/";
    var e = $("#change-password"),
        a = e.attr("action");
    $.ajax({
        method: "GET",
        url: url2 + a,
        data: e.serialize(),
        success: function(e) {
            "Successful" == e.split("<><>")[0] ? alert("Successful") : redirect2("userprofileAlertFail", e)
        }
    })
}

function changeButton() {
    screen.width < 1e3 ? ($(".bbn").hide(), $(".bbn2").show()) : screen.width > 1e3 && ($(".bbn2").hide(), $(".bbn").show())
}
$(window).on("load", function() {
    $(':contains("Thumbnail Slider trial version")').each(function() {
        $(this).html($(this).html().split("Thumbnail Slider trial version").join(""))
    })
}), $(function() {
    $(".create-ad-btn").unbind("click").on("click", function() {
        "" == $(".api11").val() && ($("#pic1").val($(".create-ad-image-box:nth-child(1)").attr("data-value")), $("#pic2").val($(".create-ad-image-box:nth-child(2)").attr("data-value")), $("#pic3").val($(".create-ad-image-box:nth-child(3)").attr("data-value")), $("#pic4").val($(".create-ad-image-box:nth-child(4)").attr("data-value")), $("#pic5").val($(".create-ad-image-box:nth-child(5)").attr("data-value")), $(".create-ad-spin").removeClass("hide"), $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        }))
    })
}), $(".addCatClass").length && ($(".navmenu").addClass("nxz"), screen.width < 1e3 ? $(".t-class").hide() : $(".m-view").show()), $("#type").val("onemonth"), $("#boost_start_unit").unbind("click").on("click", function() {
    $("#amount").val(100 * $("#start-price").text().split("/")[0]), $("#amt").text(100 * $("#start-price").text().split("/")[0]), $("#type").val($("#type").val() + "_BoostStart"), "1" == $(".api11").val() ? (sPageURL = decodeURIComponent(window.location.search.substring(1)), ad_id = sPageURL.split("id=")[1].split("&")[0], localStorage.setItem("ad_id", ad_id), localStorage.setItem("amount", $("#amt").text($("#start-price").text().split("/")[0])), localStorage.setItem("type", $("#type").val($("#type").val() + "_BoostStart")), $("#form-pay")[0].submit()) : $("#form-pay")[0].submit()
}), $("#boost_business_unit").unbind("click").on("click", function() {
    $("#amount").val(100 * parseInt($("#business-price").text().split("/")[0])), $("#amt").text(100 * $("#business-price").text().split("/")[0]), $("#type").val($("#type").val() + "_boostBusiness"), "1" == $(".api11").val() ? (sPageURL = decodeURIComponent(window.location.search.substring(1)), ad_id = sPageURL.split("id=")[1].split("&")[0], localStorage.setItem("ad_id", ad_id), localStorage.setItem("amount", $("#amt").text($("#business-price").text().split("/")[0])), localStorage.setItem("type", $("#type").val($("#type").val() + "_boostBusiness")), $("#form-pay")[0].submit()) : $("#form-pay")[0].submit()
}), $("#boost_premium_unit").unbind("click").on("click", function() {
    $("#amount").val(100 * $("#premium-price").text().split("/")[0]), $("#amt").text(100 * $("#premium-price").text().split("/")[0]), $("#type").val($("#type").val() + "_boostPremium"), "1" == $(".api11").val() ? (sPageURL = decodeURIComponent(window.location.search.substring(1)), ad_id = sPageURL.split("id=")[1].split("&")[0], localStorage.setItem("ad_id", ad_id), localStorage.setItem("amount", $("#amt").text($("#premium-price").text().split("/")[0])), localStorage.setItem("type", $("#type").val($("#type").val() + "_boostPremium")), $("#form-pay")[0].submit()) : $("#form-pay")[0].submit()
}), $("#boost_vip_unit").unbind("click").on("click", function() {
    $("#amount").val(100 * $("#premium-price").text().split("/")[0]), $("#amt").text(100 * $("#premium-price").text().split("/")[0]), $("#type").val($("#type").val() + "_boostPremium"), "1" == $(".api11").val() ? (sPageURL = decodeURIComponent(window.location.search.substring(1)), ad_id = sPageURL.split("id=")[1].split("&")[0], localStorage.setItem("ad_id", ad_id), localStorage.setItem("amount", $("#amt").text($("#premium-price").text().split("/")[0])), localStorage.setItem("type", $("#type").val($("#type").val() + "_boostPremium")), $("#form-pay")[0].submit()) : $("#form-pay")[0].submit()
}), $(".sub-login").click(function() {
    $(".admin-sub-spin").removeClass("hide")
}), $(".hidden_nos").unbind("click").on("click", function() {
    $(".hidden_nos1").hide(), $(".hidden_nos").hide(), $(".h-nos1").removeClass("hide")
}), $("#subcat").on("change", function() {
    $("#frm-subcat")[0].submit()
}), $(".save_am").unbind("click").on("click", function() {
    $(this).toggleClass("save"), "Save am" == $(".save_am").text() ? ($(".save_am").text("UnSave am"), $.ajax({
        method: "get",
        url: "saveAd",
        data: {
            ad_id: $("#ad_id").val()
        },
        success: function(e) {}
    })) : ($(".save_am").text("Save am"), $.ajax({
        method: "get",
        url: "UnsaveAd",
        data: {
            ad_id: $("#ad_id").val()
        },
        success: function(e) {}
    }))
}), $(".follow_am").unbind("click").on("click", function() {
    $(this).toggleClass("follow"), "Follow am" == $(".follow_am").text() ? ($(".follow_am").text("UnFollow am"), $.ajax({
        method: "get",
        url: "followAd",
        data: {
            ad_id: $("#ad_id").val()
        },
        success: function(e) {}
    })) : ($(".follow_am").text("Follow am"), $.ajax({
        method: "get",
        url: "UnfollowAd",
        data: {
            ad_id: $("#ad_id").val()
        },
        success: function(e) {}
    }))
}), $(".rating1").unbind("click").on("click", function() {
    alert("Rating Added Successfully"), $.ajax({
        method: "get",
        url: "add_rating",
        data: {
            ad_id: $("#ad_id").val(),
            value: $("#rateit10").rateit("value")
        },
        success: function(e) {}
    })
}), $(".example_all").length && $(".example_all").DataTable({
    lengthChange: !1
}), $(".products").unbind("click").on("click", function() {
    $(".sellers_tab").addClass("hide"), $(".services_tab").addClass("hide"), $(".products_tab").removeClass("hide")
}), $(".sellers").unbind("click").on("click", function() {
    $(".services_tab").addClass("hide"), $(".products_tab").addClass("hide"), $(".sellers_tab").removeClass("hide")
}), $(".services").unbind("click").on("click", function() {
    $(".sellers_tab").addClass("hide"), $(".services_tab").removeClass("hide"), $(".products_tab").addClass("hide")
}), $(".edit-ad-btn").unbind("click").on("click", function() {
    $("#pic1").val($(".create-ad-image-box:nth-child(1)").attr("data-value")), $("#pic2").val($(".create-ad-image-box:nth-child(2)").attr("data-value")), $("#pic3").val($(".create-ad-image-box:nth-child(3)").attr("data-value")), $("#pic4").val($(".create-ad-image-box:nth-child(4)").attr("data-value")), $("#pic5").val($(".create-ad-image-box:nth-child(5)").attr("data-value")), $(".create-ad-spin").removeClass("hide"), $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    }), $.ajax({
        method: "post",
        url: "editAd1",
        data: $("#Ad-form").serialize(),
        success: function(e) {
            1 != e.trim() ? ($("#ad-error").css("color", "red"), $("#ad-error").text(e)) : ($("#ad-error").css("color", "blue"), $("#ad-error").text("Successful"), window.open('/dashboard', '_self')), $(".create-ad-spin").addClass("hide")
        }
    })
}), $(".pic1").unbind("change").on("change", function() {
    var countFiles = $(this)[0].files.length;
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof(FileReader) != "undefined") {
            for (var i = 0; i < countFiles; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".ak").find(".fa-spin").addClass("hide");
                    $(".ak").css("background-image", "url('" + e.target.result + "')")
                }
                reader.readAsDataURL($(this)[0].files[i])
            }
        } else {
            alert("This browser does not support FileReader.")
        }
    } else {
        alert("Pls select only images")
    }
}), $(".pic2").unbind("change").on("change", function() {
    var countFiles = $(this)[0].files.length;
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof(FileReader) != "undefined") {
            for (var i = 0; i < countFiles; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".ak").find(".fa-spin").addClass("hide");
                    $(".ak").css("background-image", "url('" + e.target.result + "')")
                }
                reader.readAsDataURL($(this)[0].files[i])
            }
        } else {
            alert("This browser does not support FileReader.")
        }
    } else {
        alert("Pls select only images")
    }
}), $(".pic3").unbind("change").on("change", function() {
    var countFiles = $(this)[0].files.length;
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof(FileReader) != "undefined") {
            for (var i = 0; i < countFiles; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".ak").find(".fa-spin").addClass("hide");
                    $(".ak").css("background-image", "url('" + e.target.result + "')")
                }
                reader.readAsDataURL($(this)[0].files[i])
            }
        } else {
            alert("This browser does not support FileReader.")
        }
    } else {
        alert("Pls select only images")
    }
}), $(".pic4").unbind("change").on("change", function() {
    var countFiles = $(this)[0].files.length;
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof(FileReader) != "undefined") {
            for (var i = 0; i < countFiles; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".ak").find(".fa-spin").addClass("hide");
                    $(".ak").css("background-image", "url('" + e.target.result + "')")
                }
                reader.readAsDataURL($(this)[0].files[i])
            }
        } else {
            alert("This browser does not support FileReader.")
        }
    } else {
        alert("Pls select only images")
    }
}), $(".pic5").unbind("change").on("change", function() {
    var countFiles = $(this)[0].files.length;
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof(FileReader) != "undefined") {
            for (var i = 0; i < countFiles; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".ak").find(".fa-spin").addClass("hide");
                    $(".ak").css("background-image", "url('" + e.target.result + "')")
                }
                reader.readAsDataURL($(this)[0].files[i])
            }
        } else {
            alert("This browser does not support FileReader.")
        }
    } else {
        alert("Pls select only images")
    }
}), $("#location").on("change", function() {
    $("#frm-location")[0].submit()
}), $("#priority").on("change", function() {
    $("#frm-priority")[0].submit()
}), $("#location1").on("change", function() {
    $("#frm-location1")[0].submit()
}), $("#subcat1").on("change", function() {
    $("#frm-subcat1")[0].submit()
}), $("#priority1").on("change", function() {
    $("#frm-priority1")[0].submit()
}), $(".l-more").unbind("click").on("click", function() {
    $(".rm1").removeClass("remaining"), $(".rem-1").addClass("hide")
}), $(".editBill").unbind("click").on("click", function() {
    $(".admin-edit-spin2 ").removeClass("hide")
}), $(".sub-logo").unbind("click").on("click", function() {
    $(".admin-logo-spin").removeClass("hide")
}), $(".sub-admin").unbind("click").on("click", function() {
    $(".admin-admin-spin").removeClass("hide")
}), $(".sub-tag").unbind("click").on("click", function() {
    $(".admin-tag-spin").removeClass("hide")
}), $(".sub-cat").unbind("click").on("click", function() {
    $(".admin-cat-spin").removeClass("hide")
}), $(".editcat").unbind("click").on("click", function() {
    $(".admin-cat-spin2").removeClass("hide")
}), $(".citycat").unbind("click").on("click", function() {
    $(".admin-city-spin").removeClass("hide")
}), $(".editcity").unbind("click").on("click", function() {
    $(".admin-editcity-spin2").removeClass("hide")
}), $(".sub-side").unbind("click").on("click", function() {
    $(".admin-side-spin").removeClass("hide")
}), $(".nav-side").unbind("click").on("click", function() {
    $(".admin-nav-spin").removeClass("hide")
}), $(".editnav").unbind("click").on("click", function() {
    $(".admin-nav-spin2").removeClass("hide")
}), $(".fa-list").unbind("click").on("click", function() {
    $(".cat-text").toggle(), $(".cat-text").removeClass("hide")
}), $(".f-c").unbind("click").on("click", function() {
    unFixHeader()
}), $(".fa-th-large").unbind("click").on("click", function() {
    $(".cat-text").addClass("hide")
}), $(".company-1").unbind("click").on("click", function() {
    $(".tagbox").toggle(), $(".abt-company").toggle()
}), $(".ddx").unbind("click").on("click", function() {
    $(".ddx").removeClass("collapsed")
}), $(".update11").length && ($(".update11").unbind("click").on("click", function() {
    $(".update-1").removeClass("hide")
}), $(".update22").unbind("click").on("click", function() {
    $(".update-2").removeClass("hide")
}), $(".update33").unbind("click").on("click", function() {
    $(".update-3").removeClass("hide")
})), $("._close").addClass("click-add"), $(".forgot_email_btn").length && $(".forgot_email_btn").unbind("click").on("click", function() {
    $(".forgot-spin").removeClass("hide")
}), $("#confirm_code_btn1").length && $("#confirm_code_btn1").unbind("click").on("click", function() {
    $("#confirm-spin").removeClass("hide")
}), $(".pass_btn").length && $(".pass_btn").unbind("click").on("click", function() {
    $(".pass-spin").removeClass("hide")
}), $(".img-upload").length && ($(".test").unbind("click").on("click", function() {
    $(".img-upload").click()
}), $(".img-upload").unbind("change").on("change", function() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    }), $.ajax({
        method: "post",
        url: "addPhoto",
        data: new FormData($("#form1")[0]),
        cache: !1,
        contentType: !1,
        processData: !1,
        success: function(e) {
            "1" == e ? alert("invalid image") : $(".test").attr("src", "userprofile_img/" + e)
        }
    })
})), $(".sortable").length && ($(".sortable").sortable(), $(".sortable").disableSelection()), $(".sign-in-button").click(function() {
    $(".login-spin").removeClass("hide")
}), $(".reg-btn").click(function() {
    $(".reg-spin").removeClass("hide")
}), $(".editEmail").unbind("click").click(function() {
    $(".admin-edit-spin").removeClass("hide")
}), $(".sub-bill").unbind("click").click(function() {
    $(".admin-bill-spin").removeClass("hide")
}), $(".check").length && $(".check").click(function() {
    $(this).is(":checked") ? $(".dd4").addClass("display-b") : $(this).is(":checked") || $(".dd4").removeClass("display-b")
}), $(".item-list").length && $(".item-list").addClass("make-grid"), $(".input-group-btn .dropdown-menu li a").click(function() {
    var e = $(this).html();
    $(this).parents(".input-group-btn").find(".btn-search").html(e)
}), $(".check-b").click(function() {
    $(this).addClass("animate")
}), $(".create-ad-image-box").click(function() {
    $(".create-ad-image-box").removeClass("purple-border"), $(this).addClass("purple-border")
}), $(".f-ads").click(function() {
    $(this).addClass("purple-underline"), $(".p-ads").removeClass("purple-underline")
}), $(".p-ads").click(function() {
    $(this).addClass("purple-underline"), $(".f-ads").removeClass("purple-underline")
}), $(".dash-overlay").click(function() {
    $(".dash-overlay").removeClass("active-overlay"), $(this).addClass("active-overlay"), "1" == $(this).data("role") ? ($(".tabs1").addClass("hide"), $(".f-ads").removeClass("hide"), $(".p-ads").removeClass("hide"), $(".t1").removeClass("hide")) : "2" == $(this).data("role") ? ($(".tabs1").addClass("hide"), $(".f-ads").addClass("hide"), $(".p-ads").addClass("hide"), $(".t2").removeClass("hide")) : "3" == $(this).data("role") && ($(".tabs1").addClass("hide"), $(".f-ads").addClass("hide"), $(".p-ads").addClass("hide"), $(".t3").removeClass("hide"))
}), $(".title-text").keydown(function() {
    var e = $("label-char");
    field = $(this), maxlimit = 100, field.val().length > maxlimit ? field.val(field.val().substring(0, maxlimit)) : e.val(maxlimit - field.val().length + " Characters remaining")
}), $(".title-text").keyup(function() {
    var e = $(".label-char");
    field = $(this), maxlimit = 100, field.val().length > maxlimit ? field.val(field.val().substring(0, maxlimit)) : e.text(maxlimit - field.val().length + " Characters remaining")
}), $(".click-add").mouseover(function() {
    $(this).addClass("click-properties"), $(this).removeClass("click-add")
}).on("mouseleave", function() {
    $(this).addClass("click-add"), $(this).removeClass("click-properties")
}), $(".click-properties").mouseover(function() {
    $(this).addClass("click-add"), $(this).removeClass("click-properties")
}).on("mouseleave", function() {
    $(this).addClass("click-properties"), $(this).removeClass("click-add")
}), $("div").click(function(e) {
    $(e.target).is(".btn_collapzion") && e.preventDefault()
}), $("div").click(function(e) {
    $(e.target).is(".btn_collapzion") && e.preventDefault()
});
$(".pic1").length && $(".pic1").unbind("click").on("click", function() {
    
    $('.create-ad-image-box').removeClass('purple-border');
    $(this).addClass('purple-border');
    $('#current_pic').val(1);
    $('#CropperPopup').modal('show');
    
   
});

$(".pic2").length && $(".pic2").unbind("click").on("click", function() {
    
    $('.create-ad-image-box').removeClass('purple-border');
    $(this).addClass('purple-border');
    $('#current_pic').val(2);
    $('#CropperPopup').modal('show');
    
   
});

$(".pic3").length && $(".pic3").unbind("click").on("click", function() {
    
    $('.create-ad-image-box').removeClass('purple-border');
    $(this).addClass('purple-border');
    $('#current_pic').val(3);
    $('#CropperPopup').modal('show');
    
   
});

$(".pic4").length && $(".pic4").unbind("click").on("click", function() {
    
    $('.create-ad-image-box').removeClass('purple-border');
    $(this).addClass('purple-border');
    $('#current_pic').val(4);
    $('#CropperPopup').modal('show');
    
   
});

$(".pic5").length && $(".pic5").unbind("click").on("click", function() {
    
    $('.create-ad-image-box').removeClass('purple-border');
    $(this).addClass('purple-border');
    $('#current_pic').val(5);
    $('#CropperPopup').modal('show');
    
   
});

  var $inputImage = $('#image1');

  $inputImage.change(function () {
      
      var files = this.files;
      var file;
        
      

     if(files && files.length) {
         
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          uploadedImageName = file.name;
          uploadedImageType = file.type;

         

          uploadedImageURL = URL.createObjectURL(file);
          $('#image').cropper('destroy').attr('src', uploadedImageURL);
          $('#image').cropper('destroy').attr('src', uploadedImageURL);
          
          var $image = $('#image');

$image.cropper({
      aspectRatio: 1/ 1,

      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
         
        
     
    }
  });

          
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });
    
    
function save_cropped_pic()
{
    x = $('#current_pic').val();
    
    var cropcanvas = $('#image').cropper('getCroppedCanvas',{width: 250, height: 250});
                                     
    if(cropcanvas !== null  )
    {
        var croppng = cropcanvas.toDataURL("image/png");
        $('#ads_pic'+x).val(croppng);
        $('#image').cropper('destroy').attr('src','images/user.png');
        $('#image1').val('');
        $('.pic'+x).css("background-image", "url('" + croppng + "')");
      
    }
    
    
}



function redirect2() {}
if ($("select").length) {
    $("select").selectpicker()
}