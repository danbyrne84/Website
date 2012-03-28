<article id="journal-entries">
	<header>
		<h2>Journal Entries</h2>
		<a href="/journal-create/">New Entry</a>
	</header>
	
	<ul>
	{entries}
		<li>
			<h3>
				<a href="#"><span id="subject">{subject}</span></a>
			</h3>
			
			<p>
				<label for="author">Posted By:</label>
				
				<a href="#"><span id="author">{author}</span></a>
				<span id="date">on {date}</span>
			</p>
			
			<p><span id="body">{body}</p>
			
			<p><label for="mood">Mood:</label><span id="mood">{mood}</span></p>
		
		</li>
	{/entries}
	</ul>
</article>