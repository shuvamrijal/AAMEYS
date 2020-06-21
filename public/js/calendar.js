$(document).ready(function(){
var calendar = document.getElementById("calendar-table");
var gridTable = document.getElementById("table-body");
var currentDate = new Date();
var selectedDate = currentDate;
var selectedDayBlock = null;
var globalEventObj = {};

var sidebar = document.getElementById("sidebar");

function createCalendar(date, side) {
   var currentDate = date;
   var datevalue=date.toLocaleString("en-AU", {
     year: "numeric",
     month: "numeric",
     day: "numeric"
 });

   showevent(datevalue);
   var startDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

   var monthTitle = document.getElementById("month-name");
   var monthName = currentDate.toLocaleString("en-US", {
      month: "long"
   });
   var yearNum = currentDate.toLocaleString("en-US", {
      year: "numeric"
   });
   monthTitle.innerHTML = `${monthName} ${yearNum}`;

   if (side == "left") {
      gridTable.className = "animated fadeOutRight";
   } else {
      gridTable.className = "animated fadeOutLeft";
   }

   setTimeout(() => {
      gridTable.innerHTML = "";

      var newTr = document.createElement("div");
      newTr.className = "row";
      var currentTr = gridTable.appendChild(newTr);

      for (let i = 1; i < startDate.getDay(); i++) {
         let emptyDivCol = document.createElement("div");
         emptyDivCol.className = "col empty-day";
         currentTr.appendChild(emptyDivCol);
      }

      var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
      lastDay = lastDay.getDate();

      for (let i = 1; i <= lastDay; i++) {
         if (currentTr.children.length >= 7) {
            currentTr = gridTable.appendChild(addNewRow());
         }
         let currentDay = document.createElement("div");
         currentDay.className = "col";
         currentDay.id=i;
         if (selectedDayBlock == null && i == currentDate.getDate() || selectedDate.toDateString() == new Date(currentDate.getFullYear(), currentDate.getMonth(), i).toDateString()) {
            selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);

            document.getElementById("eventDayName").innerHTML = selectedDate.toLocaleString("en-US", {
               month: "long",
               day: "numeric",
               year: "numeric"
            });
            selectedDayBlock = currentDay;
            setTimeout(() => {
               currentDay.classList.add("blue");
               currentDay.classList.add("lighten-3");
            }, 900);
         }
         currentDay.innerHTML = i;
         //show marks
         if (globalEventObj[new Date(currentDate.getFullYear(), currentDate.getMonth(), i).toDateString()]) {
            let eventMark = document.createElement("div");
            eventMark.className = "day-mark";
            currentDay.appendChild(eventMark);
         }
         currentTr.appendChild(currentDay);
      }

      for (let i = currentTr.getElementsByTagName("div").length; i < 7; i++) {
         let emptyDivCol = document.createElement("div");
         emptyDivCol.className = "col empty-day";
         currentTr.appendChild(emptyDivCol);
      }

      if (side == "left") {
         gridTable.className = "animated fadeInLeft";
      } else {
         gridTable.className = "animated fadeInRight";
      }

      function addNewRow() {
         let node = document.createElement("div");
         node.className = "row";
         return node;
      }

   }, !side ? 0 : 270);
}

createCalendar(currentDate);

var todayDayName = document.getElementById("todayDayName");
todayDayName.innerHTML = "Today is " + currentDate.toLocaleString("en-US", {
   weekday: "long",
   day: "numeric",
   month: "short"
});

var prevButton = document.getElementById("prev");
var nextButton = document.getElementById("next");

prevButton.onclick = function changeMonthPrev() {
   currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1);
   createCalendar(currentDate, "left");
}
nextButton.onclick = function changeMonthNext() {
   currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1);
   createCalendar(currentDate, "right");
}
gridTable.onclick = function (e) {
    $("#event_details").show(250);
   if (!e.target.classList.contains("col") || e.target.classList.contains("empty-day")) {
      return;
   }
   if (selectedDayBlock) {
      if (selectedDayBlock.classList.contains("active")) {
         selectedDayBlock.classList.remove("active");
      }
   }
   selectedDayBlock = e.target;
   selectedDayBlock.classList.add("active");


   selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), parseInt(e.target.innerHTML));
   document.getElementById("eventDayName").innerHTML = selectedDate.toLocaleString("en-US", {
      month: "numeric",
      day: "numeric",
      year: "numeric"
   });
   var datevalue=selectedDate.toLocaleString("en-AU", {
     year: "numeric",
     month: "numeric",
     day: "numeric"
 });
 showevent(datevalue);
//  displayEvent(datevalue);
}


function showevent(datevalue){
  var dayvalue;
  $("#event_details").empty();
  $.ajax({
     type:'get',
     url:'/staff/getevent',
     dataType: 'json',
     success:function(response){
      var len = response.length;
       var flag=0;
       for(var i=0; i<len; i++){
       var getvalue=new Date(response[i].event_date).toLocaleString("en-au",{
         year: "numeric",
         month: "numeric",
         day: "numeric"
       });

         if(datevalue===getvalue){
           flag=1;
           $('#event_details').append("<li><h5>"+response[i].event_title +"</h5><p>"+response[i].event_desc+"</p></li>");

           }
            dayvalue=new Date(response[i].event_date);
            markEvent(dayvalue.getDate());
       }
       if(flag===1){
          $('#message').text("List of events");
       }else{
           $('#message').text("Sorry, no event on selected date");
       }
  }
  });
}

function markEvent(value){
  //alert(value);
  var flag=0;
  var i=0;
  var colvalue=[];
  $('#table-body .row .col').each(function() {
    if($(this).html()!=''){
      i++;
       colvalue[i]=$(this).html();
    }
  });
 for(var j=1; j<colvalue.length; j++){
    if(colvalue[j]==value){
      $('#'+value).addClass("markevent");
    }

 }
}


});
