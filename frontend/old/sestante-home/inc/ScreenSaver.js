
/********** SCREEN SAVER ***********/

var var0, var1, var2, var3, var4, var5, var6, var7, riattiva, nascondi ;



function newClearTimeout()
{
clearTimeout(riattiva);
clearTimeout(var0);
clearTimeout(var1);
clearTimeout(var2);
clearTimeout(var3);
clearTimeout(var4);
clearTimeout(var5);
clearTimeout(var6);
clearTimeout(var7);
clearTimeout(nascondi);

riattiva = setTimeout('AttivaScreenSaver()',TempoSS);
}


function AttivaScreenSaver()
 {

  

  var0 = setTimeout('document.getElementById("ss1").style.visibility="visible"',0);
  nascondi = setTimeout('document.getElementById("formLettera").style.visibility="hidden"',0);
  var1 = setTimeout('DisattivaScreenSaver("ss1")',frame);
  
  var2 = setTimeout('document.getElementById("ss2").style.visibility="visible"',frame);
  var3 = setTimeout('DisattivaScreenSaver("ss2")',frame*2);
  
  var4 = setTimeout('document.getElementById("ss3").style.visibility="visible"',frame*2);
  var5 = setTimeout('DisattivaScreenSaver("ss3")',frame*3);
  
  var6 = setTimeout('document.getElementById("ss4").style.visibility="visible"',frame*3);
  var7 = setTimeout('DisattivaScreenSaver("ss4")',frame*4);
  
  riattiva = setTimeout('AttivaScreenSaver()',frame*4);

 }

function DisattivaScreenSaver(id,clearTimer)
 {
   if (clearTimer==1)
    {
      newClearTimeout();
      document.getElementById('formLettera').style.visibility="visible";
      //riattiva = setTimeout('AttivaScreenSaver()',TempoSS);
    }
     

   document.getElementById(id).style.visibility="hidden";
   
 }

//document.onmousedown=newClearTimeout 
//document.onkeypress=newClearTimeout 


/*********** FINE SCREEN SAVER ******************/

