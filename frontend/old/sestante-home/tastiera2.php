<!-- basic template file for HTML -->

<html>
<head>
<title>hello world</title>
<script type="text/javascript">
    
     var aa ="<?php echo $_GET['lettera']; ?>";
     var varmia;


     
function stopper()
{
clearTimeout(varmia);
}
	
function leggi(cc)
{

var dd = document.getElementById('lettera').value;
setTimeout('document.RicercaAnalitica.submit()', 0);  

}


function agg(bb)
 {

  	  aa += bb;
     document.RicercaAnalitica.lettera.value=aa;    
   
   }

   
function azzera()
 {
  	  aa = '';
     document.RicercaAnalitica.lettera.value=aa;
     document.RicercaAnalitica.submit();

   }
/*var2 = setTimeout('document.getElementById("formLettera").style.visibility="hidden"',10);
var3 = setTimeout('document.getElementById("2").style.backgroundColor="#CCCCCC"',10);*/
</script>
</head>
<body>
<form method=GET name=RicercaAnalitica>

<input type=text name=lettera id=lettera class=search value=>
</form>

<?php
 $X_MIN = '0';
 $X_MAX = '255';
         for ($x = $X_MIN; $x<=$X_MAX; $x++)
          {         

                           
              echo '<INPUT TYPE="button" VALUE="&#'.$x.';" onClick="stopper(); agg(this.value)">';

              
          } 
          
          ?>
</body>

</html>
