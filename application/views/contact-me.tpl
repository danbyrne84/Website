<article id="contact-me">

	<form id="contact-me" method="post">
		<header>
			<h1>Contact Me</h1>
			{message}
		</header>

		<div class="form-item">
			<label for="from">From:</label>
			<input type="text" id="from" name="from" />
		</div>
		
		<div class="form-item">
			<label for="email">Email:</label>
			<input type="text" id="email" name="email" />
		</div>
		
		<div class="form-item">
			<label for="subject">Subject:</label>
			<input type="text" id="subject" name="subject" />
		</div>
		
		<div class="form-item">
			<label for="message">Message:</label>
			<textarea id="message" name="message"></textarea>
		</div>
		
		<footer>
			<button id="submit" name="submit">Contact Me</button>
			<input type="hidden" name="formvar" value="contact-me">
		</footer>
	</form>

</article>