import{T as d,c as u,w as t,o as _,f as m,a as s,b as o,t as n,u as r,n as f}from"./app-BfnqphSQ.js";import{_ as g}from"./FormSection-DqgXlOZd.js";import{_ as h,a as v}from"./TextInput-CEXObWxP.js";import{_ as i}from"./InputLabel-Eu9VYQn6.js";import{_ as $}from"./PrimaryButton-DhyVJWRV.js";import"./SectionTitle-BLIFiVGj.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const T={class:"col-span-6"},b={class:"flex items-center mt-2"},w=["src","alt"],V={class:"ms-4 leading-tight"},x={class:"text-gray-900"},y={class:"text-sm text-gray-700"},C={class:"col-span-6 sm:col-span-4"},O={__name:"CreateTeamForm",setup(B){const a=d({name:""}),p=()=>{a.post(route("teams.store"),{errorBag:"createTeam",preserveScroll:!0})};return(l,e)=>(_(),u(g,{onSubmitted:p},{title:t(()=>e[1]||(e[1]=[m(" Team Details ")])),description:t(()=>e[2]||(e[2]=[m(" Create a new team to collaborate with others on projects. ")])),form:t(()=>[s("div",T,[o(i,{value:"Team Owner"}),s("div",b,[s("img",{class:"object-cover w-12 h-12 rounded-full",src:l.$page.props.auth.user.profile_photo_url,alt:l.$page.props.auth.user.name},null,8,w),s("div",V,[s("div",x,n(l.$page.props.auth.user.name),1),s("div",y,n(l.$page.props.auth.user.email),1)])])]),s("div",C,[o(i,{for:"name",value:"Team Name"}),o(h,{id:"name",modelValue:r(a).name,"onUpdate:modelValue":e[0]||(e[0]=c=>r(a).name=c),type:"text",class:"block w-full mt-1",autofocus:""},null,8,["modelValue"]),o(v,{message:r(a).errors.name,class:"mt-2"},null,8,["message"])])]),actions:t(()=>[o($,{class:f({"opacity-25":r(a).processing}),disabled:r(a).processing},{default:t(()=>e[3]||(e[3]=[m(" Create ")])),_:1},8,["class","disabled"])]),_:1}))}};export{O as default};