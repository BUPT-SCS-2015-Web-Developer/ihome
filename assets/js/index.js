var qSettings = {};
qSettings.sortby = 1; //1推荐问题 2按时间排列 3按热度排列
qSettings.currentOn = 10;



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