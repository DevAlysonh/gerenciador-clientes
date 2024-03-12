<template>
	<main>
		<header>
			<nav class="navbar navbar-expand-lg bg-body-tertiary">
				<div class="container-fluid">
					<Link class="navbar-brand" href="/">
						<i class="fa-solid fa-people-roof"></i>
					</Link>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
						aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav">
							<li class="nav-item">
								<Link class="nav-link" aria-current="page" href="/clients">Clientes</Link>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<article class="p-5">
			<div class="container">
				<slot />
			</div>
		</article>
	</main>
</template>

<script setup>
	import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.navbar {
	background-color: var(--nav-background-color) !important;
}

a {
	color: antiquewhite;
}

a:hover,
a:focus {
	color: var(--nav-items-color); /* Altere para a cor desejada */
}

</style>