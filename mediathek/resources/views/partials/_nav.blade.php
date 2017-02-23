<nav class="navbar navbar-default">
	<div class="container-fluid">
	
	<div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Mediathek</a>
    </div>
	
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
              <li class="{{ Request::is('books') ? "active" : "" }}"><a href="/books">Bücher</a></li>
              <li class="{{ Request::is('films') ? "active" : "" }}"><a href="/films">Filme</a></li>
              <li class="{{ Request::is('about') ? "active" : "" }}"><a href="/about">About</a></li>
		  </ul>
		 </div>
	 </div>
</nav>