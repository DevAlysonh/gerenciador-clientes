<template>
	<AppHeader title="Home" />
	<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
		<div id="doc" class="col-12 text-center bg-body-secondary p-4 d-flex rounded align-items-center justify-content-center">
			<div>
				<h2>
					Ops! Parece que tivemos algum problema:
				</h2>
				<div class="mt-5 mb-3 ">
					<H1>{{ title }}</H1>
					<div>{{ description }}</div>
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
import { computed } from 'vue'

const props = defineProps({ status: Number })

const title = computed(() => {
	return {
		503: '503: Serviço Indisponível',
		500: '500: Erro no Servidor',
		404: '404: Página não encontrada',
		403: '403: Acesso Negado',
	}[props.status]
})

const description = computed(() => {
	return {
		503: 'Desculpe, estamos fazendo alguma manutenção. Por favor, volte em breve.',
		500: 'Whoops, algo deu errado em nossos servidores.',
		404: 'Desculpe, a página que você está procurando não foi encontrada.',
		403: 'Desculpe, você está proibido de acessar esta página.',
	}[props.status]
})
</script>
