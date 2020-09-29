<template>
	<section>
<!-- 		<Header />
		<div class="container">
			<div class="row">
				<router-view>
					<h1>dfs</h1>
				</router-view>
			</div>
		</div>
		<Footer /> -->
	</section>

</template>


<script>
	import Header from './Header.vue';
	import Footer from './Footer.vue';
	export default {
		name: 'Dashboard',
		components: {Header,Footer},
	}
</script>