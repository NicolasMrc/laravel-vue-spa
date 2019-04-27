<template>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<div class="page-header">
					<h1 class="display-4">Login</h1>
				</div>
				<div class="py-4">
					<p>Cette Application est un Chat qui à été développée à partir de <i class="fa fa-coffee"></i> et de <i class="fa fa-magic"></i> par
						<a href="https://nicolasmercier.io" target="_blank">Nicolas Mercier</a> dans le cadre du test technique de la Startup <a href="https://vendredi.cc" target="_blank">Vendredi</a>.<br/>
						Temps estimé de développement + déploiement : 6h.<br/>
						Vous n'avez pas de compte mais voulez jeter un oeil ? <code>{email: 'ex@mple.com', password: 'password'}</code><br/>
						Il s'agit d'un fork de <a href="https://github.com/anindya-dhruba/laravel-vue-spa">laravel-vue-spa</a> (Laravel/Vue boilerplate) développée
						<a href="https://github.com/anindya-dhruba/">Paranindya Dhruba</a>.
					</p>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<login-form @loginSuccess="loginSuccess"></login-form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import LoginForm from './../login/LoginForm.vue'
	import jwtToken from "../../helpers/jwt-token";
	import {mapActions} from "vuex";

	export default {
		components: {
			'login-form': LoginForm
		},
		methods: {
			...mapActions([
				'setAuthUser'
			]),
			loginSuccess(data) {
				jwtToken.setToken(data.token);
				this.setAuthUser(data.user);
				this.$router.push({name: 'index'});
			}
		}
	}
</script>
