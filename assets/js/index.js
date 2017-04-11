var qSettings = {};
qSettings.sortby = 1; //1推荐问题 2按时间排列 3按热度排列
qSettings.searchTime = 1*60 //搜索间隔1秒
qSettings.searchOK = true;
qSettings.start = 0;
qSettings.contentNum = 80; //正文限制字数
qSettings.prevSettings = {};
qSettings.full = false; //是否加载完毕
qSettings.type = ""; 
qSettings.searchDistance = 500; //下拉超过一定距离就不能使用回车键搜索

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
    errormsg['error'] = "搜索时遇到数据库错误.";
    errormsg['login first']="请先登录!";
    var currQ = [];
    var sQ = $("<div class='ques'></div>");
    sQ.html("<div class='timeBox'>8天前</div><div class='mainQuesBox' data-id='110'><h5>标题</h5><p>正文</p></div><div class='otherBox'><p><i class='material-icons dp48'>star</i><span class='starNum'>9999</span>&nbsp;&nbsp;&nbsp;<i class='material-icons dp48'>comment</i><span class='commentNum'></span>&nbsp;&nbsp;<span class='typeBox'><span></p></div>");
    var toggleStatus = function(str) {
        $("#moreText").html(str);
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
    this.newQues = function(ques) {
        //console.log(ques.miliTime);
        var sQnew = sQ.clone();
        sQnew.find(".timeBox").text(ques.time);
        sQnew.find(".mainQuesBox").data("id",ques.id);
        sQnew.find(".mainQuesBox").attr("data-id",ques.id);
        sQnew.find("h5").text(ques.subject);
        sQnew.find(".mainQuesBox").children("p").text(ques.content);
        sQnew.find(".starNum").text(ques.hot);
        sQnew.find(".typeBox").text(ques.type);
        sQnew.find(".commentNum").text(ques.commentNum);
        $("#mainQuesBox").append(sQnew);
        sQnew.find("h5").click(function(e){     
            var id= $(this).parent().data("id");
            console.log("clickEvent:",id);
            window.location.href = "question.php?id="+id;
            e.preventDefault();
            e.stopPropagation();
            return;
        });
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
                    toggleStatus("没有更多了.");
                    if (l==0) {
                        Materialize.toast("没有查询到数据!",3000);
                        toggleStatus("没有查询到，您可以<a href='new.php?content="+sSettings.text0+"'>发布该问题</a>.");
                    }
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
    var more = function() {
        toggleStatus("加载中...");
        $.post("API/getlist.php",{
            search:qSettings.prevSettings.text0,
            type:qSettings.prevSettings.type0,
            sortby:qSettings.prevSettings.sortby0,
            start:qSettings.prevSettings.start0
        },function(data){
            if(alertStatus(data['status'])) {
                var qldata = data['data'];
                var l = qldata.length;
                //console.log(data);
                toggleStatus("下拉加载更多...");
                qSettings.start += 10;
                qSettings.prevSettings.start0 +=10; 
                if (l<10) {
                    if (l==0) Materialize.toast("没有更多了!",3000);
                    toggleStatus("没有更多了.");
                    qSettings.full = true;
                    qSettings.start = 0;
                }
                for (var i=0;i<l;i++) 
                    if (qSettings.type=="" || qldata[i]['type'] == qSettings.type) {
                        var newQ = new Ques(null,qldata[i]);
                        app.newQues(newQ);
                        currQ.push(newQ);
                    }             
            } else {
                toggleStatus("加载失败，请重新搜索.");
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
    var sort = function(type,sort) {
        if (sort) {
            //console.log(sort);
            if (sort=="hot" || sort=="time") currQ.sort(sortFunc[sort]);
            else if (sort == "recommended") {
                removeAllData();
                search({
                    text0:"",
                    type0:"",
                    sortby0:"recommended",
                    start0:0
                });
                return;
            }
            else {
                Materialize.toast("排序类型不存在!",3000);
                return;
            }
        }
        removeAllQues();
        
        for (var i=0;i<currQ.length;i++) 
            if (qSettings.type=="" || currQ[i].typeid == qSettings.type) {
                //console.log(i);
                app.newQues(currQ[i]);
            }
                
            
    }
    
    var eventInitButtons = function() {
        $("#searchImage").click(function(){
            if (!qSettings.searchOK) {
                Materialize.toast("您搜索得太快了!",3000);
                return;
            }
            qSettings.searchOK = false;
            setTimeout("qSettings.searchOK = true;",qSettings.searchTime);
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
            removeAllData();
            search(sSettings);
        });
        
        $(document).keypress(function(e) { //加入回车键快捷搜索
            if (e.which == 13 && $(document).scrollTop() < qSettings.searchDistance) {
                $("#searchImage").click();
                e.stopImmediatePropagation();
                e.preventDefault();
            }
        });
        $(".sort").click(function(e) {
            if (!$(this).hasClass("active")) {
                $(".sort.active").removeClass("active");
                $(this).addClass("active");
            }
            sort(qSettings.type,$(this).data("val"));
            e.preventDefault();
            return;
        });
        $(".type").click(function(e) {
            if (!$(this).hasClass("active")) {
                $(".type.active").removeClass("active");
                $(this).addClass("active");
            }
            qSettings.type = $(this).data("val");
            sort(qSettings.type);
            e.preventDefault();
            return;
        });
         
    }
    var getHotSubjects = function() {
        var hotSubjects = {};
        $.post("API/getHotSubjects.php",{},function(data){
            if(data['status'] == 'success') {
               
                var sdata = data['data'];
                var l = sdata.length;
                for (var i=0;i<l;i++) 
                    hotSubjects[sdata[i]['subject']] = null;   
            } 
            $('#searchBox').autocomplete({
                data: hotSubjects,
                limit: 20,
            });
        });
    }
    var eventInitForms = function() {
        $('#searchBox').characterCounter();
        getHotSubjects();
        $(".button-collapse").sideNav();
        $(window).scroll(function() {
            if (!qSettings.full && $(document).scrollTop() >= $(document).height() - $(window).height()) {
                more();
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
            sortby0:"recommended",
            //sortby0:"hot",
            start0:0
        });
    }
}

$(function(){
    var app = new App();
    app.init();  
});