<template>
	<div class="modal fade" id="uploadClientImage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="uploadClientImageLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="uploadClientImageLabel">Carregar Nova Foto</h1>
				</div>
				<form @submit.prevent="submit">
					<div class="container">
						<template v-if="imgPreview">
							<div class="preview d-flex align-items-center mb-2 mt-3 p-3 justify-content-center">
								<img class="img-thumbnail" width="150" :src="imgPreview" alt="preview">
							</div>
						</template>
						<div class="d-flex align-items-center p-2 justify-content-center">
							<input type="file" @input="load" />
							<progress v-if="form.progress" :value="form.progress.percentage" max="100">
								{{ form.progress.percentage }}%
							</progress>
						</div>
						<div class="mt-2 mb-2">
							<span v-if="form.errors.client_image" class="text text-danger" v-text="form.errors.client_image"></span>
						</div>
						<div class="d-flex align-items-center p-2 justify-content-center">
							<button type="submit" class="btn btn-success btn-sm" data-bs-dismiss="modal">
								Usar essa imagem
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue';

const imgPreview = ref(null);

const form = useForm({
	clientImage: null,
})

function submit() {
	form.post('/clients/image/upload');
}

function load(event) {
	form.clientImage = event.target.files[0];
	imgPreview.value = URL.createObjectURL(form.clientImage);
}
</script>
