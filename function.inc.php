<?php



// require "config.php";
function pr($arr){

    echo '<pre>';
    print_r($arr);
}


function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}
 

function add_product($type='', $limit=''){

    $sql ="SELECT * FROM product";
    $conn =mysqli_connect("localhost","root","","project") or die("Connection failed : " . mysqli_connect_error());
    if($type=='latest'){

        $sql.="  order by id desc ";
    }
    if($limit!=''){

        $sql.="  limit $limit ";
    }
    
    $result = mysqli_query($conn, $sql); 

$data =array();
    while($row=mysqli_fetch_assoc($result)){
        $data [] = $row;
    }
    return $data;
}

?>