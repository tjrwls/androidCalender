<?php 
    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbcon.php');
        
    //POST 값을 읽어온다.
    $date=$_POST['date_s'];
    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
    
    if ($date != "" ){ 

        $sql="select * from calender where date='$date'";
        $stmt = $con->prepare($sql);
        $stmt->execute();
     
        if ($stmt->rowCount() == 0){
    
            echo "'";
            echo $date;
            echo "'은 찾을 수 없습니다.";
        }
     else{
    
         $data = array(); 
    
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    
             extract($row);
    
                array_push($data, 
                    array('date'=>$row["date"],    
                    'text'=>$row["text"]
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
        echo "";
    }

    

?>