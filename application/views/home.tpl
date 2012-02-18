        <article id="latest-posts">
            <header>
                <h1>Latest Blog Posts</h1>
            </header>
            <section>
		  		<ul>
                    {posts}
                        <li>
                        	<a href="{link}">{title}</a> by {author}
                        	<p>
                        		{description}
                        	</p>
                        </li>
                    {/posts}
                </ul>
            </section>
        </article>
