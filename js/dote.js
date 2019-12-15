// forked from dentaq's "forked: 2012-01-23 3rd" http://jsdo.it/dentaq/x9wq
// forked from dentaq's "2012-01-23 3rd" http://jsdo.it/dentaq/sm5h
/*
function setC()	{
	var cc = document.f1.color.value;
	window.localStorage.setItem("color", cc);
	$("body").css("background-color",cc);
}
*/

$(function(){

$("select[name=color]").change(function(){
	var cc = document.f1.color.value;
	window.localStorage.setItem("color", cc);
	$("body").css("background-color",cc);
	});

$("select[name=paintcolor]").change(function(){
	var pc = document.f1.paintcolor.value;
	window.localStorage.setItem("pcolor", pc);
	});
});

function dLoad()	{
	var ccc = window.localStorage.getItem("color");
	$("body").css("background-color",ccc);
	$("#grid div").each(function(i){
	var dcall = window.localStorage.getItem("dcol"+i);
	$("#grid div").eq(i).attr("class",dcall);
	
    });
	}

function dSave()	{
    $("#grid div").each(function(i){
    	var cls = $("#grid div").eq(i).attr("class");
	window.localStorage.setItem("dcol"+i,cls);
    });
}


$(function(){
	dLoad();
    for(var i=0;i<24*24;i++){
	$("#grid").append("<div>");
	$("#grid div").eq(i).attr({id:"div"+i});
	window.localStorage.setItem("div"+i,"off");
    }
    
	$("#grid div").click(function(){
	var pcol = window.localStorage.getItem("pcolor");
	$(this).toggleClass("on").addClass(pcol);
	});
});

//10秒おきに自動保存
setInterval(function() {  dSave() }, 10000);