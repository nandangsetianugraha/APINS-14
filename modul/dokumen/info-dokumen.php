				<?php 
				include("../../config/config.php");
				include("../../config/db_connect.php");
				$idr=$_POST['rowid'];
				$infodoc = $connect->query("select * from form_data where id='$idr'")->fetch_assoc();
				$diview=$infodoc['view'];
				$lagi=$diview+1;
				$sql2 = "UPDATE form_data SET view='$lagi' where id='$idr'";
				$query2 = $connect->query($sql2);
				?>
				
				<div class="modal-header">
					<h5 class="modal-title"><?=$infodoc['judul'];?></h5>
					<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
						<i class="fa fa-times"></i>
					</button>
				</div>
				<div class="modal-body">
					<?php if($infodoc['tipefile']=='doc' or $infodoc['tipefile']=='docx'){ ?>
					<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?=base_url();?>dokumen/uploads/<?=$infodoc['file_names'];?>" width="100%" height="650px" frameborder="0"></iframe>
					<?php } ?>
                  	<?php if($infodoc['tipefile']=='jpg' or $infodoc['tipefile']=='png' or $infodoc['tipefile']=='jpeg'){ ?>
                  	<img src="<?=base_url();?>dokumen/uploads/<?=$infodoc['file_names'];?>" width="100%" >
                  	<?php } ?>
                  	<?php if($infodoc['tipefile']=='mp3'){ ?>
                  	<audio controls>
                       <source src="<?=base_url();?>dokumen/uploads/<?=$infodoc['file_names'];?>" type="audio/mp3"></source>
                    </audio>
                  	<?php } ?>
					<?php if($infodoc['tipefile']=='pdf'){ ?>
					<div id="canvases"></div>
					<?php } ?>
                  	<?php if($infodoc['tipefile']=='mp4'){ ?>
					<div style="text-align:center"> 
					  <button onclick="playPause()">Play/Pause</button> 
					  <button onclick="makeBig()">Big</button>
					  <button onclick="makeSmall()">Small</button>
					  <button onclick="makeNormal()">Normal</button>
					  <br><br>
					  <video id="video1" width="900">
						<source src="<?=base_url();?>dokumen/uploads/<?=$infodoc['file_names'];?>" type="video/<?=$infodoc['tipefile'];?>">
						Your browser does not support HTML video.
					  </video>
					</div>
					<?php } ?>
				</div>
<?php if($infodoc['tipefile']=='mp4'){ ?>
<script> 
var myVideo = document.getElementById("video1"); 

function playPause() { 
  if (myVideo.paused) 
    myVideo.play(); 
  else 
    myVideo.pause(); 
} 

function makeBig() { 
    myVideo.width = 900; 
} 

function makeSmall() { 
    myVideo.width = 450; 
} 

function makeNormal() { 
    myVideo.width = 700; 
} 
</script> 
<?php } ?>				
<?php if($infodoc['tipefile']=='pdf'){ ?>
<script type="text/javascript" src="<?=base_url();?>assets/js/pdf.min.js"></script>
<script>
var url = '<?=base_url();?>dokumen/uploads/<?=$infodoc['file_names'];?>';

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
<?php } ?>