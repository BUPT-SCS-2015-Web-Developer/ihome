var qSettings = {};
qSettings.sortby = 1; //1推荐问题 2按时间排列 3按热度排列
qSettings.start = 0;
qSettings.recommendedQuestions = [2,3,4];
var App = function() {
    var app = this;
    var errormsg = {};
    errormsg['']
    var alertStatus = function(type) {
        if (type=="success") return;
        try {
            Materialize.toast(errormsg[type],4000);
        } catch(e) {
            Materialize.toast("未知错误",3000);
        }
    }
    var search = function(text0,type0,sortby0,start0) {
        
        $.post("API/getlist.php",{
            text:text0,
            type:type0,
            sortby:sortby0,
            start:start0
        },function(data){
            console.log(data);
            alertStatus(data['status']);
        });
    }
    var EIButtons = function() {
        
    }
    app.eventInit = function() {
        
    }
}

$(function(){
    $('#searchBox').characterCounter();
    $('#searchBox').autocomplete({
    data: {
      "北邮宿舍问题xxxxx": null,
      "北邮坑爹啊！": null,
      "苟利国家生死以，岂因祸福避趋之？": null
    },
    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
  });
});