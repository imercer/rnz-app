<?php session_start(); ?>
<head><meta charset="UTF-8">
<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.indigo-teal.min.css" />
<script src="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script><script src="/analytics.js"></script><script src="/swipe.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/css/styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<link rel="stylesheet" href="/css/posts.css">
<link rel="stylesheet" href="/css/card.css">
<link rel="icon" href="favicon.png" type="image/png">
<title>Listen to RNZ</title>
<style>
.container { position: relative; width: 100px; height: 100px; float: left; margin: 5px;  }

.checkbox { position: absolute; top: 8px; right: 8px; -webkit-transform: scale(2);}
.title {
  background-color: rgba(0,0,0,0.8);
  color: #fff;
  display: inline;
  padding: 0.5rem;
vertical-align: middle;
position: absolute;
    top: 40px;
    text-align: center;
    width: 100%;
    z-index: 21;
    left: 0px;
  -webkit-box-decoration-break: clone;
  box-decoration-break: clone;
}

.nothidden {
    display: inline-block;
}
.material-icons {
    font-size: inherit;
}
audio {
    width: 100% !important;
    height: 50% !important;
    margin: auto !important;
}
</style>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header
            mdl-layout--fixed-tabs">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Listen</span>
    </div>
    <!-- Tabs -->
    <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
      <a href="#national" class="mdl-layout__tab is-active">National<i id="nationalicon" class="material-icons hidden">volume_up</i></a>
      <a href="#concert" class="mdl-layout__tab">Concert<i id="concerticon" class="material-icons hidden">volume_up</i></a>
      <a href="#international" class="mdl-layout__tab">International<i id="internationalicon" class="material-icons hidden">volume_up</i></a>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">RNZ</span>
  </div>
<main class="mdl-layout__content">
    <section class="mdl-layout__tab-panel is-active" id="national">
      <div class="page-content">
              <audio onplay="nationalplay()" onpause="nationalpause()" id="national" src="http://radionz-ice.streamguys.com/national.mp3" controls>
                <p>Your browser does not support the <code>audio</code> element </p>
              </audio>
      </div>
    </section>
    <section class="mdl-layout__tab-panel" id="concert">
      <div class="page-content">
                <audio onplay="concertplay()" onpause="concertpause()" id="concert" src="http://radionz-ice.streamguys.com/concert.mp3" controls>
                  <p>Your browser does not support the <code>audio</code> element </p>
                </audio>
      </div>
    </section>
    <section class="mdl-layout__tab-panel" id="international">
      <div class="page-content">
               <audio onplay="internationalplay()" onpause="internationalpause()" id="international" src="http://radionz-ice.streamguys.com/international.mp3" controls>
                   <p>Your browser does not support the <code>audio</code> element </p>
               </audio>
      </div>
    </section>
  </main>
</div>
<script>
function nationalplay() {
    document.getElementById("nationalicon").className = "material-icons nothidden";
}
function nationalpause() {
    document.getElementById("nationalicon").className = "material-icons hidden";
}
function concertplay() {
    document.getElementById("concerticon").className = "material-icons nothidden";
}
function concertpause() {
    document.getElementById("concerticon").className = "material-icons hidden";
}
function internationalplay() {
    document.getElementById("internationalicon").className = "material-icons nothidden";
}
function internationalpause() {
    document.getElementById("internationalicon").className = "material-icons hidden";
}
</script>
</body>