<?php
session_start();
$user_agent = $_SERVER['HTTP_USER_AGENT'];
function getBrowser() {

    global $user_agent;

    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}
if( getBrowser() != "Chrome" && $_SESSION['login_user'] !="pet1886-admin")
{

			 echo "<script>
			 alert('Sorry you need to Open this system in Chrome');
			window.location.href = 'logout.php';
			
		   </script>";
		   break;
}
else if(empty($_SESSION['fullname']) && empty($_SESSION['position'])){

    //echo "<script> alert(".$_SESSION['url']."); </script>";
    header("Location: login.php");
	
    break;
}
else{

    $user_check     = $_SESSION['login_user'];
    $sam            = $_SESSION['login_user'];
    //$pass_check     = $_SESSION['login_pass'];
    $fullname       = $_SESSION['fullname'];
    $firstname      = $_SESSION['firstname'];
    $middlename     = $_SESSION['middlename'];
    $lastname       = $_SESSION['lastname'];
    $department     = $_SESSION['department'];
    $position       = $_SESSION['position'];
    $role           = $_SESSION['role'];
    $id             = $_SESSION['id'] ;
    $account_stat   = $_SESSION['account_status'];
    //echo $fullname." ".$position." ".$role;
    //print_r($_SESSION);
}

$_SESSION['url'] = $_SERVER['REQUEST_URI'];

if(isset($user_check)){


}else{
    echo "<script> alert(".$_SESSION['url']."); </script>";
    header("Location: login.php");
}

function misOnly($department){

    switch($department){

        case "MIS";
        case "MIS (Iloilo)";

        break;

        default;
            echo"<script>
                alert('For MIS Memeber only');
                window.location.href = 'index.php';
            </script>";
        break;

    }
}

function topManagement($position){

    $top    = "Manager";
    $result = strpos($position, $top);

    if ($result === false) {
        echo"<script>
                alert('For Top Management Member only');
                window.location.href = 'index.php';
            </script>";
    } else {
        //echo "The string position was found in the string ";
        //echo " and exists at position $pos";
    }

}

?>
