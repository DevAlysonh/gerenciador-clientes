<template>
	<template v-if="$page.props.flash.success">
		<div class="alert alert-info fs-5">
			Os dados do Cliente foram atualizados.
		</div>
	</template>
	<form id="updateForm" @submit.prevent="updateClient">
		<AppHeader title="Perfil do Cliente" />
		<div class="d-flex justify-content-between mb-2 mt-2 align-items-center">
			<div class="d-flex align-items-center">
				<h2>Perfil de {{ client.social_name }}</h2>
				<div class="text-sm ms-2">
					<span class="text-white bg-primary rounded p-1"> {{ clientType }}</span>
				</div>
			</div>
			<template v-if="!editable">
				<button class="btn btn-md btn-success" @click="canEditClient">
					Editar Cliente
				</button>
			</template>
			<template v-if="editable">
				<button class="btn btn-md btn-success" type="submit" :disabled="updating">
					Salvar
				</button>
			</template>
		</div>

		<div class="h-auto p-4 rounded bg-light">
			<div class=" d-flex flex-column align-items-center">
				<div class="shadow">
					<img class="img-thumbnail" src="/public/img/avatar.png" width="150" alt="">
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
		</div>
	</form>

</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { ref } from 'vue';


let editable = ref(false);
let updating = ref(false);
let props = defineProps({
	client: Object,
	clientType: String
});

const clientData = reactive({
	name: props.client.name,
	social_name: props.client.social_name,
	birthdate: props.client.birthdate,
	document: props.client.document
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
</script>

<style scoped></style>