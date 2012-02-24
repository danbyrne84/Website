        <article id="latest-posts">
            <header>
                <h1>Latest Blog Posts</h1>
            </header>
            <section>
		  		<ul>
                    {posts}
                        <li>
                            <a href="{link}" target="_blank">{title}</a>
                        	<p>
                        		{description}
                        	</p>
                        </li>
                    {/posts}
                </ul>
            </section>
        </article>
