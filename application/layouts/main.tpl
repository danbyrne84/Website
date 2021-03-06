<!DOCTYPE html>
<html>
<head>
    <title>Dan Byrne</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/main.css"></link>
</head>
<body lang="en">

    <section id="container">

        <header id="main-header">
            <a href="/" title="Home">
                <img src="/assets/images/wwwheader.gif" id="header-img"></img>
            </a>
            <nav id="navigation-bar">
                <ul id="navigation-list">
                    <li>
                        <a href="/" tite="Homepage">Home</a>
                    </li>
                    <li>
                        <a href="http://blog.danielbyrne.net/" tite="My Nerd Blog" target="_blank">Blog</a>
                    </li>
                    <li>
                        <a href="/projects/" tite="My Projects">My Projects</a>
                    </li>
                    <li>
                        <a href="/about-me/" title="About Me">About Me</a>
                    </li>
                    <li>
                        <a href="/contact/" title="Contact Me">Contact Me</a>
                    </li>
                </ul>
            </nav>
        </header>

		<section id="main-content">
			{content}
		</section>

        <footer id="main-footer">
            <div id="icons"></div>
            {runtime}
        </footer>

    </section>

    <!-- Google analytics script -->
    <script type="text/javascript">
    var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-3809222-1']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    
    </script>
</body> 
</html>
