import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { ProCalendar } from "@lbgm/pro-calendar-vue";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
import "@lbgm/pro-calendar-vue/style";
import { createDynamicForms } from '@asigloo/vue-dynamic-forms'
const VueDynamicForms = createDynamicForms()

import { Plugin } from '@flavorly/vanilla-components'
// Or If you prefer
import { VanillaComponents } from '@flavorly/vanilla-components'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(ProCalendar)
            .use(Toast)
            .use(VueSweetalert2)
            .use(VueDynamicForms)
            .use(VanillaComponents)
            .mixin({methods: {
                can: function(permissions) {
                    var param = Array(permissions)
                    var allPermissions = this.$page.props.auth.can;
                    var hasPermission = false;
                    param.forEach(function(item){
                        if(allPermissions[item]){
                            hasPermission = true;  
                        }
                    });
                    return hasPermission;
                },
                is_superAdmin: function(val) {
                    var permission_super = this.$page.props.auth.is_super_admin;
                    var access_level_master = this.$page.props.auth.user.access_level_master;
                    var hasPermission = false;
                    permission_super.forEach(function(item){
                        if(item.name==val && access_level_master==true){
                            hasPermission = true;
                        }
                    });
                    return hasPermission;
                }
            }})
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
