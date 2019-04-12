{{--
What    :   The foot tags containing JavaScript Tags
Author  :   Alvin Mukiibi
Date    :   6th-February-2019
--}}

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/jquery-ui.min.js')}}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Bootstrap datatables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
{{-- for the select multiple button --}}
<script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>

<!-- Morris.js charts -->
<script src="{{asset('plugins/raphael-min.js')}}"></script>
<script src="{{asset('plugins/morris/morris.min.js')}}"></script>

<script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('plugins/knob/jquery.knob.js')}}"></script>

<!-- datetimepicker -->
<script src="{{asset('plugins/moment.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-datetimepicker.js')}}"></script>
{{-- icheck --}}
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
<script src="{{asset('plugins/popper.min.js')}}"></script>

{{-- FullCalendar --}}
<script src="{{asset('plugins/fullcalendar/fullcalendar.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2();
      $("#example1").DataTable();
      $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
    });
    })
    // $(document).ready(function()
    // {
    //     $('#example').DataTable();
    // } );
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });




      </script>
      <script>
            $(function () {

              /* initialize the external events
               -----------------------------------------------------------------*/
              function ini_events(ele) {
                ele.each(function () {

                  // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                  // it doesn't need to have a start or end
                  var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                  }

                  // store the Event Object in the DOM element so we can get to it later
                  $(this).data('eventObject', eventObject)

                  // make the event draggable using jQuery UI
                  $(this).draggable({
                    zIndex        : 1070,
                    revert        : true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                  })

                })
              }

              ini_events($('#external-events div.external-event'))

              /* initialize the calendar
               -----------------------------------------------------------------*/
              //Date for the calendar events (dummy data)
              var date = new Date()
              var d    = date.getDate(),
                  m    = date.getMonth(),
                  y    = date.getFullYear()
              $('#calendar').fullCalendar({
                header    : {
                  left  : 'prev,next today',
                  center: 'title',
                  right : 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                  today: 'today',
                  month: 'month',
                  week : 'week',
                  day  : 'day'
                },
                //Random default events
                events    : [
                  {
                    title          : 'All Day Event',
                    start          : new Date(y, m, 1),
                    backgroundColor: '#f56954', //red
                    borderColor    : '#f56954' //red
                  },
                  {
                    title          : 'Long Event',
                    start          : new Date(y, m, d - 5),
                    end            : new Date(y, m, d - 2),
                    backgroundColor: '#f39c12', //yellow
                    borderColor    : '#f39c12' //yellow
                  },
                  {
                    title          : 'Meeting',
                    start          : new Date(y, m, d, 10, 30),
                    allDay         : false,
                    backgroundColor: '#0073b7', //Blue
                    borderColor    : '#0073b7' //Blue
                  },
                  {
                    title          : 'Lunch',
                    start          : new Date(y, m, d, 12, 0),
                    end            : new Date(y, m, d, 14, 0),
                    allDay         : false,
                    backgroundColor: '#00c0ef', //Info (aqua)
                    borderColor    : '#00c0ef' //Info (aqua)
                  },
                  {
                    title          : 'Birthday Party',
                    start          : new Date(y, m, d + 1, 19, 0),
                    end            : new Date(y, m, d + 1, 22, 30),
                    allDay         : false,
                    backgroundColor: '#00a65a', //Success (green)
                    borderColor    : '#00a65a' //Success (green)
                  },
                  {
                    title          : 'Click for Google',
                    start          : new Date(y, m, 28),
                    end            : new Date(y, m, 29),
                    url            : 'http://google.com/',
                    backgroundColor: '#3c8dbc', //Primary (light-blue)
                    borderColor    : '#3c8dbc' //Primary (light-blue)
                  }
                ],
                editable  : true,
                droppable : true, // this allows things to be dropped onto the calendar !!!
                drop      : function (date, allDay) { // this function is called when something is dropped

                  // retrieve the dropped element's stored Event Object
                  var originalEventObject = $(this).data('eventObject')

                  // we need to copy it, so that multiple events don't have a reference to the same object
                  var copiedEventObject = $.extend({}, originalEventObject)

                  // assign it the date that was reported
                  copiedEventObject.start           = date
                  copiedEventObject.allDay          = allDay
                  copiedEventObject.backgroundColor = $(this).css('background-color')
                  copiedEventObject.borderColor     = $(this).css('border-color')

                  // render the event on the calendar
                  // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                  $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                  // is the "remove after drop" checkbox checked?
                  if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove()
                  }

                }
              })

              /* ADDING EVENTS */
              var currColor = '#3c8dbc' //Red by default
              //Color chooser button
              var colorChooser = $('#color-chooser-btn')
              $('#color-chooser > li > a').click(function (e) {
                e.preventDefault()
                //Save color
                currColor = $(this).css('color')
                //Add color effect to button
                $('#add-new-event').css({
                  'background-color': currColor,
                  'border-color'    : currColor
                })
              })
              $('#add-new-event').click(function (e) {
                e.preventDefault()
                //Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                  return
                }

                //Create events
                var event = $('<div />')
                event.css({
                  'background-color': currColor,
                  'border-color'    : currColor,
                  'color'           : '#fff'
                }).addClass('external-event')
                event.html(val)
                $('#external-events').prepend(event)

                //Add draggable funtionality
                ini_events(event)

                //Remove event from text input
                $('#new-event').val('')
              })
            });
            $(function () {
                $('[data-toggle="popover"]').popover()
              })
          </script>

</body>
</html>
