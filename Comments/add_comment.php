 <?php
/*
 * input => document_ID user_name comment_string
 * output 0 or 1
 *  */
$dbIP="";
$docid = $argv[1];//$_POST["docid"];
$userid = $argv[2];//$_POST["userid"];
$textinput = $argv[3];//$_POST["commentstr"];
if (CheckComment(strtolower($textinput)))   
    {
        echo 0;
    }
else
{
    $conn = pg_connect("host= dbname= user= password=");
    
    if(! $conn )
    {
        echo 0;
        die();
    }
    if(insert_comment($conn, $docid, $userid, $textinput))
        echo 1;
    else 
        echo 0;   
}

function CheckComment($intext)
{
    $temp=$intext;
    $temp = strtr ($temp, array (' ' => ''));
    $temp = strtr ($temp, array ('\n' => ''));
    $temp = strtr ($temp, array (';' => ''));
    $temp = strtr ($temp, array (',' => ''));
    $temp = strtr ($temp, array ('.' => ''));
    $temp = strtr ($temp, array ('!' => ''));
    $temp = strtr ($temp, array ('&' => ''));
    $temp = strtr ($temp, array ('*' => ''));
    $temp = strtr ($temp, array ('1' => ''));
    $temp = strtr ($temp, array ('2' => ''));
    $temp = strtr ($temp, array ('3' => ''));
    $temp = strtr ($temp, array ('4' => ''));
    $temp = strtr ($temp, array ('5' => ''));
    $temp = strtr ($temp, array ('6' => ''));
    $temp = strtr ($temp, array ('7' => ''));
    $temp = strtr ($temp, array ('8' => ''));
    $temp = strtr ($temp, array ('9' => ''));
    $temp = strtr ($temp, array ('0' => ''));
    $temp = strtr ($temp, array ('-' => ''));
    $temp = strtr ($temp, array ('_' => ''));
    $temp = strtr ($temp, array ('#' => ''));
    
    if($temp=='')
        return true;
    //replacing special chars with english alphabets
    $intext = strtr ($intext, array ('@' => 'a'));
    $intext = strtr ($intext, array ('0' => 'o'));
    $intext = strtr ($intext, array ('3' => 'e'));
    $intext = strtr ($intext, array ('(' => 'o'));
    $intext = strtr ($intext, array (')' => ''));
    $intext = strtr ($intext, array ('$' => 's'));
    $intext = strtr ($intext, array ('+' => 't'));
    $intext = strtr ($intext, array ('!' => 'i'));
    $intext = strtr ($intext, array ('"' => ''));
    $intext = strtr ($intext, array ('\'' => ''));
    $intext = strtr ($intext, array ('.' => ''));
    
    $myArray = explode(' ', $intext);
    $flag=0;
    $badwords = array("ahole","anus","ash0le","ash0les","asholes","ass","Assface","assh0le","assh0lez","asshole","assholes","assholz","asswipe","azzhole","bassterds","bastard","bastards","bastardz","basterds","basterdz","Biatch","bitch","bitches","boffing","boob","booo","butthole","buttwipe","c0ck","c0k","cntz","cock","cockhead","cock-head","cocks","CockSucker","cock-sucker","cunt","cunts","cuntz","dick","dild0","dild0s","dildo","dildos","dilld0","dilld0s","dominatricks","dominatrics","dominatrix","fuck","fag1t","faget","fagg1t","faggit","faggot","fagit","fart","fuck","fucker","fuckin","fucking","fucks","Fukah","Fuken","fuker","Fukin","Fukk","Fukkah","Fukken","Fukker","Fukkin","gay","gayboy","gaygirl","gays","gayz","God-damned","jerkoff","jisim","jiss","jizm","jizz","Lesbian","Lezzian","Lipshits","Lipshitz","masochist","masokist","massterbait","masstrbait","masstrbate","masterbaiter","masterbate","MothaFucker","MothaFuker","MothaFukkah","MothaFukker","MotherFucker","MotherFukah","MotherFuker","MotherFukkah","MotherFukker","motherfucker","MuthaFucker","MuthaFukah","MuthaFuker","MuthaFukkah","MuthaFukker","nastt","nigger","nigur","niiger","niigr","orafis","orgasim","orgasm","orgasum","oriface","orifice","orifiss","peeenus","peeenusss","peenus","peinus","pen1s","penis","penisbreath","penus","penuus","Phuck","Phuker","Phukker","pr1c","pr1ck","pr1k","pussee","pussy","queer","queers","queerz","qweers","qweerz","qweir","recktum","rectum","scank","schlong","screwing","semen","sexy","Sh!t","sh1t","sh1ter","sh1ts","sh1tter","sh1tz","shit","shits","shitter","Shitty","Shity","shitz","Shyt","Shyte","Shytty","Shyty","skanck","skank","skankee","skankey","skanks","Skanky","slut","sluts","Slutty","slutz","sonofabitch","va1jina","vag1na","vagiina","vagina","vaj1na","vajina","wh0re","whore","xrated","xxx","b!+ch","bitch","blowjob","arschloch","fuck","shit","ass","asshole","b!tch","b17ch","b1tch","bastard","bi+ch","boiolas","buceta","c0ck","cawk","chink","cipa","clits","cock","cum","cunt","dildo","ejakulate","fatass","fcuk","fux0r","jism","l3itch","l3i+ch","lesbian","masturbate","masterbat","masterbat3","motherfucker","sob","mofo","nazi","nigga","nigger","nutsack","phuck","pussy","scrotum","sh!t","shemale","shi+","sh!+","slut","teets","tits","boobs","b00bs","testical","testicle","titt","w00se","jackoff","whoar","whore","fuck","shit","@$$","amcik","andskota","assrammer","bi7ch","bitch","bollock","breasts","buttpirate","cabron","cazzo","chraa","Cock","cunt","d4mn","daygo","dego","dick","dziwka","ejackulate","fittt","Flikker","foreskin","Fotze","Fu(","fuk","futkretzn","gay","h0r","h4x0r","helvete","Huevon","jizz","lesbo","mamhoon","masturbat","nigger","piss","pizda","poontsee","poop","porn","p0rn","pr0n","preteen","rautenberg","schaffer","scheiss","schlampe","schmuck","sh!t","sharmuta","sharmute","shipal","skribz","skurwysyn","sphencter","spierdalaj","splooge","b00b","testicle","titt","twat","vittu","wetback","wichser");
    $n12=count($badwords);
    for($i1=0;$i1<$n12;$i1++)
        {
            $line=  strtolower($badwords[$i1]);
            $n=sizeof($myArray);
            for ($i = 0; $i < $n; $i++) 
            {
                if ($myArray[$i] != "") 
                {
                    if (strpos($myArray[$i], $line) !== false) 
                    {
                        if(strtolower($badwords[$i1])=="ass")
                        {
                            if(strlen($myArray[$i])>strlen($badwords[$i1]))
                            {
                                continue;
                            }
                        }
                        //echo $badwords[$i1];
                        $flag = 1;
                        $i1=$n12;
                        break;
                    }
                }
            }
        }if($flag === 1)
        return true;
    return false;
}

function insert_comment($conn, $doc, $user, $str)
{
    $sql =<<<EOF
      INSERT INTO comment_details (Doc_ID, User_ID, Comment_ID, Comment_Str,Pos_Count,Neg_Count,Date_Time)
        VALUES ('$doc', '$user', DEFAULT , '$str' ,DEFAULT,DEFAULT,DEFAULT);
EOF;
    $ret = pg_query($conn, $sql);
    if(!$ret)
    {
       return false;
    } 
    else
        {
            return true;
        }
 }

pg_close($conn);
//echo "<body style='background-color:009688'>";
?>