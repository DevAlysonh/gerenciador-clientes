<template>
	<AppHeader title="Clientes" />
	<h2>Clientes</h2>
	<div>
		<div class="d-flex justify-content-between mb-2 mt-2 align-items-center">
			<input v-model="search" class="form-control w-auto" type="text" placeholder="Pesquisar Cliente">
			<button class="btn btn-md btn-success" @click="openCreateClientModal">
				Novo Cliente
			</button>
		</div>
		<div class="row bg-light h-auto p-2 rounded align-items-center pt-3 pb-3 row-gap-3">
			<div v-for="client in clients.data" :key="client.id" class="card-body shadow bg-white d-flex p-1 align-items-center rounded justify-content-between">
				<div class="ms-3 w-auto">
					<img class="img-thumbnail" src="/public/img/avatar.png" width="75" alt="">
				</div>
				<div>
					{{ client.socialName }}
				</div>
				<div id="actions" class="d-flex">
					<Link :href="`/clients/${client.id}`">
						<button class="btn btn-primary btn-sm me-2 rounded">
							<i class="fa-solid fa-eye"></i>
						</button>
					</Link>
					<Link :href="`/clients/edit/${client.id}`">
						<button class="btn btn-success btn-sm me-2 rounded">
							<i class="fa-solid fa-pen-to-square"></i>
						</button>
					</Link>
				</div>
			</div>
		</div>
		<Paginator :data="clients" />
	</div>
	<CreateClient />
</template>

<script setup>
	import Paginator from '../../Components/Paginator.vue';
	import CreateClient from '../../Components/Modal/Client/CreateClient.vue';
	
	import { Link, router } from '@inertiajs/vue3';
	import debounce from 'lodash/debounce';
	import { ref, watch } from 'vue';

	let props = defineProps({
		clients:Object,
		searched:String
	})

	let search = ref(props.searched);


	watch(search, debounce((value) => {
		router.get('/clients',{search:value}, {
			preserveState: true,
			replace: true
		});
	}, 500));
	
	const openCreateClientModal = () => {
		let myModal = new bootstrap.Modal(document.getElementById('createClientModal'));
		myModal.show();
	};
</script>

<style scoped>
</style>