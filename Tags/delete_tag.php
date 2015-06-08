<?php
/*
 * input=> document_id tag_string
 * output 0 or 1
 *  */
$docid = $argv[1];
$tagstr = strtolower($argv[2]);

$dbIP=" ";
$conn = pg_connect("host= dbname= user= password=");
if(! $conn )
{
    echo 0;
    die();
}            

delete_tag($conn, $tagstr, $docid);

function delete_tag( $conn, $tagstr, $docid)
{
    $sql =<<<EOF
    DELETE FROM tag_details where Doc_ID='$docid' AND Tag_Str='$tagstr' AND Neg_Count > Pos_count;
EOF;
   $ret = pg_query($conn, $sql);
   if(!$ret)
    {
      echo 0;//pg_last_error($conn);
      //return false;
    } 
    else 
    {
       echo 1;//return true;
    }
}

pg_close($conn);
?>