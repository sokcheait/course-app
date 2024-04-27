import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
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
