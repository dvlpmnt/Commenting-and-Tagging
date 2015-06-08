 <?php
/*
 * Input => Document ID
 * Output =>
 *          Comment ID : User Name : Date Time : Comment String
 *  */
 
$dbIP=" ";
$docid = $argv[1];//$_POST["docid"];
    

    $conn = pg_connect("host= dbname= user= password=");
        
if(! $conn )
    {
        //echo 0;
        die();
    }
return_comments($conn, $docid);
    
function return_comments($conn,$docid)
{
    $sql =<<<EOF
      SELECT Comment_ID,User_ID,Date_Time,Comment_str from comment_details where Doc_ID = '$docid' ORDER BY Date_Time DESC;;
EOF;
   $ret = pg_query($conn, $sql);
   if(!$ret)
   {
      //echo 0;
   } 
   while($row = pg_fetch_array($ret))
    {
        echo "$row[0]:$row[1]:$row[2]:$row[3]\n";
    }
}

pg_close($conn);

?>