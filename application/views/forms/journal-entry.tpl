	<form id="journalentry" method="post">

		<div class="form-item">
			<label for="author">Author:</label>
			<input type="text" id="author" name="author" />
		</div>
		
		<div class="form-item">
			<label for="date">Date:</label>
			<input type="date" id="date" name="date" />
		</div>
		
		<div class="form-item">
			<label for="subject">Subject:</label>
			<input type="text" id="subject" name="subject" />
		</div>
		
		<div class="form-item">
			<label for="body">Body:</label>
			<textarea id="body" name="body"></textarea>
		</div>
		
		<div class="form-item">
			<label for="mood">Mood:</label>
			<input type="text" id="mood" name="mood" />
		</div>
		
		<footer>
			<button id="submit" name="submit">Contact Me</button>
			<input type="hidden" name="formvar" value="journal-create">
		</footer>
	</form>
