var App = function() {
    var app = this;
    var errormsg = {};
    errormsg['error'] = "提交问题时遇到数据库错误.";
    errormsg['login first']="请先登录!";
    errormsg['parameter error']="参数错误!";
    
    
    var alertStatus = function(type) {
        if (type=="success") return true;
        try {
            Materialize.toast(errormsg[type],4000);
        } catch(e) {
            Materialize.toast("未知错误",3000);
        }
        return false;
    }
    /*
    var search = function(sSettings) {
        toggleStatus("加载中...");
        qSettings.full = false;
        //console.log(sSettings);
        
    }
*/  
    var submitForm = function(e) {
        if($("#quesSubject").val()=="") {
            $("#quesSubject").focus();
            Materialize.toast("请输入问题标题!",3000);
            return;
        }
        if ($("#quesSubject").val().length>40 || $("#quesContent").val().length>500) {
            $("#quesSubject").focus();
            Materialize.toast("标题过长!",3000);
            return;
        }
        var qdata = {};
        qdata.type =$("input[name='quesType']:checked").val();
        qdata.subject = $("#quesSubject").val();
        qdata.content = $("#quesContent").val();
        qdata.is_anonymous = Number($("#quesAnonymous").is(':checked'));
        qdata.is_public = Number($("#quesPublic").is(':checked'));
        $.post("API/newquestion.php",qdata,function(data){
            console.log(data);
            if(alertStatus(data['status'])) {
                $("#moreBox").show();
                try {
                    $("#morelink").attr("href","question.php?id="+data['data']['id']);
                } catch(e) {
                    console.log(e);
                }
            }
        });
    }
    var eventInitButtons = function() {
        $("input[name='quesType']").click(function(){
            if ($(this).val()==2) $(".showBox").show();
            else $(".showBox").hide();
        });
        $("#submitBtn").click(submitForm);
    }
    
    var eventInitForms = function() {
        $('input,textarea').characterCounter();
    }
    
    var eventInit = function() {
        //Init buttons event listeners
        eventInitButtons();
        //Init forms
        eventInitForms();
    }
    
    app.init = function() {
        eventInit();
    }
}

$(function(){
    var app = new App();
    app.init();  
});


