<!--[code=rgb2hex;title=rgb ↔ hex; description=Convertir des valeurs reg/green/blue en hexadécimal et vice et versa ]-->
<h1>Conversion rgb vers hexadécimal, et vice versa</h1>
<p>Vous écrivez votre css avec des valeurs en <code>rgb()</code>, et avez besoin d'une version en hexadécimal, pour <a href="http://contrast-finder.tanaguru.com/">le Tanaguru Contrast Finder</a>, par exemple. Et vous n'avez aucune envie de scinder votre chaîne de caractères pour la rentrer dans trois petites boîtes, ici le rouge, là le vert et enfin le bleu. En clair, vous êtes feignant&middot;e, comme un&middot;e développeur&middot;se normal&middot;e :) (bienvenue !).</p>
<p class="form-group">
	<label for="rgb">RGB</label>
	<input type="text" id="rgb" name="rgb" placeholder="rgb(240,245,246)" />
	<button id="rgb-submit">Vers hexadécimal</button>
</p>
<p class="form-group">
	<label for="hex">hexadécimal</label>
	<input type="text" id="hex" name="hex" placeholder="#f0f5f6" />
	<button id="hex-submit">Vers rgb</button>
</p>
<div class="color-sample">
	<div class="sample"></div>
</div>
<h2>RGB</h2>
<p>Il suffit d'entrer une chaîne à trois ou quatre éléments séparés par des virgules pour le rgb - mais <code>rgb(0,0,0)</code> marche aussi, et <code>rgba(0,0,0,1)</code> aussi !</p>
<p>Exemples valides :</p>
<ul>
	<li><code>rgb(123,45,67)</code></li>
	<li><code>rgba(123,45,67,.8)</code></li>
	<li><code>rgba(123,45,67,0.8)</code></li>
	<li><code>123,45,67</code></li>
	<li><code>123,45,67,.8</code></li>
	<li><code>123,45,67,0.8</code></li>
</ul>
<h2>Hexadécimal</h2>
<p>Un groupe de 6 caractères, avec ou sans le <code>#</code>, mais aussi 8 caractères, pour prendre en compte la couche alpha.</p>
<p>Exemples valides :</p>
<ul>
	<li><code>#123456</code></li>
	<li><code>#12345678</code></li>
	<li><code>123456</code></li>
	<li><code>12345678</code></li>
</ul>
<h2>Notes</h2>
<p>Cette conversion est faite avec JavaScript, dans le navigateur client, uniquement. Si JavaScript n'est pas activé, rien ne se passera.</p>
<script src="assets/js/rgb2hex.js"></script>