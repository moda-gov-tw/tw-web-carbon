import '../js/bootstrap.bundle.min.js';
import '../css/ctca_theme.min.css';
import '../css/bootstrap.min.css';
import '../css/style.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { usePage } from '@inertiajs/vue3';
import { lazyPlugin } from '@/directives';

const appName = '網頁碳排計算';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(lazyPlugin)
            .mixin({
                methods: {
                    lang: function () {
                        return usePage().props.language.original;
                    }
                },
            })
            .mount(el);
    },
    progress: {
        delay: 250,
        color: '#40E0D0',
        includeCSS: true,
        showSpinner: false,
    },
});
