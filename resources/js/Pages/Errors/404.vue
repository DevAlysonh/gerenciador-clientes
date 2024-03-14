<template>
	<AppHeader title="Home"/>
	<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
		<div id="doc" class="col-12 text-center p-1 d-flex rounded align-items-center justify-content-center">
			<div>
				<h2>
					Ops! Parece que o conteúdo que você	está buscando <br>
					não existe, ou foi removido!
				</h2>
				<div>
					
				</div>
				<div class=" p-3">
					<Link href="/" as="button" class="btn btn-secondary">Voltar ao Início</Link>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';


</script>

<style lang="scss" scoped>

</style>