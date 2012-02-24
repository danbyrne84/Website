<!DOCTYPE html>
<html>
<head>
    <title>Dan Byrne</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/main.css"></link>
</head>
<body lang="en">

    <section id="container">

        <header id="main-header">
            <img src="/assets/images/wwwheader.gif" id="header-img"></img>
            <nav id="navigation-bar">
                <ul id="navigation-list">
                    <li>
                        <a href="/" tite="Homepage">Home</a>
                    </li>
                    <li>
                        <a href="http://blog.danielbyrne.net/" tite="My Nerd Blog">Blog</a>
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

</body> 
</html>
