 <?php
/*
 * input => comment id
 * ouput=> 0 or 1
 * 
 *  */
$dbIP=" ";
$commentid = $argv[1];//read it


    $conn = pg_connect("host= dbname= user= password=");
        
if(! $conn )
    {
        echo 0;
        die();
    }
delete_comments($conn, $commentid);
    
function delete_comments($conn,$commentid)
{
      $sql =<<<EOF
      DELETE from comment_details where Comment_ID='$commentid';
EOF;
   $ret = pg_query($conn, $sql);
   if(!$ret)
    {
      echo 0;
      
    } 
    else 
    {
       echo 1;
    }
}
pg_close($conn);

?>