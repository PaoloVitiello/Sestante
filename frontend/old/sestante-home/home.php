      <?php
                if (isset($_GET[stampaPS])) 
             header('Refresh: 20; URL=/unita.php?method=analitico');
             else 
             header('Refresh: 90; URL=/unita.php?method=analitico');
       include 'inc/config.inc'; connetti_db(); global $CONF?>
        <html></head><link rel="Stylesheet" href="/css/style.css" type="text/css" media="screen" />
        <script type="text/javascript">

   </script>
        </head><body>
questa è la home page
            </body>
            </html>