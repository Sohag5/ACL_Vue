<template>
	<section class="login">
		<div class="container">
			<div class="row">
				<div class=" login-row">
					<div class="login-body">
						<h2 class="text-center">Login</h2>
							<p class="error text-center" v-if="authError">
								{{ authError }}
							</p>
						<div class="row main-login">
							<div class="col-md-6 border-right">
								<img v-bind:src="image" class="img-responsive login-img" />
							</div>
							<div class="col-md-6">
								<form class="pad-top" @submit.prevent="authenticate">
									<div class="form-group row">
										<div class="col-sm-12">
											<input type="email" v-model="form.email" class="form-control form-control-sm"  placeholder="Email">
										</div>
 
									</div>
									<div class="form-group row">

										<div class="col-sm-12">
											<input type="password" v-model="form.password" class="form-control form-control-sm"  placeholder="Password">
										</div>
									</div>

									<button type="submit" class="btn btn-sm btn-success float-right"> <i class="fa fa-location-arrow"></i> Sign In</button>


								</form>
							</div>
						</div>


					</div>
				</div>
			</div>

		</div>
	</section>
</template>

<script>
	import {login} from '../helpers/auth';
	export default {
		name: "Login",
		data() {
			return {
				form: {
					email: '',
					password: ''
				},
				error: null,
				image:'images/bg.PNG'
			};
		},
		methods: {
			authenticate() {
				this.$store.dispatch('login');
				login(this.$data.form)
				.then((res) => {
					this.$store.commit("loginSuccess", res);
					this.$router.push({path: '/dashboard'});
				})
				.catch((error) => {
					this.$store.commit("loginFailed", {error});
				});
			}
		},
		computed: {
			authError() {
				return this.$store.getters.authError;
			},
			currentUser() {
				return this.$store.getters.currentUser
			}

		}
	}
</script>

<style scoped>
	.error {
		text-align: center;
		color: red;
	}
</style>