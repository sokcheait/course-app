<template>
    <div class="z-0">
        <DynamicForm :formSchema="formSchema" />
    </div>
</template>

<script>
import { ref } from 'vue';
import DynamicForm from '../Components/DynamicForm.vue'; // Import DynamicForm
export default {
    name: 'Transfer',
    components: {
        DynamicForm 
    },
    setup() {
        
      return {  };
    },
    data(){
        return {
            formSchema:[
                {
                    'users':[
                            {  label: "First Name",
                                name:"first_name",
                                props: {
                                    type: "text", 
                                    placeholder: "Enter your first name", 
                                },
                                value: "", 
                                required: true, 
                                component: 'TextInput' 
                            },
                            { label: "Last Name", name:"last_name",
                                props: {
                                    type: "text", 
                                    placeholder: "Enter your last name", 
                                }, 
                                value: "", 
                                required: true, 
                                component: 'TextInput' 
                            },
                            { label: "Email",
                                name:"email", 
                                props: {
                                    type: "email", 
                                    placeholder: "Enter your email address", 
                                },
                                value: "", 
                                required: false, 
                                component: 'TextInput' 
                            },
                            {   label: "Password", 
                                name:"password",
                                props: {
                                    type: "password", 
                                    placeholder: "Create a password", 
                                },
                                value: "", 
                                required: false,
                                component: 'TextInput' 
                            },
                            {
                                label: "Preferences",
                                name: "preferences",
                                props: {
                                    type: "radio",
                                    options: [
                                        {
                                            'subscribe':[
                                                { value: 'yes', label: 'Yes' },
                                                { value: 'no', label: 'No' },
                                            ]
                                        },
                                        {
                                            'updates':[
                                                { value: 'yes', label: 'Yes' },
                                                { value: 'no', label: 'No' },
                                            ]
                                        }
                                    ]
                                },
                                value: '',
                                required: false,
                                component: 'RadioBoxInput',
                            },                        
                    ]
                },
                {
                    'employees':[
                            {  label: "First Name",
                                name:"first_name",
                                props: {
                                    type: "text", 
                                    placeholder: "Enter your first name", 
                                },
                                value: "", 
                                required: false, 
                                component: 'TextInput' 
                            },
                            { label: "Last Name", name:"last_name",
                                props: {
                                    type: "text", 
                                    placeholder: "Enter your last name", 
                                }, 
                                value: "", 
                                required: false, 
                                component: 'TextInput' 
                            },
                            {
                                label: "Preferences",
                                name: "preferences",
                                props: {
                                    type: "checkbox",
                                    options: [
                                        { value: 'subscribe', label: 'Subscribe to newsletter' },
                                        { value: 'updates', label: 'Receive updates' },
                                        { value: 'offers', label: 'Get special offers' },
                                    ]
                                },
                                value: [],
                                required: false,
                                component: 'CheckboxGroupInput',
                            },                  
                    ]
                },
            ]
        }
    }
}
</script>