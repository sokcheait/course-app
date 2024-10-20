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
                            { label: "First Name",name:"first_name",type: "text", placeholder: "Enter your first name", value: "", required: true, component: 'TextInput' },
                            { label: "Last Name", name:"last_name",type: "text", placeholder: "Enter your last name", value: "", required: true, component: 'TextInput' },
                            { label: "Email",name:"email", type: "email", placeholder: "Enter your email", value: "", required: true, component: 'TextInput' },
                            { label: "Password", name:"password",type: "password", placeholder: "Create a password", value: "", required: true, component: 'TextInput' }
                    ]
                },
                {
                    'employees': [
                            { label: "Name",name:"name" ,type: "text", placeholder: "Enter your name", value: "", required: true, component: 'TextInput' },
                            { label: "Code",name:"code" , type: "text", placeholder: "Enter your code", value: "", required: true, component: 'TextInput' },
                            { label: "Salary", name:"salary" ,type: "text", placeholder: "Enter your salary", value: "", required: true, component: 'TextInput' }
                    ]
                },
                {
                    'parents': [
                            { label: "Name",name:"name" ,type: "text", placeholder: "Enter your name", value: "", required: true, component: 'TextInput' },
                            { label: "Code",name:"code" , type: "text", placeholder: "Enter your code", value: "", required: false, component: 'TextInput' },
                    ]
                }
            ]
        }
    }
}
</script>