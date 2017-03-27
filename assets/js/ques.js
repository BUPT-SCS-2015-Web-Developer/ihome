var qSettings = {};
qSettings.commentTime = 30*100; //30秒内无法再次评论
qSettings.commentOK = true;

var Ques = function(quesID,qs) {
    var errormsg = {};
    errormsg['error'] = "加载问题详情时遇到数据库错误.";
    errormsg['login first']="请先登录!";
    errormsg['failed']="该问题可能已经被删除!";
    var typeName = {};
    typeName[1]="生活服务";
    typeName[2]="问题反馈";
    var timeFormat = function(time) {
        var i = time.indexOf(".");
        if (i>0) return new timeago().format(time.substring(0,i)); 
        else return new timeago().format(time); 
    }
    var miliTimeFormat = function(time) {
        var i = time.indexOf(".");
        if (i>0) return Date.parse(time.substring(0,i)); 
        else return Date.parse(time); 
    }
    var typeFormat = function(type) {
        try {
            return typeName[type];
        } catch(e) {
            Materialize.toast("数据库错误!",3000);
        }
        return "";
    }
    var alertStatus = function(type) {
        if (type=="success") return true;
        try {
            Materialize.toast(errormsg[type],4000);
        } catch(e) {
            Materialize.toast("加载问题详情时遇到未知错误",3000);
        }
        return false;
    }
    var contentComp = function(str,num) {
        if (str.length>num) {
            var str2 = (str.substring(0,num))+"...";
            return str2;
        }
        return str;
    }
    var ques = this;
    if (qs) {
        this.loaded = true;
        this.id = qs.id;
        this.type = typeFormat(qs.type);
        this.typeid = qs.type;
        this.time = timeFormat(qs.create_time);
        this.miliTime = miliTimeFormat(qs.create_time);
        this.subject = qs.subject;
        this.content = contentComp(qs.content,qSettings.contentNum);
        this.hot = qs.hot;
        this.commentNum = qs.commentNum;
    } else {
        this.loaded = false;
        $.post("getquestion.php",{id:quesID},function(data){
            if (alertStatus(data['status'])) {
                var qdata = data['data'];
                ques.loaded = true;
                ques.id = quesID;
                ques.time = timeFormat(qdata['create_time']);
                ques.miliTime = miliTimeFormat(qdata['create_time']);
                ques.type = typeFormat(qdata['type']);
                ques.typeid = qdata['type'];
                ques.subject = qdata['subject'];
                ques.content = contentComp(qdata['content'],qSettings.contentNum);
                ques.hot = qdata['hot'];
                ques.commentNum = qdata['comment'].length;
            }
        });
    }
    
    
}

var App = function() {
    var app = this;
    var errormsg = {};
    errormsg['error'] = "评论时遇到数据库错误.";
    errormsg['login first']="请先登录!";
    errormsg['parameter error']="参数错误!";
    var toggleStatus = function(str) {
        $("#moreText").text(str);
    }
    var removeAllQues = function() {
        $(".ques").remove();
    }
    var removeAllData = function() {
        $(".ques").remove();
        currQ = [];
    }
    var alertStatus = function(type) {
        if (type=="success") return true;
        try {
            Materialize.toast(errormsg[type],4000);
        } catch(e) {
            Materialize.toast("未知错误",3000);
        }
        return false;
    }
   
    var search = function(sSettings) {
        toggleStatus("加载中...");
        qSettings.full = false;
        //console.log(sSettings);
        $.post("API/getlist.php",{
            search:sSettings.text0,
            type:sSettings.type0,
            sortby:sSettings.sortby0,
            start:sSettings.start0
        },function(data){
            if(alertStatus(data['status'])) {
                //console.log("search:",data);
                var qldata = data['data'];
                var l = qldata.length;
                toggleStatus("下拉加载更多...");
                if (l<10) {
                    if (l==0) Materialize.toast("没有查询到数据!",3000);
                    toggleStatus("没有更多了.");
                    qSettings.full = true;
                }
                for (var i=0;i<l;i++) 
                    if (qSettings.type=="" || qldata[i]['type'] == qSettings.type) {
                        var newQ = new Ques(null,qldata[i]);
                        app.newQues(newQ);
                        currQ.push(newQ);
                    }         
                qSettings.start = 10;
                qSettings.prevSettings = sSettings;
                qSettings.prevSettings.start0 = 10;
            } else {
                toggleStatus("加载失败，请重新搜索.");
            }
        });
    }
    
    var comment = function(cSettings) {
        qSettings.full = false;
        //console.log(sSettings);
        $.post("API/comment.php",{
            id:cSettings.id,
            content:cSettings.content,
            reply_floor:cSettings.reply_floor,
            is_anonymous:sSettings.is_anonymous
        },function(data){
            if(alertStatus(data['status'])) {
                console.log("search:",data);
                Materialize.toast("评论提交成功!",3000);
            }
        });
    }
    var sortFunc = {
        hot:function(a,b) {
            return b.hot-a.hot;
        },
        time:function(a,b) {
            return b.miliTime-a.miliTime;
        }
    }

    
    var eventInitButtons = function() {
        $("#submitBtn").click(function(){
            if (!qSettings.commentOK) {
                Materialize.toast("您评论得太快了!",3000);
                return;
            }
            qSettings.commentOK = false;
            setTimeout("qSettings.commentOK = true;",qSettings.commentTime);
            
            var cSettings = {};
            cSettings.id = window.id;
            cSettings.content = $("#comment").val();
            cSettings.is_anonymous = Number($("#anonymous").is(':checked'));
            cSettings.reply_floor = qSettings.reply_floor;
            if (sSettings.content=="") {
                Materialize.toast("评论内容不能为空!",3000);
                return;
            } 
            comment(cSettings);
        });
        
        $(document).keypress(function(e) { //回车键快捷评论
            if (e.which == 13 && ($("#comment").is(":focus") || $("#anonymous").is(":focus"))) {
                $("#submitBtn").click();
                e.stopImmediatePropagation();
                e.preventDefault();
            }
        });
    }
    
    var eventInitForms = function() {
        $('#searchBox').characterCounter();
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