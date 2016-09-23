<!-- Banner -->
<section id="title">
	<div class="inner">
		<h2>Ventas</h2>
		<p>Búsqueda de propiedades para comprar</p>
	</div>
</section>

<!-- Form -->	
<section class="wrapper style1 special">
	<form method="post" action=<?php send_email("joi@mailinator.com", "joi@mailinator.com", "name", "subject", "message", "copy"); ?>
	<h4>Alguna consulta?</h4>
		<div class="row uniform">
			<div class="12u$">
				<input type="text" name="name" id="name" value="" placeholder="Nombre" />
			</div>
			<div class="6u 12u$(xsmall)">
				<input  type="tel" required name="tel" id="tel" value="" placeholder="Tel" />
			</div>
			<div class="6u$ 12u$(xsmall)">
				<input type="email" required name="email" id="email" value="" placeholder="Email" />
			</div>
			<div class="6u 12u$(small)">
				<input type="checkbox" id="copy" name="copy">
				<label for="demo-copy">Enviarme una copia</label>
			</div>
			<div class="12u$">
				<textarea name="message" required id="message" placeholder="Escribe un mensaje..." rows="6"></textarea>
			</div>
			<div class="12u$">
				<ul class="actions">
					<li><input type="submit" value="Enviar" class="special" /></li>
					<li><input type="reset" value="Borrar" /></li>
				</ul>
			</div>
		</div>
	</form>
</section>

<!-- Two -->
<section id="sales" class="wrapper alt style2">
	<?php echo do_shortcode('[listings term="ventas" columns="1"]'); ?>
</section>