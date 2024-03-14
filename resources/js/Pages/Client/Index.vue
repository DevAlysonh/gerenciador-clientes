<template>
	<AppHeader title="Clientes" />
	<h2>Clientes</h2>
	<template v-if="$page.props.flash.deleted">
		<div class="alert alert-warning">
			{{ $page.props.flash.deleted }}
		</div>
	</template>
	<template v-if="$page.props.flash.no_content">
		<div class="alert alert-success">
			{{ $page.props.flash.no_content }}
		</div>
	</template>
	<div>
		<div class="d-flex justify-content-between mb-2 mt-2 align-items-center">
			<input v-model="search" class="form-control w-auto" type="text" placeholder="Pesquisar Cliente">
			<button class="btn btn-md btn-success" @click="openCreateClientModal">
				Novo Cliente
			</button>
		</div>
		<div class="row bg-light h-auto p-2 rounded align-items-center pt-3 pb-3 row-gap-3">
			<template v-if="clients.data.length > 0">
				<div v-for="client in clients.data" :key="client.id"
					class="card-body shadow bg-white d-flex p-1 align-items-center rounded justify-content-between">
					<div class="ms-3 w-auto">
						<img class="img-thumbnail" :src="'/img/clients/' + (client.image ? client.image : 'avatar.png')" width="75" alt="">
					</div>
					<div>
						{{ client.socialName }}
					</div>
					<div id="actions" class="d-flex me-3" title="Visualizar Perfil">
						<Link :href="`/clients/${client.id}`">
						<button class="btn btn-primary btn-sm me-2 rounded">
							<i class="fa-solid fa-eye"></i>
						</button>
						</Link>
					</div>
				</div>
			</template>
			<div v-else class="d-flex justify-content-center">
				<h5>Parece que você ainda não tem nenhum cliente cadastrado.</h5>
			</div>
		</div>
		<template v-if="clients.data.length > 0">
			<Paginator :data="clients" />
		</template>
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
	clients: Object,
	searched: String
})

let search = ref(props.searched);


watch(search, debounce((value) => {
	router.get('/clients', { search: value }, {
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
@keyframes slideInDown {
	from {
		transform: translateY(-100%);
	}

	to {
		transform: translateY(0);
	}
}

@keyframes slideOutUp {
	from {
		transform: translateY(0);
	}

	to {
		transform: translateY(-100%);
	}
}

.message {
	display: none;
	/* Começa escondida */
	animation-duration: 0.5s;
	/* Duração da animação */
}

.show {
	display: block;
	/* Mostra a div */
	animation-name: slideInDown;
	/* Aplica animação de entrada */
}

.hide {
	animation-name: slideOutUp;
	/* Aplica animação de saída */
}

.alert {
	margin-top: 20px;
	/* Espaçamento entre a mensagem e o topo */
}
</style>