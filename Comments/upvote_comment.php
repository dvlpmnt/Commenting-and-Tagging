<?php
/*
 * input=> comment_id
 * output=> 0 or 1
 *  */ 

$dbIP=" ";
$commentid = $argv[1];


    $conn = pg_connect("host= dbname= user= password=");
            
if(! $conn )
{
    echo 0;
    die();
}      

pos_count_update($conn,$commentid);

function pos_count_update($conn,$commentid)
{  
    $sql =<<<EOF
    SELECT Pos_Count from comment_details WHERE Comment_ID='$commentid';
EOF;
   $ret = pg_query($conn, $sql);
   if(!$ret)
    {
      return;
    } 
    $row = pg_fetch_array($ret);
    $a=$row[0]+1;
    $sql =<<<EOF
      UPDATE comment_details SET Pos_Count=$a WHERE Comment_ID='$commentid';
EOF;
   $ret = pg_query($conn, $sql);
   if(!$ret)
    {
      echo 0;//pg_last_error($conn);
      return;
    } 
    else 
    {
        echo 1;//"Record updated successfully\n";
    }
}

pg_close($conn);
?>