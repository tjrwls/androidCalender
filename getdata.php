<?php  
error_reporting(E_ALL); 
ini_set('display_errors',1); 

include('dbcon.php');



//POST 값을 읽어온다.
$date=isset($_POST['date_s']) ? $_POST['date_s'] : '';
$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");


if ($date != "" ){ 

    $sql="select * from calender where date='$date'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
 
    if ($stmt->rowCount() == 0){

        echo "'";
        echo $date;
        echo "검색이 안된다.";
    }
    else{

        $data = array(); 

            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){

             extract($row);

                array_push($data, 
                    array('date'=>$row["date"],
                    'text'=>$row["text"],
                
                ));
        }


        if (!$android) {
            echo "<pre>"; 
            print_r($data); 
            echo '</pre>';
        }else
        {
            header('Content-Type: application/json; charset=utf8');
            $json = json_encode(array("sungkyul"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
            echo $json;
        }
    }
}
else {
    echo "변수값이 비어있다";
}

?>



<?php

$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

if (!$android){
?>

<html>
   <body>
   
      <form action="<?php $_PHP_SELF ?>" method="POST">
        날짜: <input type = "text" name = "date" />
         <input type = "submit" />
      </form>
   
   </body>
</html>
<?php
}

   
?>