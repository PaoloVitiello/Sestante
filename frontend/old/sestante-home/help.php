<?php include 'inc/config.inc'; connetti_db();  ?>
  
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   <head profile="http://gmpg.org/xfn/11">
      <title><?php echo $CONF['TitleApplication']?></title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <?php    
               if (eregi("MSIE",$_SERVER['HTTP_USER_AGENT']))
                  echo '<link rel="Stylesheet" href="/css/ie.css" type="text/css" media="screen" />';
               else 
                  echo '<link rel="Stylesheet" href="/css/style.css" type="text/css" media="screen" />';
      ?>     
   </head>
<body>
 <div align=left >
   <br>
   <h1>" MAPPE GEMELLI - SESTANTE " <br><br> Notizie utili per una corretta visualizzazione dell'applicativo </h1>
   <br><br>
   <div style="width:100%;" >
     <button style="width:10%; margin: 0 0 0 45%; color:black; cursor:pointer; font-weight:bold; " onclick="top.location.href=' http://gemelli.theta.eu?method=analitico&mappa'"> AVVIA &nbsp DEMO </button>
   </div>
   <br><br>
   
        <table width=1200 align=center>
          <tr>
            <td width=49% valign=top>
              <h3>Visualizzazione</h3>
                <ul>
                  <li>Per poter utilizzare tutte le funzionalit&agrave &egrave consigliato l'utilizzo del browser <b>FIREFOX</b>; 
                        il browser pu&ograve essere prelevato da <a href="http://www.mozillaitalia.org">http://www.mozillaitalia.org</a></li>
                        
                  <li>L'applicazione deve essere visualizzata ad una risoluzione minima di 1280X1024 con il browser a <b>tutto schermo (TASTO F11)</b></li>
                  <li><b>In mancanza del Touch Screen utilizzare il solo mouse (NON la tastiera) per navigare il sito</b></li>
               
                  <li>Il browser INTERNET EXPLORER pu&ograve essere utilizzato ma alcune funzionalit&agrave potrebbero non essere disponibili. 
                  Il posizionamento delle varie aree potrebbe non corrispondere con la reale posizione visualizzata tramite FIREFOX. </li>
                  
                  <li>La velocit&agrave complessiva dell'applicazione &egrave pi&ugrave lenta rispetto alla realt&agrave 
                        in quanto alcune funzionalit&agrave sono simulate per consentire la pubblicazione su questo sito WEB.</li>
                        
                  <li>In questa versione WEB alcuni testi potrebbero essere visualizzati con un effetto "sgranato".</li>
                </ul>             
              <br>
              <h3>Aggiornamenti V3.1</h3>
                <ul>
                <li>Installazione <b>Screen Saver</b></li>
                <li>Leggermente modificata <b>zona istruzioni</b></li>
                <li>Formattazione informazioni specifiche sull'unit&agrave operativa selezionata, compresa la stampa.</li>
                <li>Aggiunto tasto per errate digitazioni</li>
                <li>Tasti <b>Precedente - successivo</b> modificati</li>
                <li>In caso di omonimia delle unit&agrave operative compare anche il nome del reparto</li>
                </ul>
<!--                
                <h3>TO DO LIST</h3>
                  <ul>
                    <li>Le unit&agrave visualizzate devono essere 19 o 20 solo se la ricerca restituisce 19 o 20 unit&agrave;</li>
                    <li>I tasti <b>[Pagina precedente]</b>e <b>[Pagina successiva]</b> compariranno solo se la ricerca ottiene pi&ugrave di 20 unita</li>                    
                    <li>Ridurre ricerca a 18 unita per pagina, in caso siano presenti pi&ugrave di 20 unit&agrave e inserire tasti <b>[Pagina precedente]</b>e <b>[Pagina successiva]</b>;</li>
                    <lI>Spostare <b>[Pagina precedente]</b> in alto a sinistra e <b>[Pagina successiva]</b> in basso a destra, 
                    come se occupassero rispettivamente il posto della 1&deg; e della 20&deg; unita. </li>                    
                    <li><b>Icone</b> per seganalzione <i>"Tasti per la scelta del reparto"</i> e <i>"Scrivere con tastiera...."</i></li>
                    <li><b>Icone</b> per seganalzione dei colori del percorso</li>
                    <li><b>Icona Lampeggiante</b> o con altro sistema di evidenziazione per seganalzione <b>Voi siete qui</b></li>                    
                    <li>Perfezionare sistema di tracciamento delle stampe, attualmente aumenta soltanto un contatore</li>
                    <li>Perfezionare sistema di rilevazione mancata stampa della mappa</li>
                    <li>Inserimento pulsante per attivazione <b>Screen Saver</b> da utilizzare come HELP, ottimo per evitare che l'utente aspetti l'avvio automatico</li>
                    <li>Definizione delle pagine dello <b>Screen Saver</b> e creazione delle immagine da inserire</lI>
                  </ul>
           </td>
-->            <td width=2% valign=top>&nbsp;</td>
            <td width=49% valign=top>
              <h3>Stampa delle mappe</h3>
                <ul>
                  <li>La stampa delle mappe &egrave simulata mediante la creazione di un file PDF in quanto &egrave assente una stampante di sistema.<br>
                       Questo meccanismo rallenta la visualizzazione delle pagine e crea alcune differenze all'interno del file PDF rispetto alla stampa normale</li>
                       
                  <li>Il messaggio di carta terminata non viene visualizzato perch&egrave non &egrave presente la stampante fisica.</li>
                  
                  <li>La visualizzazione di alcuni dati relativi alle unit&agrave, fabbricato, percorso etc.., 
                        non corrisponde alla situazione reale trattandosi di una demo.</li>
                </ul>
              <br><br>
             <h3>Parametri riconfigurabili</h3>
             I numeri racchiusi tra parentesi indicano l'impostazione di default.Tutti i valori sono espressi in secondi.
               <ul>
                 <li>Azzeramento testo ricercato tramite tastiera (20)</li>
                 <li>Permanenza a video della mappa e delle informazioni dell'unit&agrave operativa ricercata dopo aver lanciato la stampa (60)</li>    
                 <li>Permanenza a video dell'ultima operazione effettuata. trascorso questo tempo il programma riparte dalla schermata principale [mappa generale](60)</li>    
                 <li>Avvio dello Screen Saver (60)</li>
                 <li>Tempo di visualizzazione di ogni pagina dello Screen Saver (10)</li>
                 <li>Testo dei pulsanti, con eccezione di <i>Spazio</i> e Nome specifico del reparto <i>Day hospital, Ambulatori e servizi etc..</i></li>
               <ul>                 
            </td>
          </tr>
        </table>
    </div>
</body>
</html>

