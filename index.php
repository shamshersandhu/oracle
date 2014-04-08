<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <title>Oracle Query Test</title>
    </head>
    <body>
     <div class="container">
     <div class="col-md-12 well">
         <table class="table-responsive"><tr><td>
                     
    <?php
    // phpinfo();
   
    require('./tnsparser.class.php');
    $TNS = new TNSParser;
    $rc = $TNS->ParseTNS('C:\app\ca32103\product\11.2.0\client_1\network\admin\tnsnames.oRA');

    echo "<label class=\"input-md\">Select Database </label>&nbsp;</td><td>";

    echo "<select id=\"db_sel\" class=input-md>";

    foreach ($rc as $TNS => $TNSDATA) {
    //  echo $TNSDATA['HOST'][0]."<br";
    //  echo $TNSDATA['SERVICE_NAME'][0]."<br";
    // echo join(",",$TNSDATA['HOST']);
    // echo $TNS."<br>";
        echo "<option value=".$TNS.">".$TNS." --> ".join(",",$TNSDATA['HOST'])." ".join(",",$TNS['SERVICE_NAME'])." </option>";
        //  printf("Found TNS entry \"%s\" on HOST=%s<br>",$TNS,join(",",$TNSDATA['HOST']));
    }
    ?>
                     </select></td></tr><tr><td>
                
                     <label for="user" class="input-md">User Name</label></td><td>                        
                     <input id="user"  class="input-md "></td></tr><tr><td>
    
                     <label for="pass" class="input-md">Password</label></td><td>                   
                     <input id="pass" type="password" class="input-md"></td></tr><tr><td>
    
    
                     <label class="input-md pull-left">Query</label></td><td>
                     <textarea rows="10" cols="100" class="input-sm" id="query"></textarea></td></tr><tr><td>
                 </td><td>
                     <button id="btn1" class="btn-md btn-primary">Go</button></td></tr></table>
    </div>
    <div id="results" class="col-md-12 well" style="height:500px;overflow:auto">
    </div>

    <script>
    $(document).ready(function(){
      $("#btn1").click(function(){
        $("#results").load("get_query.php",{ 
            sid   : document.getElementById("db_sel").value ,
            user  : document.getElementById("user").value ,
            query : document.getElementById("query").value ,
            pass  : document.getElementById("pass").value },

        function(responseTxt,statusTxt,xhr){
          if(statusTxt==="success")
          //  alert("External content loaded successfully!");

          if(statusTxt==="error")
            alert("Error: "+xhr.status+": "+xhr.statusText);
        });
      });
    });
    </script>
 <?php
/*$conn = oci_connect('system', 'sn0wflak3_mvcopy9', 'mvcopy');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM v$database');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n"; */
?>
            
    </div>
    </body>
</html>
