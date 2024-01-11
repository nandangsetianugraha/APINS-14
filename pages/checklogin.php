<?php 
require_once '../config/config.php';
require_once '../config/db_connect.php';
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
};
$output = array('success' => false, 'messages' => array());
$username = strip_tags($connect->real_escape_string($_POST['username']));
$tapel = $_POST['tapel'];
$smt = $_POST['smt'];
$password = strip_tags($connect->real_escape_string($_POST['password']));
$ips = get_client_ip();
$sqlp = "SELECT * FROM pengguna WHERE username = '$username'";
$queryp = $connect->query($sqlp);
$rs = $queryp->num_rows;
if($rs>0){
	$result = $queryp->fetch_assoc();
	if (password_verify($password, $result['password']) && $result['verified'] == '1') {
		session_start();
		$_SESSION['username'] = $username;
        $_SESSION['tapel'] = $tapel;
		$_SESSION['smt'] = $smt;
		$_SESSION['unique_id']= $result['ptk_id'];
		$_SESSION['userid'] = $result['ptk_id'];
		$_SESSION['level'] = $result['level'];
		$datetimeNow = date("Y-m-d H:i:s");
		$idptk=$result['ptk_id'];
		$aktivitas = 'Login ke Sistem';
		$sql = "INSERT INTO log(ptk_id,logDate,activity) VALUES('$idptk','$datetimeNow','$aktivitas')";
		$query = $connect->query($sql);
		$output['success'] = true;
		$output['messages'] = "Login berhasil!";
	}elseif(password_verify($password, $result['password']) && $result['verified'] == '0') {
		$output['success'] = false;
		$output['messages'] = "Akun anda sudah di non aktifkan, silahkan hubungi administrator!";
	}else{
		$output['success'] = false;
		$output['messages'] = "Username atau Password yang anda masukkan salah!";
	}
}else{
	$output['success'] = false;
	$output['messages'] = "Username atau Password yang anda masukkan salah!";
};
$connect->close();
echo json_encode($output);