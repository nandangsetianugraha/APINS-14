				<?php 
				include("../../config/config.php");
				include("../../config/db_connect.php");
				$idr=$_POST['rowid'];
				$pn = $connect->query("select * from siswa where peserta_didik_id='$idr'")->fetch_assoc();
				$infodoc = $connect->query("select * from data_register where peserta_didik_id='$idr'")->fetch_assoc();
				$diview=$infodoc['file_ijazah'];
				?>
				
				<div class="modal-header">
					<h5 class="modal-title"><?=$pn['nama'];?></h5>
					<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
						<i class="fa fa-times"></i>
					</button>
				</div>
				<div class="modal-body">
					<div id="canvases"></div>
				</div>
			

<script type="text/javascript" src="<?=base_url();?>assets/js/pdf.min.js"></script>
<script>
var url = '<?=base_url();?>ijazah/sd/<?=$infodoc['file_ijazah'];?>';

var pdfjsLib = window['pdfjs-dist/build/pdf'];
pdfjsLib.GlobalWorkerOptions.workerSrc = '<?=base_url();?>assets/js/pdf.worker.min.js';

var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
	canvas = document.getElementById('canvases'),
    scale = 1.0;

function renderPage(num, canvas) {
  var ctx = canvas.getContext('2d');
  pageRendering = true;
  // Using promise to fetch the page
  pdfDoc.getPage(num).then(function(page) {
    //var viewport = page.getViewport({scale: scale});
	//var viewport = page.getViewport(canvas.width / page.getViewport(1.0).width);
	var viewport = page.getViewport(window.screen.width / page.getViewport(1.0).width);
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);

    // Wait for rendering to finish
    renderTask.promise.then(function() {
      pageRendering = false;
      if (pageNumPending !== null) {
        // New page rendering is pending
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });
}

pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
  pdfDoc = pdfDoc_;

  const pages = parseInt(pdfDoc.numPages);

  var canvasHtml = '';
  for (var i = 0; i < pages; i++) {
  	canvasHtml += '<canvas id="canvas_' + i + '"></canvas>';
  }

  document.getElementById('canvases').innerHTML = canvasHtml;

  for (var i = 0; i < pages; i++) {
  	var canvas = document.getElementById('canvas_' + i);
  	renderPage(i+1, canvas);
  }
});	
</script>				
