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
  


$haveToTravel = array(11,2);
$src = 0;
$dest = 0;

$path = travelOnNodes($graph, $V, $INF , $haveToTravel, $src);
echo '<pre>'; print_r($path); echo '</pre>';

  
?> 