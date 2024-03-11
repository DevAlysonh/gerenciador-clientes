<template>
	<AppHeader title="Clientes" />
	<h2>Clientes</h2>
	<div class="col-12 bg-body-secondary h-auto p-2 d-flex rounded align-items-center justify-content-center">
		<div class="card-body shadow bg-white d-flex p-1 align-items-center rounded justify-content-between">
			<div class="ms-3">
				<i class="fa-solid fa-user-plus"></i>
			</div>
			<div>
				Client Name
			</div>
			<div id="actions" class="d-flex">
				<Link href="#">
					<button class="btn btn-primary me-2 rounded-circle">
						<i class="fa-solid fa-eye"></i>
					</button>
				</Link>
				<Link href="#">
					<button class="btn btn-success me-2 rounded-circle">
						<i class="fa-solid fa-pen-to-square"></i>
					</button>
				</Link>
			</div>
		</div>
	</div>
</template>

<script setup>
	import AppHeader from '../../Components/AppHeader.vue';
	import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
a {
	color: #ffff !important;
}
</style>