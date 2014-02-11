<?php
echo "<p>Test with getLocataire.php</p>";
$str = $_POST["idCat"];
$model = Locataire::model()->findAllByAttributes(array('nom'=>$str));

if (strlen($q) != 0) {
    //$model = Locataire::model()->findAllByAttributes(array('id_locataire', 'nom'), "nom LIKE '" + $q + "%';");
    $sql = "SELECT id_locataire, nom FROM w3sys_locataire WHERE nom LIKE '" + $q + "%'";
    $result = mysql_query($sql);
    echo "<select name=\"muppetname\" onchange=\"changeContent(this.value)\">";

    while ($ary = mysql_fetch_array($result)) {
        echo "<option value=\"" . $ary['idcustomer'] . "\">" . $ary ['customername'] . "</option>";
    }

    echo "</select>";
} else {
    
    
}




// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint == "") {
    $response = "no suggestion";
} else {
    $response = $hint;
}

//output the response
echo $response;
?>