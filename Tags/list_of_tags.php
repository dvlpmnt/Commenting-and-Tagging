<?php
/*
 *input=> document_id 
 *output=> 0 if failed
 *          tag_strings otherwise
 */
$dbIP="";
$docid = $argv[1];

$conn = pg_connect("host= dbname= user= password=");

if(! $conn )
{
    //echo 0;
    die();
}            

list_of_tags($conn,$docid);
        
function list_of_tags($conn,$docid)
{
    $sql =<<<EOF
    SELECT Tag_Str,Pos_Count,Neg_Count from tag_details WHERE Doc_ID = $docid;
EOF;

   $ret = pg_query($conn, $sql);
   if(!$ret)
    {
      //echo 0;//pg_last_error($conn);
      return;
    } 
    while($row = pg_fetch_array($ret))
    {
        $a=$row[1];
        $b=$row[2];
        $a-=$b;
        echo "$row[0]:$a\n";
    }
}
pg_close($conn);
?>