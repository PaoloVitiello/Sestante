<HTML>
<HEAD>
<SCRIPT LANGUAGE="javascript">
var aa="";
function agg(bb)
   {
   aa=""+aa+" "+bb
   document.modulo.S1.value=aa
   }
</SCRIPT>
</HEAD>
<BODY >
<FORM NAME="modulo">
   <TEXTAREA ROWS="2" NAME="S1" COLS="20"></TEXTAREA>
   <BR>
   <BR>
   <INPUT TYPE="text" NAME="T1" SIZE="20">
   <INPUT TYPE="button" VALUE="Aggiungi" NAME="B1" onClick="agg(this.value)">
   <BR>
   <BR>
   <INPUT TYPE="text" NAME="T2" SIZE="20">
   <INPUT TYPE="button" VALUE="Aggiungi" NAME="B2" onClick="agg(this.value)">
</FORM>
</BODY>
</HTML>