//鼠标进出改变列表行颜色
var trObj=document.getElementsByTagName("tr");
  for (var i=1;i<trObj.length;i++){
    trObj[i].onmouseover =function () {
      // body...
      this.style.backgroundColor="#404040"
    };
    trObj[i].onmouseout =function () {
      // body...
      this.style.backgroundColor="#000000";
    };
  }