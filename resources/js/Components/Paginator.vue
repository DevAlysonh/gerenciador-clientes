<template>
	<ul class="pagination mt-2">
		<li class="page-item" v-for="link in data.links">
			<template v-if="link.url != null">
				<Link :href="link.url" v-html="link.label" class="page-link rounded me-2" :class="{ 'active': link.active }" />
			</template>
		</li>
	</ul>
</template>

<script setup>
	import { Link } from '@inertiajs/vue3';

	defineProps({
		data:Object
	});
	
</script>

<style scoped>
	a {
		color: purple !important;
	}
	a.active,
	a:focus {
		background-color: var(--nav-background-color);
		color: white !important;
		border-color: var(--nav-items-color);
		box-shadow: none !important;
	}
</style>