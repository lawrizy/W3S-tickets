<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
            function loadListLoc(str)
            {   
                if (str==""){
                    document.getElementById("divCat").innerHTML="<p>Select a category</p>";
                    return;
                }
                document.getElementById("divCat").innerHTML=""
                var xmlhttp;
                if (window.XMLHttpRequest)
                    {// code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    }
                else
                    {// code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                
                // action to execute when we have the response from the server
                xmlhttp.onreadystatechange = function()
                    {   
                       
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                            {
                                document.getElementById("divCat").innerHTML= xmlhttp.responseText;
                                
                            }
                    }
                xmlhttp.open("GET", "getLocataire/idCat/"+str, true);
                xmlhttp.send();
            }
        </script>
    </head>
    <body>
        <?php
            
        ?>
        <select id="idCat" onchange="loadListLoc(this.value)">
            <option value=""></option>
            <option value="1">Premier choix</option>
            <option value="2">Deuxieme choix</option>
            <option value="3">Troisieme choix</option>
            <option value="4">Quatrieme choix</option>
            <option value="5">Cinquieme choix</option>
        </select>
        <div id="divCat"></div>
    </body>
</html>
