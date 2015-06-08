<?php
/**
 * input=> tag_string
 * output=>document_ids 
 *  */
$dbIP="";
$tagstr = strtolower($argv[1]);

$conn = pg_connect("host= dbname= user= password=");
        
if(! $conn )
{
    //echo 0;
    die();
}            

view_tagged_doc($conn,$tagstr);

function view_tagged_doc($conn,$tagstr)
{
    $sql =<<<EOF
    SELECT DISTINCT Doc_ID from tag_details WHERE Tag_Str = '$tagstr';
EOF;
    
    //echo "oops";
   $ret = pg_query($conn, $sql);
   if(!$ret)
    {
      //echo 0;//pg_last_error($conn);
       return;
    } 
    while($row = pg_fetch_array($ret))
    {
        echo "$row[0]\n";
    }
}

pg_close($conn);

?>