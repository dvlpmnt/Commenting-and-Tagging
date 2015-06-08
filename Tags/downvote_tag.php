<?php
/*
 * input=> document_id tagstring
 * output=> 0 or 1
 *  */ 
$dbIP="";
$docid = $argv[1];
$tagstr = strtolower($argv[2]);

$conn = pg_connect("host= dbname= user= password=");
        
if(!$conn)
{
    echo 0;//die('Could not connect: ' . pg_last_error());
}            
else 
   {
       neg_count_update($conn,$tagstr,$docid);
   }

function neg_count_update($conn,$tagstr,$docid)
{
    $sql =<<<EOF
    SELECT Neg_Count from tag_details WHERE Doc_ID = '$docid' AND Tag_Str = '$tagstr';
EOF;
   $ret = pg_query($conn, $sql);
   if(!$ret)
    {
      return;
    } 
    $row = pg_fetch_array($ret);
    $a=$row[0]+1;
    $sql =<<<EOF
    UPDATE tag_details SET Neg_Count=$a WHERE Tag_Str='$tagstr' AND Doc_ID='$docid';
EOF;
   $ret = pg_query($conn, $sql);
   if(!$ret)
    {
      echo 0;//pg_last_error($conn);
      return ;
    } 
    else 
    {
      echo 1;//"Record updated successfully\n";
    }
}

pg_close($conn);
?>
