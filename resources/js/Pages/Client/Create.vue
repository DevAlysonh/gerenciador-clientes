<template>
	<form @submit.prevent="createClient">
		<div v-if="!$page.props.flash.success && !$page.props.flash.fail" class="form-modal">
			<div class="modal-body">
				<div class="row d-flex">
					<div class="col-6">
						<label>Nome</label>
						<input type="text" v-model="client.name" class="form-control">
						<span v-if="$page.props.errors.name" v-text="$page.props.errors.name"
							class="text text-danger"></span>
					</div>
					<div class="col-6">
						<label>Nome Social</label>
						<input type="text" v-model="client.social_name" class="form-control">
						<span v-if="$page.props.errors.social_name" v-text="$page.props.errors.social_name"
							class="text text-danger"></span>
					</div>
				</div>
				<div class="row d-flex">
					<div class="col-6">
						<label>Data de Nascimento</label>
						<input type="date" v-model="client.birthdate" class="form-control">
						<span v-if="$page.props.errors.birthdate" v-text="$page.props.errors.birthdate"
							class="text text-danger"></span>
					</div>
					<div class="col-6">
						<label>Documento</label>
						<input type="text" v-model="client.document" class="form-control" placeholder="CPF/CNPJ" />
						<span v-if="$page.props.errors.document" v-text="$page.props.errors.document"
							class="text text-danger"></span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
				<input type="submit" value="Salvar" class="btn btn-success" :disabled="creating" />
			</div>
		</div>
		<div v-if="$page.props.flash.fail">
			<div class="modal-body">
				<div class="bg-danger-subtle p-3 rounded">
					<div class="d-flex flex-column align-items-center">
						<div class="text-danger">
							<i class="fa-solid fa-x fa-5x"></i>
						</div>
						<div class="fs-5 mt-4">
							{{ $page.props.flash.fail }}
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-center mt-3">
					<button type="button" class="btn btn-success" data-bs-dismiss="modal" @click="resetPage">Ok</button>
				</div>
			</div>
		</div>
		<div v-else>
			<div class="modal-body">
				<div class="bg-info-subtle p-3 rounded">
					<div class="d-flex flex-column align-items-center">
						<div class="text-success">
							<i class="fa-solid fa-check fa-5x"></i>
						</div>
						<div class="fs-5 mt-4">
							{{ $page.props.flash.success }}
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-center mt-3">
					<button type="button" class="btn btn-success" data-bs-dismiss="modal" @click="resetPage">Ok</button>
				</div>
			</div>
		</div>
	</form>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';

const client = reactive({
	name: '',
	social_name: '',
	birthdate: '',
	document: ''
});

let creating = ref(false);

function resetPage() {
	window.location.reload();
}

function createClient() {
	router.post('/clients', client, {
		onStart() {
			creating.value = true;
		},
		onFinish() {
			creating.value = false;
		},
		onSuccess() {
			client.name = '';
			client.social_name = '';
			client.birthdate = '';
			client.document = '';
		},
	});
}
</script>

<style lang="scss" scoped></style>