<template>
	<div class="modal fade" id="createClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Client</h1>
				</div>
				<CreateClientForm />
			</div>
		</div>
	</div>
</template>

<script setup>
import CreateClientForm from '../../../Pages/Client/Create.vue';
</script>
