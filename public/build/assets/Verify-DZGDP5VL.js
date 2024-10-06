import{A as g,_ as k,r as h,a as C}from"./AppLayout-BWdNQaqX.js";import{Z as _,i as L,T as c,q as a,c as x,w as l,o as b,b as n,f as i,e as N,a as s,n as V,k as d,B as p}from"./app-BfnqphSQ.js";import{_ as U}from"./_plugin-vue_export-helper-DlAUqK2U.js";const I={components:{AppLayout:g,Head:_,Link:L,useForm:c,NavLink:k,HomeIcon:h,ChevronRightIcon:C},props:{roles:Object},setup(){},data(){return{form:c({name:"",email:null,password:null,password_confirmation:null,roles:[]})}},created(){},watch:{},methods:{save(){this.form.post(this.route("users.store"),{preserveScroll:!0,onSuccess:()=>{this.toast.success("Create user successfully")},onError:()=>{this.toast.errors("Create user Errors")}})}},mounted(){}},P={class:"sm:px-7 sm:pt-7 px-4 pt-4 flex flex-col w-full border-b border-gray-200 bg-white dark:bg-gray-900 dark:text-white dark:border-gray-800 sticky top-0"},A={class:"flex w-full items-center border rounded-lg p-2"},B={class:"flex items-center text-sm text-gray-600 dark:text-white"},H={class:"flex items-center space-x-3 sm:mt-7 mt-4"},T={class:"sm:p-7 p-4"},E={class:"overflow-hidden shadow-md sm:rounded-lg"},R={action:""},S={class:"grid grid-cols-2 gap-4"},j={class:"p-2 w-full"},q={class:"p-2 w-full"},z={class:"p-2 w-full"},D={class:"p-2 w-full"},F={class:"flex p-2"};function M(t,e,O,Z,o,m){const u=a("NavLink"),w=a("HomeIcon"),f=a("ChevronRightIcon"),v=a("Link"),y=a("AppLayout");return b(),x(y,{title:"Create User"},{header:l(()=>[n(u,{href:t.route("users.index"),active:t.route().current("users.index"),class:"px-4"},{default:l(()=>e[5]||(e[5]=[i(" Users ")])),_:1},8,["href","active"]),t.can("users.create")||t.is_superAdmin("super-admin")?(b(),x(u,{key:0,href:t.route("users.create"),active:t.route().current("users.create"),class:"px-4"},{default:l(()=>e[6]||(e[6]=[i(" Create User ")])),_:1},8,["href","active"])):N("",!0)]),default:l(()=>[s("div",P,[s("div",A,[s("div",B,[n(w,{class:"w-4 h-4 mx-1"}),n(f,{class:"w-4 h-4 mx-1 mt-[1px]"}),e[7]||(e[7]=s("span",{class:"mx-1 mt-[3px]"},"Users",-1)),n(f,{class:"w-4 h-4 mx-1 mt-[1px]"}),e[8]||(e[8]=s("span",{class:"mx-1 mt-[3px]"},"Create",-1))])]),s("div",H,[n(v,{href:t.route("users.create"),class:V(["px-3 border-b-2 text-gray-500 dark:text-white dark:border-white pb-1.5",{"border-blue-500 text-blue-600 ":t.route().current("users.create")}])},{default:l(()=>e[9]||(e[9]=[i("Information")])),_:1},8,["href","class"]),e[10]||(e[10]=s("a",{href:"#",class:"px-3 border-b-2 border-transparent text-gray-600 dark:text-gray-400 pb-1.5"},"Transfer",-1)),e[11]||(e[11]=s("a",{href:"#",class:"px-3 border-b-2 border-transparent text-gray-600 dark:text-gray-400 pb-1.5 sm:block hidden"},"Notifications",-1)),e[12]||(e[12]=s("a",{href:"#",class:"px-3 border-b-2 border-transparent text-gray-600 dark:text-gray-400 pb-1.5 sm:block hidden"},"Cards",-1))])]),s("div",T,[s("div",E,[s("form",R,[s("div",S,[s("div",j,[e[13]||(e[13]=s("label",{class:"mt-2 pb-2"},"Name",-1)),d(s("input",{type:"text","onUpdate:modelValue":e[0]||(e[0]=r=>o.form.name=r),class:"w-full px-2 py-2 border-gray-400 rounded-md",placeholder:"Please input name"},null,512),[[p,o.form.name]])]),s("div",q,[e[14]||(e[14]=s("label",{class:"mt-2 pb-2"},"Email",-1)),d(s("input",{type:"text","onUpdate:modelValue":e[1]||(e[1]=r=>o.form.email=r),class:"w-full px-2 py-2 border-gray-400 rounded-md",placeholder:"Please input email"},null,512),[[p,o.form.email]])]),s("div",z,[e[15]||(e[15]=s("label",{class:"mt-2 pb-2"},"Password",-1)),d(s("input",{type:"password","onUpdate:modelValue":e[2]||(e[2]=r=>o.form.password=r),class:"w-full px-2 py-2 border-gray-400 rounded-md",placeholder:"Please input password"},null,512),[[p,o.form.password]])]),s("div",D,[e[16]||(e[16]=s("label",{class:"mt-2 pb-2"},"Confirm Password",-1)),d(s("input",{type:"password","onUpdate:modelValue":e[3]||(e[3]=r=>o.form.password_confirmation=r),class:"w-full px-2 py-2 border-gray-400 rounded-md",placeholder:"Please input confirm password"},null,512),[[p,o.form.password_confirmation]])])]),s("div",F,[s("div",{class:"mr-4 px-2 w-16 py-2 bg-teal-600 text-white text-center shadow-md rounded-lg cursor-pointer",onClick:e[4]||(e[4]=(...r)=>m.save&&m.save(...r))}," Save "),e[17]||(e[17]=s("div",{class:"mr-4 px-2 w-16 py-2 bg-rose-500 text-white text-center shadow-md rounded-lg cursor-pointer"}," Back ",-1))])])])])]),_:1})}const Q=U(I,[["render",M]]);export{Q as default};
