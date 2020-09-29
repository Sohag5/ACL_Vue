<template>
	
	<nav aria-label="breadcrumb">
		<ul class="breadcrumb">
			<li class="breadcrumb-item " ><a href=""> <i class="fa fa-bar-chart"></i> Welcome To goMyair </a></li>
			<li class="breadcrumb-item"><router-link to="/dashboard">Home</router-link></li>
			<li class="breadcrumb-item active" >{{$route.meta.pageTitle}} </li>
		</ul>
	</nav>
</template>
<script>
	
	export default {
		name: "Breadcrumb",

		methods: {

		},


	}
</script>