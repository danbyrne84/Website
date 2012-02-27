<section id="projects">
	<header>
		<h2>Projects</h2>
	</header>

    <nav>
    	<h3>Navigation</h3>
    	<ul>
    		<li>
    			<a href="#homepage">Homepage</a>
    		</li>
    		<li>
    			<a href="#ardubot">Arduino Rover</a>
    		</li>
                <li>
                        <a href="#chip8">Chip8 Emulator in C# 4.0</a>
                </li>
    	</ul>
    </nav>
	<article class="project">
		<header>
			<h3><a name="homepage" id="homepage" alt="Homepage Framework"></a>Homepage Framework & PHP Library</h3>
			<ul class="links">
				<li>
					<a href="#">View on GitHub</a>
				</li>
			</ul>
		</header>
		<p>This website was written from the ground up in a custom MVC PHP framework in <a href="http://www.php.net/" alt="PHP">PHP 5.3.10</a> using <a href="http://en.wikipedia.org/wiki/Cascading_Style_Sheets#CSS3" alt="CSS3">CSS3</a>, <a href="http://dev.w3.org/html5/spec/Overview.html" alt="HTML 5">HTML5</a> and <a href="http://www.mootools.net/">MooTools</a> JS framework.</p>
		<p>I'm also developing a library of useful PHP code alongside it making use of abstraction and software engineering best practice.</p>
		<p>Some of the features are:</p>
		<ul>
			<li>MVC architecture</li>
			<li>Layout/View rendering engine</li>
			<li>HTTP Request Routing</li>
			<li>MongoDB integration</li>
			<li>Custom Data Structure class (implementing ArrayAccess), to make working with schemaless data from Mongo easier, and to add an element of validation.</li>
			<li>Lightening fast, both due to coding constructs used and use of APC & opcode-caching</li>
		</ul>
		<p>It's an ongoing project and my library code will expand with what I learn during my <a href="/about-me/" alt="Employment">day job</a>, but also when I need to expand the site with extra functionality</p>
	</article>

	<article class="project">
		<header>
			<h3>
				<a name="ardubot" id="ardubot" alt="Arduino Rover"></a>
				Arduino Powered Rover
			</h3>
			<ul class="links">
				<li>
					<a href="#">View on GitHub</a>
				</li>
			</ul>
			<ul class="screenshots">
				<li>
					<object width="320" height="180"><param name="movie" value="http://www.youtube.com/v/-MNBWu7iFc4&hl=en_US&feature=player_embedded&version=3"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed src="http://www.youtube.com/v/-MNBWu7iFc4&hl=en_US&feature=player_embedded&version=3" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="320" height="180"></embed></object>
				</li>
				<li>
					<object width="320" height="180"><param name="movie" value="http://www.youtube.com/v/pFOusxhV4K8&hl=en_US&feature=player_embedded&version=3"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed src="http://www.youtube.com/v/pFOusxhV4K8&hl=en_US&feature=player_embedded&version=3" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="320" height="180"></embed></object>
				</li>
			</ul>
		</header>
		<p>This is an arduino powered rover that I developed in my spare time. It can be controller wirelessly using the XBee WiFly shield and an Xbox wireless controller, or via a USB cable and a serial console.</p>
		<p>Features:</p>
		<ul>
			<li>Built from the ground up using L293NE Quadruple Half-H Drivers, and a simple electronic motor attatched to a salvaged RC car</a>
			<li>Control circuits built with an <a href="http://arduino.cc">Arduino Uno</a></li>
			<li>Wireless control using the <a href="http://www.sparkfun.com/products/9954">WiFly wireless shield</a></li>
			<li>Controllable through a serial console or with a wireless XBox controller</li>
			<li>Integrated (well, attatched) webcam</li>
			<li>.NET interface for controlling the bot, and moving the webcam using its HTTP interface</li>
		</ul>
	</article>

        <article class="project">
        <header>
            <h3>
                <a name="chip8" id="chip8" alt="Chip8 Emulator"></a>
                Chip 8 Emulator written in C#
            </h3>
            <ul class="links">
                <li><a href="#">View on GitHub</a></li>
                <li><a href="http://en.wikipedia.org/wiki/CHIP-8">Chip8 on Wikipedia</a></li>
            </ul>
            <ul class="screenshots">
                <li>
                    <img src="/assets/images/projects/PONG_CHIP8.png" alt="Pong running on Chip8" title="Pong running on Chip8" />
                </li>
                <li>
                    <img src="/assets/images/projects/PACMAN_CHIP8.gif" alt="Pacman clone running on Chip8" title="Pacman clone running on Chip8" />
                </li>
            </ul>
        </header>
        <p>I'm currently developing my first emulator from scratch, written in C# 4.0 it should, given a little bit of time, emulate the Chip8 system (technically a virtual machine)</p>
        <p>Not much to tell yet...</p>
	</article>
	<div class="clear"></div>
</section>
