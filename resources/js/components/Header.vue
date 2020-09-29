<template>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<router-link class="navbar-brand" to="role">Navbar</router-link>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">

<!--			<div v-html="htmlView"></div>-->

			<ul class="navbar-nav">
				<li class="nav-item ">
					<router-link v-if=" isLoaded && $store.state.permission.dashboard[0]['show'] == 1" class="nav-link" to="dashboard">Dashboard </router-link>
				</li>

				<li class="nav-item dropdown" v-if=" isLoaded && $store.state.permission.config[0]['show'] == 1" >
					<a   class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase !important;">
						Config
					</a>
					<div class="dropdown-menu" >
						<router-link v-if=" isLoaded && $store.state.permission.role[0]['show'] == 1"  class="dropdown-item" to="role"> Role</router-link>
						<router-link v-if=" isLoaded && $store.state.permission.menu[0]['show'] == 1"   class="dropdown-item" to="menu"> Menu</router-link>
						<router-link v-if=" isLoaded && $store.state.permission.permission[0]['show'] == 1"  class="dropdown-item" to="permission"> Permission</router-link>
					</div>
				</li>


				<li class="nav-item dropdown" v-if=" isLoaded && $store.state.permission.admin[0]['show'] == 1">
					<a  class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Admin
					</a>
					<div class="dropdown-menu" >
						<router-link v-if=" isLoaded && $store.state.permission.manage_user[0]['show'] == 1"  class="dropdown-item" to="user"> Manage User</router-link>
						<router-link v-if=" isLoaded && $store.state.permission.change_password[0]['show'] == 1"  class="dropdown-item" to="menu"> Change Password</router-link>
						<a  class="dropdown-item" @click.prevent="logout"> Logout</a>
					</div>
				</li>



				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-user"></i>	 {{ currentUser.first_name }} {{ currentUser.last_name }}
					</a>
					<div class="dropdown-menu" >
						<a class="dropdown-item" @click.prevent="logout">Logout</a>
					</div>
				</li>

			</ul>
		</div>
	</nav>

</template>


<script>

	export default {
		name: "Header",

		data() {
			return {
              menus: [],
			  htmlView:'',
			}
		},
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/');
            },

			dataMenu(){
				this.isLoadComplete(false);
				let URL =this.$store.state.baseUrl  + 'auth/' + 'allMenu';
				axios.get(URL).then(response => {
					this.isLoadComplete(true);
					 this.$store.state.permission =response.data.data.checkPermission;
					// console.log(this.$store.state.permission.admin[0]['ahow']);
				}).catch(function (error) {
					console.log(error);
				});
			},



        },
        computed: {
            currentUser(){
                return this.$store.getters.currentUser
            }
        },
		mounted() {
			this.dataMenu();
		}
	}
</script>

<style scoped>
	.error {
		text-align: center;
		color: red;
	}
</style>