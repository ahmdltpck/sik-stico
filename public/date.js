$(function (){
    $('#datetimepicker1').datetimepicker();
  });
  $(function () {
    $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD h:m:s A',
      });
  });
  $(function () {
    $('#datetimepicker3').datetimepicker({
        format: 'LT'
      });
  });
  $(function () {
    $('#datetimepicker4').datetimepicker();
  });
  $(function () {
    $('#datetimepicker5').datetimepicker({
      icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-arrow-up",
              down: "fa fa-arrow-down"
            }
        });
  });
  $(function () {
    $('#datetimepicker6').datetimepicker({
      viewMode: 'years'
    });
  });
  $(function () {
    $('#datetimepicker7').datetimepicker({
      viewMode: 'years',
      format: 'MM/YYYY'
    });
  });
$(function () {
  $('#datetimepicker8').datetimepicker({
    defaultDate: "11/1/2016",
    disabledDates: [
                  moment("12/25/2016"),
                  new Date(2016, 11 - 1, 21),
                  "11/22/2016 00:53"
                ]
            });
  });
