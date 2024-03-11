<template>
	<main class="container">
		<header>
			<nav class="navbar navbar-expand-lg bg-body-tertiary rounded">
				<div class="container-fluid">
					<a class="navbar-brand" href="#">
						<i class="fa-solid fa-people-roof"></i>
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
						aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#">Clientes</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<article class="row p-5">
			<slot />
		</article>
	</main>
</template>

<script setup>

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