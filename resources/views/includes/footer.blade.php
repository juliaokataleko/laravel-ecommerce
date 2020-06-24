<!-- Footer -->
@if(!isset($no_footer))
<section id="footer" class="bg-dark text-center">
	<div class="container">
		<div class="row text-center text-xs-center text-sm-left text-md-left">
			<div class="col-xs-12 col-sm-6 col-md-6 text-center">
				<h5>Saiba Mais</h5>
				<ul class="list-unstyled quick-links">
					<li><a href="{{ BASE_URL }}"></i>Página Inicial</a></li>
					<li><a href="{{ BASE_URL }}/about">Sobre nós</a></li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 text-center">
				<h5>Mais Ligações</h5>
				<ul class="list-unstyled quick-links">

					<li><a href="{{ BASE_URL }}/termos-e-condicoes">Perguntas Frequentes</a></li>
					<li><a href="{{ BASE_URL }}/contact"> Contactos</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5 text-center">
				<h5>REDES SOCIAS</h5>
				<ul class="list-unstyled list-inline social">
					<li class="list-inline-item"><a href="javascript:void();"><i class="fab fa-facebook"></i></a></li>
					<li class="list-inline-item"><a href="javascript:void();"><i class="fab fa-twitter"></i></a></li>
					<li class="list-inline-item"><a href="javascript:void();"><i class="fab fa-instagram"></i></a></li>
					<li class="list-inline-item"><a href="javascript:void();" target="_blank"><i
								class="fa fa-envelope"></i></a></li>
				</ul>
			</div>
			</hr>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
				@auth()
				<a class="nav-link active" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
					<i class="fas fa-sign-out-alt"></i> {{ __('Terminar Sessão') }}
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
				@endauth


				<p class="h6">&copy <?php echo date("Y"); ?> Direitos Reservados.<a class="text-green ml-2" href="{{ BASE_URL }}" target="_blank">{{ getenv('APP_NAME') }}</a>
				</p>
			</div>
			</hr>
		</div>
	</div>
</section>
@endif
<!-- ./Footer -->