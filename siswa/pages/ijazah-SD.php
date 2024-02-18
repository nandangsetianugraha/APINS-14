<style type="text/css">

#upload-button {
	width: 150px;
	display: block;
	margin: 20px auto;
}

#file-to-upload {
	display: none;
}

#pdf-main-container {
	width: 400px;
	margin: 20px auto;
}

#pdf-loader {
	display: none;
	text-align: center;
	color: #999999;
	font-size: 13px;
	line-height: 100px;
	height: 100px;
}

#pdf-contents {
	display: none;
}

#pdf-meta {
	overflow: hidden;
	margin: 0 0 20px 0;
}

#pdf-buttons {
	float: left;
}

#page-count-container {
	float: right;
}

#pdf-current-page {
	display: inline;
}

#pdf-total-pages {
	display: inline;
}

#pdf-canvas {
	

}

#page-loader {
	height: 100px;
	line-height: 100px;
	text-align: center;
	display: none;
	color: #999999;
	font-size: 13px;
}

#download-image {
	width: 150px;
	display: block;
	margin: 20px auto 0 auto;
	font-size: 13px;
	text-align: center;
}

</style>
	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Ijazah SD</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
	
	<!-- App Capsule -->
    <div id="appCapsule">
        <!-- konten -->
		<div id="pdf-main-container">
			<div id="pdf-loader">Loading document ...</div>
			<div id="pdf-contents">
				<div id="pdf-meta">
					<div id="pdf-buttons">
						<button type="button" id="pdf-prev" class="btn btn-primary mr-1 mb-1"><ion-icon name="chevron-back-outline"></ion-icon> Previous</button>
						<button type="button" id="pdf-next" class="btn btn-primary mr-1 mb-1">Next <ion-icon name="chevron-forward-outline"></ion-icon></button>
					</div>
				</div>
				<canvas id="pdf-canvas" width="390"></canvas>
				<div id="page-loader">Loading page ...</div>
				
			</div>
		</div>
		
		<!-- konten -->
		<input type="hidden" id="filepdf" value="../ijazah/<?=$bioku['nisn'];?>.pdf">
		
    </div>
		
    <!-- * App Capsule -->
    <!-- App Bottom Menu -->
    <?php include "layout/app-bottom.php";?>
    <!-- * App Bottom Menu -->
    <!-- App Sidebar -->
    <?php include "layout/app-sidebar.php";?>
	<!-- * App Sidebar -->
    
	<!-- ///////////// Js Files ////////////////////  -->
    <?php include "layout/javascript.php";?>
	<script src="assets/js/pdf.js"></script>
	<script src="assets/js/pdf.worker.js"></script>
	<script>

var __PDF_DOC,
	__CURRENT_PAGE,
	__TOTAL_PAGES,
	__PAGE_RENDERING_IN_PROGRESS = 0,
	__CANVAS = $('#pdf-canvas').get(0),
	__CANVAS_CTX = __CANVAS.getContext('2d');

function existsFile(url) {
   var http = new XMLHttpRequest();
   http.open('HEAD', url, false);
   http.send();
   return http.status!=404;
}

function showPDF(pdf_url) {
	$("#pdf-loader").show();

	PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
		__PDF_DOC = pdf_doc;
		__TOTAL_PAGES = __PDF_DOC.numPages;
		
		// Hide the pdf loader and show pdf container in HTML
		$("#pdf-loader").hide();
		$("#pdf-contents").show();
		$("#pdf-total-pages").text(__TOTAL_PAGES);

		// Show the first page
		showPage(1);
	}).catch(function(error) {
		// If error re-show the upload button
		$("#pdf-loader").hide();
		$("#upload-button").show();
		$("#pdf-loader").show();
		$("#pdf-loader").text("Ijazah tidak ditemukan");
		//alert(error.message);
	});;
}

function showPage(page_no) {
	__PAGE_RENDERING_IN_PROGRESS = 1;
	__CURRENT_PAGE = page_no;

	// Disable Prev & Next buttons while page is being loaded
	$("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

	// While page is being rendered hide the canvas and show a loading message
	$("#pdf-canvas").hide();
	$("#page-loader").show();
	$("#download-image").hide();

	// Update current page in HTML
	$("#pdf-current-page").text(page_no);
	
	// Fetch the page
	__PDF_DOC.getPage(page_no).then(function(page) {
		// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
		var scale_required = __CANVAS.width / page.getViewport(1).width;

		// Get viewport of the page at required scale
		var viewport = page.getViewport(scale_required);

		// Set canvas height
		__CANVAS.height = viewport.height;

		var renderContext = {
			canvasContext: __CANVAS_CTX,
			viewport: viewport
		};
		
		// Render the page contents in the canvas
		page.render(renderContext).then(function() {
			__PAGE_RENDERING_IN_PROGRESS = 0;

			// Re-enable Prev & Next buttons
			$("#pdf-next, #pdf-prev").removeAttr('disabled');

			// Show the canvas and hide the page loader
			$("#pdf-canvas").show();
			$("#page-loader").hide();
			$("#download-image").show();
		});
	});
}

$(document).ready(function(){
	var url = $("#filepdf").val();
    $.ajax({
                url: url,
                type: 'HEAD',
                error: function() 
				{
                    $("#pdf-loader").text("Ijazah Tidak ditemukan");
					$("#pdf-loader").show();
                },
                success: function() 
                {
                    showPDF('../ijazah/<?=$bioku['nisn'];?>.pdf');
                }
            });
});


// Previous page of the PDF
$("#pdf-prev").on('click', function() {
	if(__CURRENT_PAGE != 1)
		showPage(--__CURRENT_PAGE);
});

// Next page of the PDF
$("#pdf-next").on('click', function() {
	if(__CURRENT_PAGE != __TOTAL_PAGES)
		showPage(++__CURRENT_PAGE);
});

// Download button
$("#download-image").on('click', function() {
	$(this).attr('href', __CANVAS.toDataURL()).attr('download', 'page.png');
});

</script>