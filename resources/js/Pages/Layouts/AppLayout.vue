<template>
	<main>
		<header>
			<NavBar />
		</header>
		<article class="p-5">
			<div class="container">
				<slot />
			</div>
		</article>
	</main>
</template>

<script setup>
	import NavBar from '../../Components/NavBar.vue';
</script>