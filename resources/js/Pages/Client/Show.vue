<template>
	<UploadImage :client="client" />
	<template v-if="$page.props.flash.success">
		<div class="alert alert-info fs-5">
			{{ $page.props.flash.success }}
		</div>
	</template>
	<template v-if="$page.props.flash.fail">
		<div class="alert alert-secondary fs-5">
			{{ $page.props.flash.fail }}
		</div>
	</template>
	<AppHeader title="Perfil do Cliente" />
	<div class="d-flex justify-content-between mb-2 mt-2 align-items-center">
		<div class="d-flex align-items-center">
			<h2>Perfil de {{ client.social_name }}</h2>
			<div class="text-sm ms-2">
				<span class="text-white bg-primary rounded p-1"> {{ clientType }}</span>
			</div>
		</div>
		<div>
			<template v-if="!editable">
				<button class="btn btn-md btn-success" @click="canEditClient">
					Editar Cliente
				</button>
			</template>
			<template v-if="!editable">
				<button id="deleteButton" class="btn btn-md ms-2 btn-danger" data-bs-toggle="modal"
					data-bs-target="#deleteClient">
					<i class="fa-solid fa-trash"></i>
				</button>
			</template>
		</div>
	</div>

	<form id="updateForm" @submit.prevent="updateClient">
		<div class="h-auto p-4 rounded bg-light">
			<div class="d-flex flex-column align-items-center">
				<div class="shadow position-relative rounded">
					<template v-if="$page.props.flash.img_uploaded">
						{{ setImagePath($page.props.flash.img_uploaded) }}
						<img class="img-thumbnail" :src="'/img/clients/' + $page.props.flash.img_uploaded" width="150" alt="">
					</template>
					<template v-else>
						<img class="img-thumbnail" :src="'/img/clients/' + (imagePath ? imagePath : 'avatar.png')" width="150" alt="">
					</template>
					<template v-if="editable">
						<div 
							class="position-absolute rounded top-0 start-0 w-100 h-100 bg-dark opacity-75 d-flex justify-content-center align-items-center d-none cursor-pointer"
							data-bs-toggle="modal"
							data-bs-target="#uploadClientImage"
							title="Alterar Imagem"
						>
							<i class="fa-regular fa-image fa-2x text-white"></i>
						</div>
					</template>
				</div>
				<div class="fs-5">
					{{ client.social_name }}
				</div>
			</div>
			<div class="row mt-5 fs-5">
				<div class="col-6">
					<label for="name">Nome</label>
					<input type="text" v-model="clientData.name" id="name" class="form-control" :disabled="!editable">
					<span v-if="$page.props.errors.name" v-text="$page.props.errors.name"
						class="text text-danger"></span>
				</div>
				<div class="col-6">
					<label for="social_name">Nome Social</label>
					<input type="text" v-model="clientData.social_name" id="social_name" class="form-control"
						:disabled="!editable">
					<span v-if="$page.props.errors.social_name" v-text="$page.props.errors.social_name"
						class="text text-danger"></span>
				</div>
			</div>
			<div class="row mt-5 fs-5">
				<div class="col-6">
					<label for="document">Documento</label>
					<input type="text" v-model="clientData.document" id="document" class="form-control"
						:disabled="!editable">
					<span v-if="$page.props.errors.document" v-text="$page.props.errors.document"
						class="text text-danger"></span>
				</div>
				<div class="col-6">
					<label for="birthdate">Data de Nascimento</label>
					<input type="date" v-model="clientData.birthdate" id="birthdate" class="form-control"
						:disabled="!editable">
					<span v-if="$page.props.errors.birthdate" v-text="$page.props.errors.birthdate"
						class="text text-danger"></span>
				</div>
			</div>
			<div class="d-flex justify-content-center mt-4">
				<template v-if="editable">
					<button class="btn btn-md btn-success" type="submit" :disabled="updating">
						Salvar
					</button>
				</template>
			</div>
		</div>
	</form>

	<!-- delete client modal confirmation -->
	<div class="modal fade" id="deleteClient" tabindex="-1" aria-labelledby="deleteClientLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Tem certeza disto?</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Os dados do cliente serão excluídos para sempre. Deseja continuar?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<Link as="button" method="delete" :href="`/clients/delete/${client.id}`" data-bs-dismiss="modal"
						class="btn btn-sm btn-danger">Sim, quero excluir</Link>
				</div>
			</div>
		</div>
	</div>

</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import UploadImage from '../../Components/Modal/Client/UploadImage.vue';
import { reactive } from 'vue';
import { ref } from 'vue';


let editable = ref(false);
let updating = ref(false);
let imagePath = ref('');
let props = defineProps({
	client: Object,
	clientType: String
});

const clientData = reactive({
	name: props.client.name,
	social_name: props.client.social_name,
	birthdate: props.client.birthdate,
	document: props.client.document,
	image: imagePath
});

function canEditClient() {
	editable.value = true;
}

function updateClient() {
	router.patch(`/clients/${props.client.id}`, clientData, {
		onStart() {
			updating.value = true;
		},
		onFinish() {
			updating.value = false;
		},
		onSuccess() {
			editable.value = false;
		}
	});
}

function setImagePath(path) {
	imagePath.value = path;
}
</script>

<style scoped>
	.position-relative:hover .position-absolute {
		display: flex !important;
	}
	.cursor-pointer {
        cursor: pointer;
    }
</style>