    //  change  this  to  the  directory  of  your  news  files 
    //  they  should  be  plain  ASCII  text  files  with  extension  ".txt" 

    # Perhaps we should be using this, but it won't work until we have
    # the DocumentRoot set up.
    # $newspath = $GLOBALS['DOCUMENT_ROOT']."/news/

    # So we'll just do this for now...
    $newspath  =  "news/"; 

    //  Declare  array  to  hold  filenames 
    $newsfile  =  array(); 
    
    //  Create  handle  to  search  directory  $newspath  for  files 
    $hd  =  dir($newspath); 
    
    //  Get  all  files  and  store  them  in  array 
    while(  $filename  =  $hd->read()  )  { 
        $s=strtolower($filename); 
        if  (strstr($s, ".txt"))  { 
            //  Determine  last  modification  date 
            $lastchanged=filemtime($newspath.$filename); 
            $newsfile[$filename]  =  $lastchanged; 
        }    
    } 
    
    //  Sort  files  in  descending  order 
    arsort($newsfile); 
    //  Output  files  to  browser 
    for(reset($newsfile);  $key  =  key($newsfile);  next($newsfile))  
    { 
        $fa  =  file($newspath.$key); 
        $n=count($fa); 

        echo("<table border=0 cellpadding=1 cellspacing=0 width=\"100%\">");
        echo("<tr><td valign=middle align=center bgcolor=#666699>");
        echo("<table border=0 cellpadding=5 cellspacing=1 bgcolor=#cacaf7 width=\"100%\">");
        echo("<tr><td valign=top>");
        echo("<table border=0 cellpadding=0 cellspacing=0>");
        echo("<tr><td> <img src=/images/icons/document.txt.gif width=16 height=16 border=0>&nbsp;</td>");
       
        echo("<td>");
	print $fa[0];
	print  " - <font size=-1><b>(".date( "Y-m-d",$newsfile[$key]);
	print  "&nbsp; &nbsp;".date( "H:i:s",$newsfile[$key]). ")</b></font></td>\n"; 
        echo("</tr> </table> </td> </tr>");
        echo("<tr bgcolor=#ffffff> <td valign=top> <font size=-1>");

        for  ($i=1;  $i<$n;  $i=$i+1)  { 
	    print $fa[$i];
        } 
        echo("</font> </td> </tr> </table> </tr> </table><br><br>");

    }    
    
    $hd->close();  