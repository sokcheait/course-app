import { router } from '@inertiajs/vue3'
import { useToast } from "vue-toastification";

export default {
    methods: {
        destroy(id, routeName) {
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(this.route(routeName, id), {
                        preserveScroll: true,
                        onSuccess: () => {
                            useToast().success('Deleted successfully')
                        },
                        onError: () => {
                            useToast().error('Delete failed')
                        }
                    })
                }
            })
        }
        
    }
}