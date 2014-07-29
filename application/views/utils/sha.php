<!--[code=sha;title=Calcul de somme de contrôle]-->
<h1>Calcul de somme de contrôle</h1>
<p class="intro">Vous avez besoin de chiffrer rapidement une chaîne en <a href="https://fr.wikipedia.org/wiki/SHA-1">SHA-1</a>, <a href="https://fr.wikipedia.org/wiki/SHA-256#SHA-256">SHA-256</a> ou <a href="https://fr.wikipedia.org/wiki/SHA-512#SHA-512">SHA-512</a>, vous n'avez pas de logiciel sous la main, et vous ne faites pas confiance aux sites qui chiffrent sur leur serveur ? Vous êtes au bon endroit :)</p>
<p class="form-group">
	<label for="string">Chaîne</label>
	<input type="text" id="string" name="string" />
	<button id="send">Calcul</button>
</p>
<p class="form-group">
	<label for="hash-type">Type de hash</label>
	<span class="custom-select">
		<select id="hash-type">
			<option value="sha-512">SHA-512</option>
			<option value="sha-256">SHA-256</option>
			<option value="sha-1">SHA-1</option>
		</select>
	</span>
</p>
<p class="form-group">
	<span class="label-like">Résultat</span>
	<span id="result" class="textarea-like"></span>
</p>
<h2>Note</h2>
<p>SHA-256 et SHA-512 sont mis en évidence car SHA-1 n'est plus sûr.</p>
<p>Le calcul de la chaîne chiffrée est ici effectuée en JavaScript, par le client, c'est-à-dire par votre navigateur. À aucun moment la chaîne que vous avez entrée ne part vers un serveur, cette chaîne reste chez vous et vous seul⋅e la connaissez.</p>
<p>Si rien ne se passe, c'est que vous avez désactivé JavaScript dans votre navigateur ou que ce dernier ne l'implémente pas.</p>
<h2>Crédits</h2>
<p>La <a href="https://github.com/Caligatio/jsSHA">classe JavaScript</a> utilisée sur ce micro-site est celle de <a href="https://github.com/Caligatio">Brian Turek (Caligatio)</a>.</p>
<script src="assets/js/sha.js"></script>