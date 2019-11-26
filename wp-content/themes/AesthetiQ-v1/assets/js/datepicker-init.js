var $ = jQuery.noConflict();

$(document).ready(function() {
  $.fn.datepicker.language["en"] = {
    days: [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday"
    ],
    daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    daysMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    months: [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December"
    ],
    monthsShort: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec"
    ],
    today: "Today",
    clear: "Clear",
    dateFormat: "M d, yyyy",
    timeFormat: "hh:ii aa",
    firstDay: 0
  };

  // Initialization
  $("#preferred_date").datepicker({
    language: "en",
    minDate: new Date(),
    todayButton: new Date(),
    clearButton: true
  });
  // Access instance of plugin
  $("#preferred_date").data("datepicker");
});
