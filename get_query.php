<?php
//cho $_POST['sid'];
$user=$_POST['user'];
$pass=$_POST['pass'];
$sid=$_POST['sid'];
$query=$_POST['query'];
$q_type=strstr(ltrim($query),' ',true);
echo "Query Type = $q_type<br>";

$conn = oci_connect("system", $pass, "mvcopy");
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


function do_select($conn,$query) {
// echo $user." ".$pass." ".$sid;
// $conn = oci_connect('system', 'password', 'mvcopy');
// $conn = oci_connect($user, $pass, $sid);

echo "<table class=\"table-bordered table-responsive table-striped\">\n";
$stid = oci_parse($conn, $query);


if (!oci_execute($stid,OCI_DESCRIBE_ONLY)) {
   $oerr = oci_error($stid); 
   echo "Oracle Error Code :".$oerr["message"]; 
   exit; 
} 
$ncols = oci_num_fields($stid);

oci_execute($stid);
$num_rows=oci_fetch_all($stid,$res_array,null, null, OCI_FETCHSTATEMENT_BY_ROW);
echo "<td>Total Rows: ".$num_rows."</td><tr>";

for ($i = 1; $i <= $ncols; $i++) {
    $column_name  = oci_field_name($stid, $i);
   // $column_type  = oci_field_type($stid, $i);
    echo "<td>$column_name</td>";
}
echo "</tr>";
/*while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
*/

foreach ($res_array as $row ) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
}

function do_update($conn,$query) {
    echo "Update not yet supported.";
}

function do_delete($conn,$query) {
    echo "Delete not yet supported.";
}
function do_insert($conn,$query) {
    echo "Insert not yet supported.";
}
function do_other($conn,$query) {
    echo "This not yet supported.";
}

switch (strtoupper($q_type)) {
    case  "SELECT" :
        do_select($conn,$query);
        break;
    case  "UPDATE" :
        do_update($conn,$query);
        break;
    case  "INSERT" :
        do_insert($conn,$query);
        break;
    case  "DELETE" :
        do_delete($conn,$query);
        break;
     default : 
        do_other($conn,$query);
        break;
}
    
