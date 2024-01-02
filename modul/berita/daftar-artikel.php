<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//$tapel=$_GET['tapel'];
$output = array('data' => array());

$sql = "SELECT * FROM berita order by tanggal asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$ids=$row['id'];
	$pns=$row['penulis'];
	$nama= $connect->query("select * from ptk where ptk_id='$pns'")->fetch_assoc();
	$tombol = '
	<a href="./edit-artikel/'.$ids.'" class="btn btn-effect-ripple btn-xs btn-primary"><i class="fa fa-edit"></i></a>
	<button class="btn btn-effect-ripple btn-xs btn-danger" onclick="removeArtikel(\''.$ids.'\')"> <i class="fa fa-trash"></i></button>
	';
	$output['data'][] = array(
      	$row['tanggal'],
		'
		<div class="rich-list rich-list-flush">
			<div class="rich-list-item flex-column align-items-stretch">
				<div class="rich-list-item p-0 mb-2">
					<div class="rich-list-prepend">
						<div class="avatar">
							<div class="avatar-display">
								<img src="images/ptk/'.$nama['gambar'].'" alt="AI">
							</div>
						</div>
					</div>
					<div class="rich-list-content">
						<h4 class="rich-list-title">'.$nama['nama'].'</h4>
						<span class="rich-list-subtitle">'.$row['judul'].'</span>
					</div>
				</div>
			</div>
		</div>
		',
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);