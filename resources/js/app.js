import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import Layout from './Pages/Layouts/AppLayout.vue';
import AppHeader from './Components/AppHeader.vue';

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];

		if (!page.default.layout) {
			page.default.layout = page.default.layout || Layout;
		}

		return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
			.component('AppHeader', AppHeader)
            .mount(el);
    },
	title: title => `GC - ${title}`,
});
