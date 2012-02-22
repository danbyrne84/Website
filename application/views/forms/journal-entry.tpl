	<form id="journalentry" method="post">

		<div class="form-item">
			<label for="author">Author:</label>
			<input type="text" id="author" name="author" placeholder="'author' is a required field" />
		</div>
		
		<div class="form-item">
			<label for="date">Date:</label>
			<input type="date" id="date" name="date" placeholder="'date' is a required field"/>
		</div>
		
		<div class="form-item">
			<label for="subject">Subject:</label>
			<input type="text" id="subject" name="subject" placeholder="'subject' is a required field" />
		</div>
		
		<div class="form-item">
			<label for="body">Body:</label>
			<textarea id="body" name="body" placeholder="'body' is a required field"></textarea>
		</div>
		
		<div class="form-item">
			<label for="mood">Mood:</label>
			<input type="text" id="mood" name="mood" placeholder="mood"/>
		</div>
		
		<footer>
			<button id="submit" name="submit">Contact Me</button>
			<input type="hidden" name="formvar" value="journal-create">
		</footer>
	</form>
