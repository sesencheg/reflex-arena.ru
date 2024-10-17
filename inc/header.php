<?

?>
    <head>      
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />        
        <?=$meta;?>         
        <link rel="stylesheet" type="text/css" href="style.css" media="screen, projection" />
        <script language="javascript" type="text/javascript" src="/js/jquery.min.js"></script>
        <script language="javascript" type="text/javascript" src="/js/jquery.flot.min.js"></script>
        <script language="javascript" type="text/javascript" src="/js/jquery.flot.pie.min.js"></script>
        <script language="javascript" type="text/javascript" src="/js/jquery.cursorMessage.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script language="javascript" type="text/javascript" src="/js/player.js"></script>
        <script language="javascript" type="text/javascript" src="/js/excanvas.min.js"></script>
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="wrapper">
            <div id="header">
                <div class="inner">
                  <div id="logo">
                    <a href="/"></a>
                  </div>
                  <div id="tracking">
                        <strong><span id="ctl00_lblDuelers"><? echo $reflex->getPlayersCount(); ?></span></strong> Players 
                        <strong><span id="ctl00_lblDuels"><? echo $reflex->getDuelsCount(); ?></span></strong> Duels 
                  </div> 
                  <div class="clear"></div>
                </div>
            </div>
