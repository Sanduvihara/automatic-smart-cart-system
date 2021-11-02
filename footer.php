<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }
    $user_id=$_SESSION['id'];
    $user_products_query="select it.id,it.name,it.price, it.node from users_items ut inner join items it on it.id=ut.item_id where ut.user_id='$user_id'";
    $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
    $no_of_user_products= mysqli_num_rows($user_products_result);
    $sum=0;
    if($no_of_user_products==0){
        //echo "Add items to cart first.";
    ?>
        <script>
        window.alert("No items in the cart!!");
        </script>
    <?php
    }else{
        while($row=mysqli_fetch_array($user_products_result)){
            $sum=$sum+$row['price']; 
       }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>Projectworlds Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php 
               require 'header.php';
            ?>
            <br>
            <div class="container">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Section</th><th></th>
                        </tr>
                       <?php 
                        $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
                        $no_of_user_products= mysqli_num_rows($user_products_result);
                        $counter=1;
                     $data = array(); while($row=mysqli_fetch_array($user_products_result)){
                           
                         ?>
                        <tr>
                           

							<th><?php echo $row['node'];
								
								$data[]= $row['node'];
								?></th>
							
                            
                      </tr>
                       <?php $counter=$counter+1;}?>
                        <tr>
                            
                        </tr>
                    </tbody>
                </table>
                <p>
                  <label for="textfield">enter your cart number:</label>
                  <input type="text" name="textfield" id="textfield">
                </p>
            </div>
			
			<?php print_r($data)?>
			<?php 


// Here we are going to travel n number of nodes in the graph.
// this can be done by using floyd warshall algorithm.

function travelOnNodes ($graph, $V, $INF,$haveToTrav,$src)  
{  
    
    // distance matrix
    $dist = array(
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,0,0,0,0,0,0,0,0,0,0),

    );

    // path matrix
    $obj = array(
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        array("0","0","0","0","0","0","0","0","0","0","0","0","0"),
        

    );
  
    // set initial path and distance values.
    for ($i = 0; $i < $V; $i++)  
        for ($j = 0; $j < $V; $j++){
            $dist[$i][$j] = $graph[$i][$j];
            $obj[$i][$j] = $graph[$i][$j]==$INF? "0" : "$j";
        }
  
    
    for ($k = 0; $k < $V; $k++)  
    {  
        // Pick all vertices as source one by one  
        for ($i = 0; $i < $V; $i++)  
        {  
            // Pick all vertices as destination  
            // for the above picked source  
            for ($j = 0; $j < $V; $j++)  
            {  
                // If vertex k is on the shortest path from  
                // i to j, then update the value of dist[i][j] and store the path
                if ($dist[$i][$k] + $dist[$k][$j] <  
                                    $dist[$i][$j]){
                    $dist[$i][$j] = $dist[$i][$k] + 
                                    $dist[$k][$j];  
                    $obj[$i][$j] = $obj[$i][$k]." $j";
                                    }
            }  
        }  
    }  

    // Here we have to travel all the nodes in shortest path.

    $nodeList = $haveToTrav;
    $index = 0 ;
    $path = "";
    $currNode = $src;
    
    $minDistSrc = $currNode;

    // travel nearest node in the node list and update path variable.
    // after that repeat untill no nodes left to travel.
    while(!empty($nodeList)){
        $minDist = 99999;
        foreach($nodeList as $value){
            if($minDist>$dist[$currNode][$value]){
                $minDist = $dist[$currNode][$value];
                $minDistSrc = $value;
            }
        }
        
        $path = $path." ".$obj[$currNode][$minDistSrc];
        $nodeList=array_diff($nodeList,[$minDistSrc]);
        $currNode = $minDistSrc;   
         
    }
    
    // get path to node 9 (because we have to travel via node 9.)
    $pathToNINE = $currNode!=9? $obj[$currNode][9] : "";

    // get shortest path from 9 to 0
    $pathToCashOut = $obj[9][0];

    // genarate full path.
    $path = $src.$path." ".$pathToNINE." ".$pathToCashOut;

    // return path as array.
    return explode(" ",$path);

}  
  
  
// Number of vertices in the graph  
$V = 13 ; 
  
// Define Infinite
$INF = 10000 ; 
  

$graph = array(
    array(0,10,$INF,$INF,10,$INF,$INF,$INF,$INF,$INF,$INF,$INF,$INF),
    array(10,0,5,$INF,$INF,$INF,$INF,$INF,5,$INF,$INF,$INF,$INF),
    array($INF,5,0,5,$INF,$INF,$INF,$INF,$INF,$INF,$INF,$INF,$INF),
    array($INF,$INF,5,0,5,$INF,$INF,$INF,$INF,$INF,$INF,$INF,$INF), 
    array(10,$INF,$INF,5,0,5,$INF,$INF,$INF,$INF,$INF,$INF,$INF), 
    array($INF,$INF,$INF,$INF,5,0,5,$INF,$INF,$INF,$INF,$INF,5), 
    array($INF,$INF,$INF,$INF,$INF,5,0,5,$INF,$INF,$INF,$INF,$INF), 
    array($INF,$INF,$INF,$INF,$INF,$INF,5,0,5,$INF,$INF,$INF,$INF), 
    array($INF,5,$INF,$INF,$INF,$INF,$INF,5,0,5,$INF,$INF,$INF), 
    array(20,$INF,$INF,$INF,$INF,$INF,$INF,$INF,5,0,5,$INF,$INF), 
    array($INF,$INF,$INF,$INF,$INF,$INF,$INF,$INF,$INF,5,0,5,$INF), 
    array($INF,$INF,$INF,$INF,$INF,$INF,$INF,$INF,$INF,$INF,5,0,5), 
    array($INF,$INF,$INF,$INF,$INF,5,$INF,$INF,$INF,$INF,$INF,5,0)

);
  


$haveToTravel = $data;
$src = 0;
$dest = 0;

$path = travelOnNodes($graph, $V, $INF , $haveToTravel, $src);
			foreach($path as $val);
echo '<pre>'; print_r($path); echo '</pre>';

  
?> 
			
		  <?php  $user_product_query="insert into cart(array ,user_id) values ('$val','$user_id')";
			?>
			
            <br><br><br><br><br><br><br><br><br><br>
            <footer class="footer">
               <div class="container">
                <center>
                   <p>discunt product</p>
                   <p>home</p>
					<p>about us</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>
