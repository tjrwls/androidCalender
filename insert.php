<?php 

    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbcon.php');

    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
    
    if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android )
    {

        // 안드로이드 코드의 postParameters 변수에 적어준 이름을 가지고 값을 전달 받는다.

        $date=$_POST['date_s'];
        $text=$_POST['text_s'];
        
            
        if(empty($date)){
            $errMSG = "Input date";
        }
        else if(empty($text)){
            $errMSG = "text";
        }
        
        


        if(!isset($errMSG))
        {
            try{
                $stmt = $con->prepare('INSERT INTO calender(date, text) VALUES(:date, :text)');
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':text', $text);
                                
                
               

                if($stmt->execute())
                {
                    $successMSG = "New record addition";
                }
                else
                {
                    $errMSG = "record addition error";
                }

            } catch(PDOException $e) {
                die("Database error: " . $e->getMessage()); 
            }
        }

    }
?>

<html>
   <body>
        <?php 
        if (isset($errMSG)) echo $errMSG;
        if (isset($successMSG)) echo $successMSG;
        ?>
        
        <form action="<?php $_PHP_SELF ?>" method="POST">
            date: <input type = "text" name = "date_s" /><br>
            text: <input type = "text" name = "text_s" /><br>

            <input type = "submit" name = "submit" />
        </form>
   
   </body>
</html>