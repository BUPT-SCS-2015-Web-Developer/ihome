var qSettings = {};
qSettings.sortby = 1; //1推荐问题 2按时间排列 3按热度排列
qSettings.start = 0;
qSettings.contentNum = 80;
qSettings.prevSettings = {};
qSettings.full = false;
var Ques = function(quesID,qs) {
    var errormsg = {};
    errormsg['error'] = "加载问题详情时遇到数据库错误.";
    errormsg['login first']="请先登录!";
    errormsg['failed']="该问题可能已经被删除!";
    var timeFormat = function(time) {
        var i = time.indexOf(".");
        if (i>0) return new timeago().format(time.substring(0,i)); 
        else return new timeago().format(time); 
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
        this.time = timeFormat(qs.create_time);
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
    errormsg['error'] = "搜索时遇到数据库错误.";
    errormsg['login first']="请先登录!";
    var currQ = [];
    var sQ = $("<div class='ques'></div>");
    sQ.html("<div class='timeBox'>8天前</div><div class='mainQuesBox' data-id='110'><h5>标题</h5><p>正文</p></div><div class='otherBox'><p><i class='material-icons dp48'>star</i><span id='starNum'>9999</span>&nbsp;&nbsp;<i class='material-icons dp48'>comment</i><span id='commentNum'>9</span></p></div>");
    var toggleStatus = function(str) {
        $("#moreText").text(str);
    }
    
    var removeAll = function() {
        $(".ques").remove();
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
    this.newQues = function(ques) {
        var sQnew = sQ.clone();
        sQnew.find(".timeBox").text(ques.time);
        sQnew.find(".mainQuesBox").data("id",ques.id);
        sQnew.find("h5").text(ques.subject);
        sQnew.find(".mainQuesBox").children("p").text(ques.content);
        sQnew.find("#starNum").text(ques.hot);
        sQnew.find("#commentNum").text(ques.commentNum);
        $("#mainQuesBox").append(sQnew);
    }
    var search = function(sSettings) {
        toggleStatus("加载中...");
        qSettings.full = false;
        $.post("API/getlist.php",{
            text:sSettings.text0,
            type:sSettings.type0,
            sortby:sSettings.sortby0,
            start:sSettings.start0
        },function(data){
            if(alertStatus(data['status'])) {
                var qldata = data['data'];
                var l = qldata.length;
                if (l<10) {
                    if (l==0) Materialize.toast("没有结果!",3000);
                    toggleStatus("没有更多了.");
                    qSettings.full = true;
                }
                for (var i=0;i<l;i++) {
                    var newQ = new Ques(null,qldata[i]);
                    app.newQues(newQ);
                    currQ.push(newQ);
                }
                qSettings.start = 10;
                qSettings.prevSettings = sSettings;
                qSettings.prevSettings.start0 = 10;
                toggleStatus("下拉加载更多...");
            } else {
                toggleStatus("加载失败，请重新搜索.");
            }
        });
    }
    var more = function(me) {
        toggleStatus("加载中...");
        $.post("API/getlist.php",{
            text:qSettings.prevSettings.text0,
            type:qSettings.prevSettings.type0,
            sortby:qSettings.prevSettings.sortby0,
            start:qSettings.prevSettings.start0
        },function(data){
            if(alertStatus(data['status'])) {
                var qldata = data['data'];
                var l = qldata.length;
                if (l<10) {
                    if (l==0) Materialize.toast("没有结果!",3000);
                    toggleStatus("没有更多了.");
                    qSettings.full = true;
                }
                for (var i=0;i<l;i++) {
                    var newQ = new Ques(null,qldata[i]);
                    app.newQues(newQ);
                    currQ.push(newQ);
                }
                qSettings.start += 10;
                qSettings.prevSettings.start0 +=10;
                toggleStatus("下拉加载更多...");
            } else {
                toggleStatus("加载失败，请重新搜索.");
            }
            me.resetload();
        });
    }
    
    
    var eventInitButtons = function() {
        $(".ques h5").click(function(){
            var id= $(this).parent().data("id");
            window.location.href = "question.php?id="+id;
        });
        $("#searchImage").click(function(){
            var sSettings = {};
            sSettings.type0 = $('input[name="searchType"]:checked').val();
            sSettings.text0 = $("#searchBox").val();
            sSettings.sortby0 = "time";
            sSettings.start0 = 0;
            if (sSettings.text0=="") {
                Materialize.toast("搜索内容不能为空!",3000);
                return;
            } 
            if (!$.inArray(sSettings.type0,[null,"","1","2",1,2])) {
                Materialize.toast("搜索类型不符!",3000);
                return;
            }
            $(".ques").remove();
            search(sSettings);
        });
        $(".sort").click(function() {
           if (!$(this).hasClass("active")) {
               $(".sort.active").removeClass("active");
               $(this).addClass("active");
           } 
        });
        
    }
    
    var eventInitForms = function() {
        $('#searchBox').characterCounter();
        $('#searchBox').autocomplete({
            data: {
            "北邮宿舍问题xxxxx": null,
            "北邮坑爹啊！": null,
            "苟利国家生死以，岂因祸福避趋之？": null
            },
            limit: 20,
        });
        
        //下拉加载
        $("#mainQuesBox").dropload({
            scrollArea : window,
            loadDownFn : function(me){
                if (!qSettings.full) more(me);
            }
        });
    }
    
    var eventInit = function() {
        //Init buttons event listeners
        eventInitButtons();
        
        //Init forms
        eventInitForms();
    }
    
    app.init = function() {
        eventInit();
        search({
            text0:"",
            type0:"",
            //sortby0:"recommended",
            sortby0:"hot",
            start0:0
        });
    }
}

$(function(){
    var app = new App();
    app.init();  
});