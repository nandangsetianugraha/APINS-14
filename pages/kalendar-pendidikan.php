<?php $data="Kalendar Pendidikan";?>
<?php include "layout/head.php"; ?>
<link rel="stylesheet" href="<?=base_url();?>assets/js/fullcalendar/lib/main.css">
</head>

<body class="preload-active aside-active aside-mobile-minimized aside-desktop-maximized">
	<!-- BEGIN Preload -->
	<?php include "layout/loader.php"; ?>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Aside -->
		<?php include "layout/aside.php";?>
		<!-- END Aside -->
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper ">
			<!-- BEGIN Header -->
			<?php include "layout/header.php";?>
			<!-- END Header -->
			<!-- BEGIN Page Content -->
			<div class="content">
				<div class="container-fluid g-5">
					<div class="row">
						<div class="col-12">
							<!-- BEGIN Portlet -->
							<div class="portlet">
								<div class="portlet-body">
                                  	<input type="hidden" name="tapel" id="tapel" class="form-control" value="<?=$tapel;?>" placeholder="Username">
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
									<div id="calendar"></div>
								</div>
							</div>
							<!-- END Portlet -->
						</div>
					</div>
				</div>
			</div>
			<!-- END Page Content -->
			<!-- BEGIN Footer -->
			<?php include "layout/footer.php";?>
			<!-- END Footer -->
		</div>
		<!-- END Page Wrapper -->
	</div>
	<!-- END Page Holder -->
	<!-- BEGIN Modal -->
	<div class="modal fade" id="info">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="ekskulForm" method="POST" action="modul/rapor/simpan-ekskul.php" class="form">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script src="<?=base_url();?>assets/js/fullcalendar/lib/main.js"></script>
	<script>
	document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'id',
    height: 650,
  });

  calendar.render();
});

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'id',
    height: 650,
    events: 'modul/kalendar/fetchEvents.php',
  });

  calendar.render();
});

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
	initialView: 'dayGridMonth',
    locale: 'id',
	height: 650,
	events: 'modul/kalendar/fetchEvents.php',

	selectable: true,
	select: async function (start, end, allDay) {
	  const { value: formValues } = await Swal.fire({
		title: 'Add Event',
		html:
		  '<input id="swalEvtTitle" class="swal2-input" placeholder="Enter title">' +
		  '<textarea id="swalEvtDesc" class="swal2-input" placeholder="Enter description"></textarea>' +
		  '<input id="swalEvtURL" class="swal2-input" placeholder="Enter URL">',
		focusConfirm: false,
		preConfirm: () => {
		  return [
			document.getElementById('swalEvtTitle').value,
			document.getElementById('swalEvtDesc').value,
			document.getElementById('swalEvtURL').value
		  ]
		}
	  });

	  if (formValues) {
		// Add event
		fetch("modul/kalendar/eventHandler.php", {
		  method: "POST",
		  headers: { "Content-Type": "application/json" },
		  body: JSON.stringify({ request_type:'addEvent', start:start.startStr, end:start.endStr, event_data: formValues}),
		})
		.then(response => response.json())
		.then(data => {
		  if (data.status == 1) {
			Swal.fire('Event added successfully!', '', 'success');
		  } else {
			Swal.fire(data.error, '', 'error');
		  }

		  // Refetch events from all sources and rerender
		  calendar.refetchEvents();
		})
		.catch(console.error);
	  }
	}
  });

  calendar.render();
});

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    height: 650,
    locale: 'id',
    events: 'modul/kalendar/fetchEvents.php',

    eventClick: function(info) {
      info.jsEvent.preventDefault();
      
      // change the border color
      info.el.style.borderColor = 'red';
      
      Swal.fire({
        title: info.event.title,
        icon: 'info',
        html:'<p>'+info.event.extendedProps.description+'</p><a href="'+info.event.url+'">Visit event page</a>',
      });
    }
  });

  calendar.render();
});

//Delete Event
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
	initialView: 'dayGridMonth',
    locale: 'id',
	height: 650,
	events: 'modul/kalendar/fetchEvents.php',

	selectable: true,
	select: async function (start, end, allDay) {
	  const { value: formValues } = await Swal.fire({
		title: 'Add Event',
		html:
		  '<input id="swalEvtTitle" class="swal2-input" placeholder="Enter title">' +
		  '<textarea id="swalEvtDesc" class="swal2-input" placeholder="Enter description"></textarea>' +
		  '<input id="swalEvtURL" class="swal2-input" placeholder="Enter URL">',
		focusConfirm: false,
		preConfirm: () => {
		  return [
			document.getElementById('swalEvtTitle').value,
			document.getElementById('swalEvtDesc').value,
			document.getElementById('swalEvtURL').value
		  ]
		}
	  });

	  if (formValues) {
		// Add event
		fetch("modul/kalendar/eventHandler.php", {
		  method: "POST",
		  headers: { "Content-Type": "application/json" },
		  body: JSON.stringify({ request_type:'addEvent', start:start.startStr, end:start.endStr, event_data: formValues}),
		})
		.then(response => response.json())
		.then(data => {
		  if (data.status == 1) {
			Swal.fire('Event added successfully!', '', 'success');
		  } else {
			Swal.fire(data.error, '', 'error');
		  }

		  // Refetch events from all sources and rerender
		  calendar.refetchEvents();
		})
		.catch(console.error);
	  }
	},

	eventClick: function(info) {
	  info.jsEvent.preventDefault();
	  
	  // change the border color
	  info.el.style.borderColor = 'red';
	  
	  Swal.fire({
		title: info.event.title,
		icon: 'info',
		html:'<p>'+info.event.extendedProps.description+'</p><a href="'+info.event.url+'">Visit event page</a>',
		showCloseButton: true,
		showCancelButton: true,
		cancelButtonText: 'Close',
		confirmButtonText: 'Delete Event',
	  }).then((result) => {
		if (result.isConfirmed) {
		  // Delete event
		  fetch("modul/kalendar/eventHandler.php", {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify({ request_type:'deleteEvent', event_id: info.event.id}),
		  })
		  .then(response => response.json())
		  .then(data => {
			if (data.status == 1) {
			  Swal.fire('Event deleted successfully!', '', 'success');
			} else {
			  Swal.fire(data.error, '', 'error');
			}

			// Refetch events from all sources and rerender
			calendar.refetchEvents();
		  })
		  .catch(console.error);
		} else {
		  Swal.close();
		}
	  });
	}
  });

  calendar.render();
});
	</script>
</body>
</html>
